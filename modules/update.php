<?php defined('BASEPATH') OR exit('no direct script access allowed');
if ($_POST) {
	include "modules/update/process.php";
}else{	
	$title = 'Update';
	include "template/header.php";
	include "modules/update/index.php";
	include "template/footer.php";
}
?>