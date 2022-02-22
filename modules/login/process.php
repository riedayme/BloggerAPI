<?php defined('BASEPATH') OR exit('no direct script access allowed');

$client = $bloggerapi->Auth();
$login = $bloggerapi->GetToken($client,$_GET['code']);

// set session
if ($login['status']) {
	
	$_SESSION['login'] = $login['response'];

	// set cookie
	$cookie_expiration_time = time() + (24 * 60 * 60);  // for 1 day
	setcookie("login", json_encode(['value' => $login['response']['id'], 'expired' => $cookie_expiration_time]), $cookie_expiration_time, "/");

	// save login
	file_put_contents('./storage/login/'.$login['response']['id'].'.json', json_encode($login['response'],JSON_PRETTY_PRINT));

}else {
	$_SESSION['error']['message'] = "<strong>Oops</strong>, ".$login['response'];
}


header("location: ./");