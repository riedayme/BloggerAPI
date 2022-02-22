<?php define('BASEPATH', true); // protect script from direct access

require "includes/helper.php";
require "includes/config.php";

// call library here
require "library/BloggerAPI.php";
// call api config
require "includes/api.php";

$bloggerapi = new BLoggerAPI([
	'client_id' => $client_id,
	'client_secret' => $client_secret,
	'redirect' => base_url()
]);

switch (@$_GET['module']) {	

	case 'create':
	include "modules/create.php";
	break;

	case 'update':
	include "modules/update.php";
	break;

	case 'delete':
	include "modules/delete.php";
	break;

	case 'logout':
	include "modules/logout.php";
	break;

	default:
	if (!isset($_SESSION['login'])) {
		include "modules/login.php";
	}else{
		include "modules/app.php";
	}
	break;
}
?>