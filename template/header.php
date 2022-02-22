<?php defined('BASEPATH') OR exit('no direct script access allowed');?>
<!DOCTYPE html>
<html lang="en" class="h-100">
<head>

	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<?php if (isset($title)): ?>
		<title><?php echo $title.' - '.$webconfig['title']; ?></title>
	<?php else: ?>
		<title><?php echo $webconfig['title']; ?></title>
	<?php endif ?>

	<!-- Bootstrap CSS -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body class="d-flex flex-column h-100">

	<div class="flex-shrink-0 mb-5">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-md-12">

					<header class="px-4 py-4 mt-5 border border-primary mb-3">
						<a class="text-decoration-none" href="./">
							<h1 class="fs-3 fw-bold">
								<svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-facebook" viewBox="0 0 16 16">
									<path d="M16 8.049c0-4.446-3.582-8.05-8-8.05C3.58 0-.002 3.603-.002 8.05c0 4.017 2.926 7.347 6.75 7.951v-5.625h-2.03V8.05H6.75V6.275c0-2.017 1.195-3.131 3.022-3.131.876 0 1.791.157 1.791.157v1.98h-1.009c-.993 0-1.303.621-1.303 1.258v1.51h2.218l-.354 2.326H9.25V16c3.824-.604 6.75-3.934 6.75-7.951z"/>
								</svg>

								<?php echo $webconfig['title']; ?>
								
							</h1>
						</a>
						<p>
							<?php echo $webconfig['description']; ?>
						</p>
					</header>

				</div>
			</div>