<?php 

/**
 * Call GoogleLibrary
 */
require "vendor/autoload.php";

/**
 * BloggerAPI
 * 22 Februari 2022
 */
class BloggerAPI
{

	protected $client_id;
	protected $client_secret;
	protected $redirect;
	
	function __construct($data = [])
	{
		if (array_key_exists('client_id',$data)) {
			$this->client_id = $data['client_id'];
		}else{
			die("client id not set");
		}

		if (array_key_exists('client_secret',$data)) {
			$this->client_secret = $data['client_secret'];
		}else{
			die("client secret not set");
		}

		if (array_key_exists('redirect',$data)) {
			$this->redirect = $data['redirect'];
		}else{
			die("redirect not set");
		}
	}

	public function Auth($token = false) {

		$client = new Google_Client();
		$client->setClientId($this->client_id);
		$client->setClientSecret($this->client_secret);
		if ($this->redirect) {
			$client->setRedirectUri($this->redirect);
		}
		$client->setAccessType('offline');
		$client->setApprovalPrompt("force");
		// $client->setIncludeGrantedScopes(true);
		$client->setScopes(array(
			"https://www.googleapis.com/auth/blogger",
		));
		$client->addScope("email");
		$client->addScope("profile");

		// if token exist
		if ($token) {
			// set token
			$client->setAccessToken($token);
		}

		return $client;
	}	

	public function GetToken($client,$code)
	{
		try {
			$client->authenticate($code);	
			$token = $client->getAccessToken();

			// get userinfo
			$userinfo = $this->GetUserInfo($client);

			if ($userinfo) {

				return [
					'status' => true,
					'response' => [
						'id' => $userinfo['id'],
						'user' => $userinfo['email'],
						'token' => json_encode($token)
					]
				];

			}else {
				return [
					'status' => false,
					'response' => "Fail get userinfo"
				];
			}

		} catch (Exception $e) {
			return [
				'status' => false,
				'response' => "Fail get token"
			];
			
		}

	}

	public function CheckToken($client)
	{

		if (empty($client)) {
			return [
				'status' => false,
				'response' => "Client not set"
			];
		}

		// check
		if ($client->isAccessTokenExpired()) {

			try {
				$refreshToken = $client->getRefreshToken();
				$client->refreshToken($refreshToken);
				$client->fetchAccessTokenWithRefreshToken($refreshToken);

				// get fresh token
				$token = $client->getAccessToken();

				// get userinfo
				$userinfo = $this->GetUserInfo($client);

				if ($userinfo) {

					return [
						'status' => true,
						'response' => [
							'id' => $userinfo['id'],
							'user' => $userinfo['email'],
							'token' => json_encode($token)
						]
					];

				}else {
					return [
						'status' => false,
						'response' => "Fail get userinfo"
					];
				}
			} catch (Exception $e) {
				return [
					'status' => false,
					'response' => "Fail get fresh token"
				];
			}
		}else{

			// token is valid			

			// get userinfo
			$userinfo = $this->GetUserInfo($client);

			if ($userinfo) {
				return [
					'status' => true,
					'response' => [
						'id' => $userinfo['id'],
						'user' => $userinfo['email'],
						'token' => $client->getAccessToken()
					]
				];
			}else{
				return [
					'status' => false,
					'response' => "Fail get userinfo"
				];
			}
		}
	}

	public function GetUserInfo($client)
	{
		try {
			$google_service = new Google_Service_Oauth2($client);
			$userinfo = $google_service->userinfo->get();
			return $userinfo;
		} catch (Exception $e) {
			return false;
		}
	}

	public function ListBlogger($client)
	{

		try {
			$blogger = new Google_Service_Blogger($client);	
			$listblog =  $blogger->blogs->listByUser('self');

			$myblog = array();
			foreach ($listblog->getItems() as $blog) {
				$myblog[] = [
					'id' => $blog->id,
					'name' => $blog->name,		
					'url' => $blog->url
				];
			}

			return [
				'status' => true,
				'response' => $myblog
			];
		} catch (Exception $e) {
			return [
				'status' => false,
				'response' => "Fail get listblogger"
			];
		}
	}

	public function ListPosts($client,$blogid,$paging)
	{
		try {
			$blogger = new Google_Service_Blogger($client);	

			$listpost =  $blogger->posts->listPosts($blogid,$paging);

			$mypost = array();
			foreach ($listpost->getItems() as $post) {
				$mypost[] = [
					'id' => $post->id,
					'title' => $post->title,					
					'labels' => $post->labels,		
					'published' => $post->published,
					'updated' => $post->updated,					
					'content' => $post->content,
					'url' => $post->url
				];
			}

			return [
				'status' => true,
				'response' => $mypost,
				'prev' => $listpost->getPrevPageToken(),
				'next' => $listpost->getNextPageToken()
			];
		} catch (Exception $e) {
			return [
				'status' => false,
				'response' => "Fail get listpost"
			];
		}
	}

	/**
	 * Crud
	 */
	public function Create($client,$post)
	{

		$blogger = new Google_Service_Blogger($client);	

		$postblogger = new Google_Service_Blogger_Post();	
		$postblogger->setTitle($post['title']);
		$postblogger->setLabels(explode(',', $post['category']));
		$postblogger->setPublished(date("c", strtotime($post['date'])));
		$postblogger->setContent($post['content']);

		try{

			$insert = $blogger->posts->insert($post['blogid'],$postblogger);

			return [
				'status' => true,
				'response' => $insert
			];
		}
		catch(Google_Service_Exception $e){

			$ReadMessage = json_decode($e->getMessage());
			$message = $ReadMessage->error->message;
			$code = $ReadMessage->error->code;
			$type = $ReadMessage->error->errors[0]->domain;

			// Error Limit
			if ($code == '403' AND $type == 'usageLimits')  {
				return [
					'status' => false,
					'response' => "Fail create post, API Limit "
				];
			}

			return [
				'status' => false,
				'response' => "Fail create post {$type}"
			];
		}
	}

	public function Delete($client, $post)
	{

		$blogger = new Google_Service_Blogger($client);	

		try {
			$delete = $blogger->posts->delete($post['blogid'],$post['postid']);
			return [
				'status' => true,
				'response' => $delete
			];
		} catch (Exception $e) {
			return [
				'status' => false,
				'response' => "Fail delete post"
			];
		}
	}

	public function Read($client, $post)
	{
		$blogger = new Google_Service_Blogger($client);	

		try {
			$read = $blogger->posts->get($post['blogid'],$post['postid']);
			return [
				'status' => true,
				'response' => $read
			];
		} catch (Exception $e) {
			return [
				'status' => false,
				'response' => "Fail read post"
			];
		}
	}

	public function Update($client, $post)
	{
		$blogger = new Google_Service_Blogger($client);	

		try {

			$postblogger = new Google_Service_Blogger_Post();	
			$postblogger->setTitle($post['title']);
			$postblogger->setLabels(explode(',', $post['category']));
			$postblogger->setPublished(date("c", strtotime($post['date'])));
			$postblogger->setContent($post['content']);

			$update = $blogger->posts->update($post['blogid'],$post['postid'],$postblogger);
			return [
				'status' => true,
				'response' => $update
			];
		} catch (Exception $e) {
			return [
				'status' => false,
				'response' => "Fail update post"
			];
		}
	}	

}