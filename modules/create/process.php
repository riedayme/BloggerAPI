<?php 
$client = $bloggerapi->Auth($_SESSION['login']['token']);
$publish = $bloggerapi->Create($client,$_POST);
if ($publish['status']) {
	$_SESSION['message'] = ["Success Create Post","success"];
	// unset all sessin cache
	unset($_SESSION["blog_".$_POST['blogid']]);
}else{
	$_SESSION['message'] = [$delete['response'],"danger"];
}

header("Location:./?blogid=".$_POST['blogid']);
?>