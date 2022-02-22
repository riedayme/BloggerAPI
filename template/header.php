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
								<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-activity" viewBox="0 0 16 16">
									<path fill-rule="evenodd" d="M6 2a.5.5 0 0 1 .47.33L10 12.036l1.53-4.208A.5.5 0 0 1 12 7.5h3.5a.5.5 0 0 1 0 1h-3.15l-1.88 5.17a.5.5 0 0 1-.94 0L6 3.964 4.47 8.171A.5.5 0 0 1 4 8.5H.5a.5.5 0 0 1 0-1h3.15l1.88-5.17A.5.5 0 0 1 6 2Z"/>
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