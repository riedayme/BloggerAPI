<?php defined('BASEPATH') OR exit('no direct script access allowed');


if (isset($_GET['code'])) {
	include "modules/login/process.php";
}elseif (isset($_GET['read'])) {
	include "modules/login/read.php";
}else{	
	$is_index = true;
	include "template/header.php";

	include "modules/login/index.php";

	include "template/footer.php";
}
?>