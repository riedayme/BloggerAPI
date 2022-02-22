<?php defined('BASEPATH') OR exit('no direct script access allowed');?>

<div class="modal fade" id="about" tabindex="-1" aria-labelledby="about" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content bg-dark">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">About</h5>
				<button type="button" class="btn-close bg-light" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<table class="table table-bordered text-light">
					<tbody>
						<tr>
							<td>Name</td>
							<td>
								<?php echo $appinfo['name']; ?>
							</td>
						</tr>
						<tr>
							<td>Version</td>
							<td>
								<?php echo $appinfo['version']; ?>
							</td>
						</tr>
						<tr>
							<td>Creator</td>
							<td>
								<?php echo $appinfo['creator']; ?>
							</td>
						</tr>
						<tr>
							<td>Contact</td>
							<td>
								<a target="_blank" href="<?php echo $appinfo['contact']; ?>">Facebook</a>
							</td>
						</tr>
						<tr>
							<td class=" u-text-center" colspan="2">Build With</td>
						</tr>
						<tr>
							<td class="u-p-medium u-text-bold" colspan="2">
								<span class="badge mb-1 bg-info">Bootstrap 5</span>&nbsp;
								<span class="badge mb-1 bg-primary">PHP Native</span>
							</td>
						</tr>  
						<tr>
							<td colspan="2">
								&copy;<?php echo date('Y').' '.$appinfo['name'] ?>
							</td>
						</tr>     
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>