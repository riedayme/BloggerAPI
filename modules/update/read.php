<?php 
$client = $bloggerapi->Auth($_SESSION['login']['token']);
$publish = $bloggerapi->Read($client,$_GET);
$read = $publish['response'];
?>