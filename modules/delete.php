<?php 
$client = $bloggerapi->Auth($_SESSION['login']['token']);
$delete = $bloggerapi->Delete($client,$_GET);
if ($delete['status']) {
	$_SESSION['message'] = ["Success Delete Post","success"];
	// unset all sessin cache
	unset($_SESSION["blog_".$_GET['blogid']]);
}else{
	$_SESSION['message'] = [$delete['response'],"danger"];
}

header("Location:./?blogid=".$_GET['blogid']);
?>