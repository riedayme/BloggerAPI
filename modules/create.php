<?php defined('BASEPATH') OR exit('no direct script access allowed');
if ($_POST) {
	include "modules/create/process.php";
}else{	
	$title = 'Create';
	include "template/header.php";
	include "modules/create/index.php";
	include "template/footer.php";
}
?>