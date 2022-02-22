<?php defined('BASEPATH') OR exit('no direct script access allowed');?>
<div class="row justify-content-center">
	<div class="col-md-12">
		<main>		

			<?php if (isset($_SESSION['message'])): ?>
				<div class="alert alert-<?php echo $_SESSION['message'][1] ?>" role="alert">
					<?php echo $_SESSION['message'][0] ?>
				</div>	
				<?php unset($_SESSION['message']); ?>
			<?php endif ?>


			<?php if (isset($_GET['blogid'])): ?>

				<?php  
				if (isset($_GET['next'])) {
					$nexprev = $_GET['next'];
					$paging = ['pageToken' => $_GET['next']];
				}elseif (isset($_GET['prev'])) {
					$nexprev = $_GET['prev'];
					$paging = ['pageToken' => $_GET['prev']];
				}else{
					$nexprev = 'index';
					$paging = [];
				}

				$cache = './storage/cache/'.$_GET['blogid'].'-'.$nexprev.'.json';
				if (isset($_SESSION["blog_".$_GET['blogid']]["postlist_".$nexprev])) {
					$readpost = file_get_contents($cache);
					$listpost = json_decode($readpost,true);
				}else{
					$client = $bloggerapi->Auth($_SESSION['login']['token']);
					$listpost = $bloggerapi->ListPosts($client,$_GET['blogid'],$paging);
					file_put_contents($cache, json_encode($listpost));
					//set session for no reprocessing every reload page
					$_SESSION["blog_".$_GET['blogid']]["postlist_".$nexprev] = true;
				}
				?>

				<a class="btn btn-primary" href="?module=create&blogid=<?php echo $_GET['blogid'] ?>">Create</a>

				<table class="table">
					<thead>
						<tr>
							<th scope="col">Title</th>
							<th scope="col">Published</th>
							<th scope="col">Labels</th>							
							<th scope="col">Action</th>
						</tr>
					</thead>
					<tbody id="postcontent">
						<?php foreach ($listpost['response'] as $post): ?>
							<tr>
								<td>
									<a class="text-decoration-none" target="_blank" href="<?php echo $post['url']; ?>"><?php echo $post['title']; ?></a>
								</td>
								<td><?php echo date('d-m-Y H:i:s', strtotime($post['published'])); ?></td>
								<td><?php echo implode(',', $post['labels']); ?></td>
								<td>
									<a class="btn btn-primary" href="?module=update&blogid=<?php echo $_GET['blogid'] ?>&postid=<?php echo $post['id'] ?>">Edit</a>
									<a class="btn btn-primary" href="?module=delete&blogid=<?php echo $_GET['blogid'] ?>&postid=<?php echo $post['id'] ?>">Delete</a>
								</td>
							</tr>						
						<?php endforeach ?>
						<?php if (empty($listpost['response'])): ?>
							<tr>
								<td class="text-center fs-3" colspan="5">
									this blog has no Post
								</td>
							</tr>
						<?php endif ?>
					</tbody>
				</table>

				<nav aria-label="Page navigation example">
					<ul class="pagination">
						<?php if (!empty($listpost['next'])): ?>							
							<li class="page-item loadmore-wrapper"><a id="loadmore" class="page-link" href="./?blogid=<?php echo $_GET['blogid'].'&next='.$listpost['next'] ?>">Loadmore</a></li>
						<?php endif ?>
					</ul>
				</nav>

				<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

				<script type="text/javascript">
					function loadmore()
					{
						var fetch_lock = false;
						$("#loadmore").on('click', function(e){
							if(fetch_lock) return;
							e.preventDefault();
							fetch_lock = true;
							$.ajax({
								url : $(this).attr('href'),
								dataType: 'html',
								success: function(data){
									var source = $(data).find('#postcontent').length ? $(data) : $('<div></div>');
									$("#postcontent").append(source.find('#postcontent').html());
									$(".loadmore-wrapper").html(source.find('#loadmore').clone());
									fetch_lock = false;
									loadmore();
								}
							})       
						});
					}

					loadmore();
				</script>

			<?php else: ?>


				<?php 
				if (isset($_SESSION['listblog'])) {
					$listblog = $_SESSION['listblog'];
				}else{
					$client = $bloggerapi->Auth($_SESSION['login']['token']);
					$listblog = $bloggerapi->ListBlogger($client);
					//set session for no reprocessing every reload page
					$_SESSION['listblog'] = $listblog;				
				}
				?>

				<div class="form-floating">
					<select id="redirectSelect" class="form-select mb-3" name="blogid" aria-label="blogid">
						<option value="" selected disabled>Please select</option>
						<?php foreach ($listblog['response'] as $blog): ?>
							<option value="<?php echo $blog['id'] ?>"><?php echo $blog['name'] ?></option>	
						<?php endforeach ?>
					</select>
					<label>select blog</label>
				</div>

				<script type="text/javascript">
					var selectEl = document.getElementById('redirectSelect');

					selectEl.onchange = function(){
						var goto = "?blogid="+ this.value;
						window.location = goto;
					};				
				</script>
			<?php endif ?>


		</main>
	</div>
</div>