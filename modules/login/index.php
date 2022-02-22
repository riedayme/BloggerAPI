<?php defined('BASEPATH') OR exit('no direct script access allowed');
$client = $bloggerapi->Auth();
?>
<div class="row justify-content-start">
	<div class="col-md-6">
		<main>				

			<?php if (isset($_SESSION['error'])): ?>
				<div class="alert alert-danger alert-dismissible fade show" role="alert">
					<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2" viewBox="0 0 16 16" role="img" aria-label="Warning:">
						<path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"></path>
					</svg>
					<?php echo $_SESSION['error']['message']; ?>
					<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
				</div>
				<?php unset($_SESSION['error']); ?>
			<?php endif ?>

			<p>
				First must login (google account) to get accesstoken for connecting with api
			</p>
			<a href="<?php echo $client->createAuthUrl(); ?>" class="btn btn-primary">
				Login
				<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-send" viewBox="0 0 16 16">
					<path d="M15.854.146a.5.5 0 0 1 .11.54l-5.819 14.547a.75.75 0 0 1-1.329.124l-3.178-4.995L.643 7.184a.75.75 0 0 1 .124-1.33L15.314.037a.5.5 0 0 1 .54.11ZM6.636 10.07l2.761 4.338L14.13 2.576 6.636 10.07Zm6.787-8.201L1.591 6.602l4.339 2.76 7.494-7.493Z"/>
				</svg>
			</a>

			<div class="mt-5">
				<?php  
				$dir = './storage/login/';
				$files = glob($dir.'*.json');
				usort($files, function($a, $b) {
					return filemtime($b) - filemtime($a);
				});

				if (count($files) > 0) {
					?>
					<h3 class="fs-4">
						Previous Login
					</h3>
					<div>
						<?php
						$badge = ['bg-primary', 'bg-secondary', 'bg-success', 'bg-danger', 'bg-info'];
						foreach($files as $file){
							$read = file_get_contents($file);
							$read = json_decode($read,true);
							?>
							<a class="badge <?php echo $badge[array_rand($badge)] ?> text-decoration-none" href="./?read=<?php echo basename($file); ?>"><?php echo $read['user']; ?></a>
							<?php
						}
						?>
					</div>
					<?php
				}
				?>
			</div>
		</main>
	</div>
</div>