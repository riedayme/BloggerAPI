<?php defined('BASEPATH') OR exit('no direct script access allowed');?>
<div class="row justify-content-start">
	<div class="col-md-6">
		<main>		

			<?php if (isset($_SESSION['message'])): ?>
				<div class="alert alert-<?php echo $_SESSION['message'][1] ?>" role="alert">
					<?php echo $_SESSION['message'][0] ?>
				</div>	
				<?php unset($_SESSION['message']); ?>
			<?php endif ?>

			<h2>
				Form <?php echo $title; ?>
				<a href="?blogid=<?php echo $_GET['blogid'] ?>">Back</a>
			</h2>			

			<form method="POST">

				<div class="form-floating mb-3">
					<input class="form-control" type="text" name="blogid" placeholder="blogid" readonly="" value="<?php echo $_GET['blogid'] ?>" />
					<label>blogid</label>
				</div>

				<div class="form-floating mb-3">
					<input class="form-control" type="text" name="title" placeholder="title"/>
					<label>title</label>
				</div>

				<div class="form-floating mb-3">
					<input class="form-control" type="text" name="category" placeholder="category"/>
					<label>category</label>
					<div id="emailHelp" class="form-text">sparete with , if have two or more category</div>
				</div>

				<div class="form-floating mb-3">
					<input class="form-control" type="date" name="date" placeholder="date" />
					<label>date</label>
				</div>

				<div class="form-floating mb-3">
					<textarea class="form-control" name="content" style="height: 200px" placeholder="content"></textarea>
					<label>content</label>
				</div>

				<button type="submit" class="btn btn-primary">
					Post
					<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-send" viewBox="0 0 16 16">
						<path d="M15.854.146a.5.5 0 0 1 .11.54l-5.819 14.547a.75.75 0 0 1-1.329.124l-3.178-4.995L.643 7.184a.75.75 0 0 1 .124-1.33L15.314.037a.5.5 0 0 1 .54.11ZM6.636 10.07l2.761 4.338L14.13 2.576 6.636 10.07Zm6.787-8.201L1.591 6.602l4.339 2.76 7.494-7.493Z"/>
					</svg>
				</button>
			</form>

		</main>
	</div>
</div>