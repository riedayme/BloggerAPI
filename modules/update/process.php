<?php 
$client = $bloggerapi->Auth($_SESSION['login']['token']);
$publish = $bloggerapi->Update($client,$_POST);
if ($publish['status']) {
	$_SESSION['message'] = ["Success Update Post","success"];
	// unset all sessin cache
	unset($_SESSION["blog_".$_POST['blogid']]);
}else{
	$_SESSION['message'] = [$delete['response'],"danger"];
}

header("Location:./?blogid=".$_POST['blogid']);
?>