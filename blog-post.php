<?php
	include $_SERVER['DOCUMENT_ROOT'].'/config/init.php';
	$header = 'blog-post';
	include 'inc/header.php';
	if (isset($_GET['id']) && !empty($_GET['id'])) {
		$blog_id = (int)$_GET['id'];
		if($blog_id){
			$Blog = new Blog();
			$blog_info = $Blog->getBlogbyId($blog_id);
			// debugger($blog_info);
			// echo $blog_info[0]->image;
			if ($blog_info) {
				$blog_info = $blog_info[0];
				// echo $blog_info->image;
				if (isset($blog_info->image) && !empty($blog_info->image) && file_exists(UPLOAD_PATH.'blog-image/'.$blog_info->image)) {
						$thumbnail = UPLOAD_URL.'blog-image/'.$blog_info->image;
					}else{
						$thumbnail = UPLOAD_URL.'noimg.png';
				}
				// echo $thumbnail;
			}else{
				// redirect('index.php');
			}
		}else{
			redirect('index.php');
		}
	}else{
		redirect('index.php');
	}
?>		
			<!-- Page Header -->
			<div id="post-header" class="page-header">
				<div class="background-img" style="background-image: url('<?php echo $thumbnail?>');"></div>
				<div class="container">
					<div class="row">
						<div class="col-md-10">
							<div class="post-meta">
								<a class="post-category <?=CAT_COLOR[$blog_info->categoryid%4]?>" href="category.php?<?=$blog_info->categoryid?>"><?=$blog_info->category?></a>
								<span class="post-date"><?=date(('M d Y'), strtotime($blog_info->created_date))?></span>
							</div>
							<h1><?=$blog_info->title?></h1>
						</div>
					</div>
				</div>
			</div>
			<!-- /Page Header -->
		<!-- /Header -->

		<!-- section -->
		<div class="section">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">
					<!-- Post content -->
					<div class="col-md-8">
						<div class="section-row sticky-container">
							<div class="main-post">
								<?=html_entity_decode($blog_info->content)?>
							</div>
							<div class="post-shares sticky-shares">
								<a href="#" class="share-facebook"><i class="fa fa-facebook"></i></a>
								<a href="#" class="share-twitter"><i class="fa fa-twitter"></i></a>
								<a href="#" class="share-google-plus"><i class="fa fa-google-plus"></i></a>
								<a href="#" class="share-pinterest"><i class="fa fa-pinterest"></i></a>
								<a href="#" class="share-linkedin"><i class="fa fa-linkedin"></i></a>
								<a href="#"><i class="fa fa-envelope"></i></a>
							</div>
						</div>

						<!-- ad -->
						<div class="section-row text-center">
							<a href="#" style="display: inline-block;margin: auto;">
								<img class="img-responsive" src="./assets/img/ad-2.jpg" alt="">
							</a>
						</div>
						<!-- ad -->

						<!-- comments -->
						<div class="section-row">
							<div class="section-title">
								<?php
									$Comment = new Comment;
									$no_of_comment = $Comment->getNumberCommentByBlog($blog_id);
									// debugger($no_of_comment);
								?>
								<h2><?=$no_of_comment[0]->total?> Comments</h2>
							</div>

							<div class="post-comments">
								
								<?php
									$comments = $Comment->getAllAcceptCommentByBlog($blog_id);
									if ($comments){
										foreach ($comments as $key => $comment) {
											# code...
								?>
								<!-- comment -->
								<div class="media">
									<div class="media-left">
										<img class="media-object" src="./assets/img/avatar.png" alt="">
									</div>
									<div class="media-body">
										<div class="media-heading">
											<h4><?=$comment->name?></h4>
											<span class="time"><?=date('M d, Y  h:m a ',strtotime($comment->created_date))?></span>
											<a href="javascript:;" class="reply" onclick="reply(this);" data-commentid="<?=$comment->id?>">Reply</a>
										</div>
										<p><?=$comment->message?></p>
										
										<?php
											$replies = $Comment->getAllAcceptReplyByBlogByComment($blog_id,$comment->id);
											// debugger($replies);
											if ($replies){
												foreach ($replies as $key => $reply) {
													# code...
										?>
										<!-- comment -->
										<div class="media">
											<div class="media-left">
												<img class="media-object" src="./assets/img/avatar.png" alt="">
											</div>
											<div class="media-body">
												<div class="media-heading">
													<h4><?=$reply->name?></h4>
													<span class="time"><?=date('M d, Y  h:m a ',strtotime($reply->created_date))?></span>
													<a href="javascript:;" class="reply" onclick="reply(this);" data-commentid="<?=$comment->id?>">Reply</a>
												</div>
												<p><?=$reply->message?></p>
											</div>
										</div>
										<!-- /comment -->
										<?php
												}
											}
										?>
									</div>
								</div>
								<!-- /comment -->
								<?php
										}
									}
								?>
							</div>
						</div>
						<!-- /comments -->

						<!-- reply -->
						<div class="section-row">
							<div class="section-title">
								<h2>Leave a reply</h2>
								<p>your email address will not be published. required fields are marked *</p>
							</div>
							<form class="post-reply" action="process/comment.php" method="POST">
								<div class="row">
									<div class="col-md-4">
										<div class="form-group">
											<span>Name *</span>
											<input class="input" type="text" name="name" required=""/>
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group">
											<span>Email *</span>
											<input class="input" type="email" name="email" required=""/>
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group">
											<span>Website</span>
											<input class="input" type="text" name="website">
										</div>
									</div>
									<div class="col-md-12">
										<div class="form-group">
											<input type="hidden" name="comment_id" id="comment" value="">
											<input type="hidden" name="blog_id" value="<?=$blog_id?>">
											<textarea class="input" name="message" placeholder="Message" required=""/></textarea>
										</div>
										<button class="primary-button">Submit</button>
									</div>
								</div>
							</form>
						</div>
						<!-- /reply -->
					</div>
					<!-- /Post content -->

					<!-- aside -->
					<div class="col-md-4">
						<!-- ad -->
						<div class="aside-widget text-center">
							<a href="#" style="display: inline-block;margin: auto;">
								<img class="img-responsive" src="./assets/img/ad-1.jpg" alt="">
							</a>
						</div>
						<!-- /ad -->

						<div class="aside-widget">
							<div class="section-title">
								<h2>Most Read</h2>
							</div>
							<?php  
								$popularBlog = $Blog->getAllPopularBlogWithLimit(0, 4);
								if($popularBlog){
									foreach ($popularBlog as $key => $blog) {
										# code...
							?>
							<div class="post post-widget">
								<?php
									if (isset($blog->image) && !empty($blog->image) && file_exists(UPLOAD_PATH.'blog-image/'.$blog->image)) {
										$thumbnail = UPLOAD_URL.'blog-image/'.$blog->image;
									}else{
										$thumbnail = UPLOAD_URL.'noimg.png';
									}
								?>
								<a class="post-img" href="blog-post.php?id=<?=$blog->id?>"><img src="<?=$thumbnail?>" alt=""></a>
								<div class="post-body">
									<h3 class="post-title"><a href="blog-post.php?id=<?=$blog->id?>"><?=$blog->title?></a></h3>
								</div>
							</div>
							<?php
									}
								}
							?>
						</div>
						<!-- /post widget -->

						<!-- post widget -->
						<div class="aside-widget">
							<div class="section-title">
								<h2>Featured Posts</h2>
							</div>
							<?php
								$featuredBlog = $Blog->getAllFeaturedBlogWithLimit(0,2);
								// debugger($featuredBlog);
								if($featuredBlog){
									foreach ($featuredBlog as $key => $blog) {
										# code...
							?>
								
							<div class="post post-thumb">
								<?php
									if (isset($blog->image) && !empty($blog->image) && file_exists(UPLOAD_PATH.'blog-image/'.$blog->image)) {
										$thumbnail = UPLOAD_URL.'blog-image/'.$blog->image;
									}else{
										$thumbnail = UPLOAD_URL.'noimg.png';
								}
								?>
								<a class="post-img" href="blog-post.php?id=<?=$blog->id?>"><img src="<?=$thumbnail?>" alt=""></a>
								<div class="post-body">
									<div class="post-meta">
										<a class="post-category <?=CAT_COLOR[$blog->categoryid%4]?>" href="category.php?id=<?=$blog->categoryid?>"><?=$blog->category?></a>
										<span class="post-date"><?=date('M d Y',strtotime($blog->created_date))?></span>
									</div>
									<h3 class="post-title"><a href="blog-post.php?id=<?=$blog->id?>"><?=$blog->title?></a></h3>
								</div>
							</div>
							<?php
									}
								}
							?>
						</div>
						<!-- /post widget -->
						
						<!-- catagories -->
						<div class="aside-widget">
							<div class="section-title">
								<h2>Catagories</h2>
							</div>
							<?php
								$category = new Category();
								$categories = $category->getAllCategory();
								if ($categories){
									// debugger($categories);
									foreach ($categories as $key => $category) {
										// debugger($category);
							?>
							<div class="category-widget">
								<ul>
									<li><a href="category.php?id=<?php echo $category->id ?>" class="<?=CAT_COLOR[$category->id%4]?>"><?=$category->categoryname?>
										<span>
											<?php
												$count = $Blog->getNumberBlogByCategory($category->id);
												echo $count[0]->total;
											?>
										</span>
										</a>
									</li>
								</ul>
							</div>
							<?php
									}
								}
							?>
						</div>
						<!-- /catagories -->
						
						<!-- tags -->
						<div class="aside-widget">
							<div class="tags-widget">
								<ul>
									<?php
										if($categories){
											foreach ($categories as $key => $category) {
									?>
												<li><a href="category.php?id=<?php echo $category->id ?>"><?php echo $category->categoryname?></a></li>
									<?php	
											}
										}
									?>
								</ul>
							</div>
						</div>
						<!-- /tags -->

						<!-- /tags -->
						
						<!-- archive -->
						<div class="aside-widget">
							<div class="section-title">
								<h2>Archive</h2>
							</div>
							<div class="archive-widget">
								<ul>
									<li><a href="#">January 2018</a></li>
									<li><a href="#">Febuary 2018</a></li>
									<li><a href="#">March 2018</a></li>
								</ul>
							</div>
						</div>
						<!-- /archive -->
					</div>
					<!-- /aside -->
				</div>
				<!-- /row -->
			</div>
			<!-- /container -->
		</div>
		<!-- /section -->

<?php
	include 'inc/footer.php';
?>
<script type="text/javascript">
	function reply(self) {
		let commentid = $(self).data('commentid');
		$('#comment').val(commentid);
	}

</script>