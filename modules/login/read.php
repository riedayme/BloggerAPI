<?php defined('BASEPATH') OR exit('no direct script access allowed');

// read previous data
$filename = strip_tags($_GET['read']);
$file = './storage/login/'.$filename;
if (file_exists($file)) {
	$read = file_get_contents($file);
	$read = json_decode($read,true);
}else{
	$_SESSION['error']['message'] = "<strong>Oops</strong>, File not found";
	header("location: ./");
}


$client = $bloggerapi->Auth($read['token']);
$login = $bloggerapi->CheckToken($client);

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