<?php defined('BASEPATH') OR exit('no direct script access allowed');
include "template/header.php";
?>
<div class="row justify-content-center">
	<div class="col-md-12">
		<div class="alert alert-primary" role="alert">
			Welcome 
			<?php echo $_SESSION['login']['user'] ?>,
			<a href="?module=logout" class="alert-link text-decoration-none">
				Click here to Logout
			</a>.
		</div>
	</div>
</div>
<?php
include "modules/app/index.php";
include "template/footer.php";
?>