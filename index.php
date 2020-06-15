<?php
	include $_SERVER['DOCUMENT_ROOT'].'/config/init.php';
	include 'inc/header.php';
	
?>

		<!-- section -->
		<div class="section">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">	
					<?php
						$Blog = new Blog;
						$featuredBlog = $Blog->getAllFeaturedBlogWithLimit(2,2);
						// debugger($featuredBlog);
						if ($featuredBlog){
							foreach ($featuredBlog as $key => $blog) {
								# code...
					?>
					<!-- /post -->
					<div class="col-md-6">
						<div class="post post-thumb">
							<?php
								if(isset($blog->image) && !empty($blog->image) && file_exists(UPLOAD_PATH.'blog-image/'.$blog->image)){
 									$thumbnail = UPLOAD_URL.'blog-image/'.$blog->image;
								}else{
									$thumbnail = UPLOAD_URL.'noimg.png';
								}
							?>
							<a class="post-img" href="blog-post.php?id=<?=$blog->id?>"><img src="<?=$thumbnail?>" alt=""></a>
							<div class="post-body">
								<div class="post-meta">
									<a class="post-category <?=CAT_COLOR[$blog->categoryid%4]?>" href="category.php?id=<?=$blog->categoryid?>"><?=$blog->category?></a>
									<span class="post-date"><?=date('M d Y', strtotime($blog->created_date))?></span>
								</div>
								<h3 class="post-title"><a href="blog-post.php?id=<?=$blog->id?>"><?=$blog->title?></a></h3>
							</div>
						</div>
					</div>
					<!-- /post -->
					<?php
							}
						}	

					?>
				</div>
				<!-- /row -->

				<!-- row -->
				<div class="row">
					<div class="col-md-12">
						<div class="section-title">
							<h2>Recent Posts</h2>
						</div>
					</div>
					<?php
						$recentBlog = $Blog->getAllRecentBlogWithLimit(2,6);
						if ($recentBlog){
							foreach ($recentBlog as $key => $blog) {
								
					?>
					<!-- post -->
					<div class="col-md-4">
						<div class="post">
							<?php
								if(isset($blog->image) && !empty($blog->image) && file_exists(UPLOAD_PATH.'blog-image/'.$blog->image)){
 									$thumbnail = UPLOAD_URL.'blog-image/'.$blog->image;
								}else{
									$thumbnail = UPLOAD_URL.'noimg.png';
								}
							?>
							<a class="post-img" href="blog-post.php?id=<?=$blog->id?>"><img src="<?=$thumbnail?>" alt=""></a>
							<div class="post-body">
								<div class="post-meta">
									<a class="post-category <?=CAT_COLOR[$blog->categoryid%4]?>" href="category.php?id=<?=$blog->categoryid?>"><?=$blog->category?></a>
									<span class="post-date"><?=date('M d Y', strtotime($blog->created_date))?></span>
								</div>
								<h3 class="post-title"><a href="blog-post.php?id=<?=$blog->id?>"><?=$blog->title?></a></h3>
							</div>
						</div>
					</div>
					<!-- /post -->
					<?php
							}
						}	

					?>
				</div>
				<!-- /row -->

				<!-- row -->
				<div class="row">
					<div class="col-md-8">
						<div class="row">
							<?php
								$popularBlog = $Blog->getAllPopularBlogWithLimit(0,1);
								if ($popularBlog){
									foreach ($popularBlog as $key => $blog) {
										
							?>
							<!-- post -->
							<div class="col-md-12">
								<div class="post post-thumb">
									<?php
										if(isset($blog->image) && !empty($blog->image) && file_exists(UPLOAD_PATH.'blog-image/'.$blog->image)){
		 									$thumbnail = UPLOAD_URL.'blog-image/'.$blog->image;
										}else{
											$thumbnail = UPLOAD_URL.'noimg.png';
										}
									?>
									<a class="post-img" href="blog-post.php?id=<?=$blog->id?>"><img src="<?=$thumbnail?>" alt=""></a>
									<div class="post-body">
										<div class="post-meta">
											<a class="post-category <?=CAT_COLOR[$blog->categoryid%4]?>" href="category.php?id=<?=$blog->categoryid?>"><?=$blog->category?></a>
											<span class="post-date"><?=date('M d Y', strtotime($blog->created_date))?></span>
										</div>
										<h3 class="post-title"><a href="blog-post.php?id=<?=$blog->id?>"><?=$blog->title?></a></h3>
									</div>
								</div>
							</div>
							<!-- /post -->
							<?php
									}
								}
							?>

							<?php
								$popularBlog = $Blog->getAllPopularBlogWithLimit(1,6);
								if ($popularBlog){
									foreach ($popularBlog as $key => $blog) {
										
							?>
							<!-- post -->
							<div class="col-md-6">
								<div class="post">
									<?php
										if(isset($blog->image) && !empty($blog->image) && file_exists(UPLOAD_PATH.'blog-image/'.$blog->image)){
		 									$thumbnail = UPLOAD_URL.'blog-image/'.$blog->image;
										}else{
											$thumbnail = UPLOAD_URL.'noimg.png';
										}
									?>
									<a class="post-img" href="blog-post.php?id=<?=$blog->id?>"><img src="<?=$thumbnail?>" alt=""></a>
									<div class="post-body">
										<div class="post-meta">
											<a class="post-category <?=CAT_COLOR[$blog->categoryid%4]?>" href="category.php?id=<?=$blog->categoryid?>"><?=$blog->category?></a>
											<span class="post-date"><?=date('M d Y', strtotime($blog->created_date))?></span>
										</div>
										<h3 class="post-title"><a href="blog-post.php?id=<?=$blog->id?>"><?=$blog->title?></a></h3>
									</div>
								</div>
							</div>
							<!-- /post -->
							<?php
									}
								}
							?>
						</div>
					</div>

					<div class="col-md-4">
						<!-- post widget -->
						<div class="aside-widget">
							<div class="section-title">
								<h2>Most Read</h2>
							</div>

							<?php
								$popularBlog = $Blog->getAllPopularBlogWithLimit(0,4);
								if ($popularBlog){
									foreach ($popularBlog as $key => $blog) {
										
							?>
							<div class="post post-widget">
								<?php
									if(isset($blog->image) && !empty($blog->image) && file_exists(UPLOAD_PATH.'blog-image/'.$blog->image)){
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
								if ($featuredBlog){
									foreach ($featuredBlog as $key => $blog) {
										
							?>

							<div class="post post-thumb">
								<?php
									if(isset($blog->image) && !empty($blog->image) && file_exists(UPLOAD_PATH.'blog-image/'.$blog->image)){
	 									$thumbnail = UPLOAD_URL.'blog-image/'.$blog->image;
									}else{
										$thumbnail = UPLOAD_URL.'noimg.png';
									}
								?>
								<a class="post-img" href="blog-post.php?id=<?=$blog->id?>"><img src="<?=$thumbnail?>" alt=""></a>
								<div class="post-body">
									<div class="post-meta">
										<a class="post-category <?=CAT_COLOR[$blog->categoryid%4]?>" href="category.php?id=<?=$blog->categoryid?>"><?=$blog->category?></a>
										<span class="post-date"><?=date('M d Y', strtotime($blog->created_date))?></span>
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
						
						<!-- ad -->
						<div class="aside-widget text-center">
							<a href="#" style="display: inline-block;margin: auto;">
								<img class="img-responsive" src="assets/img/ad-1.jpg" alt="">
							</a>
						</div>
						<!-- /ad -->
					</div>
				</div>
				<!-- /row -->
			</div>
			<!-- /container -->
		</div>
		<!-- /section -->
		
		<!-- section -->
		<div class="section section-grey">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">
					<div class="col-md-12">
						<div class="section-title text-center">
							<h2>Featured Posts</h2>
						</div>
					</div>

					<?php
						$featuredBlog = $Blog->getAllFeaturedBlogWithLimit(2,3);
						if ($featuredBlog){
							foreach ($featuredBlog as $key => $blog) {
								
					?>
					<!-- post -->
					<div class="col-md-4">
						<div class="post">
							<?php
								if(isset($blog->image) && !empty($blog->image) && file_exists(UPLOAD_PATH.'blog-image/'.$blog->image)){
 									$thumbnail = UPLOAD_URL.'blog-image/'.$blog->image;
								}else{
									$thumbnail = UPLOAD_URL.'noimg.png';
								}
							?>
							<a class="post-img" href="blog-post.php?id=<?=$blog->id?>"><img src="<?=$thumbnail?>" alt=""></a>
							<div class="post-body">
								<div class="post-meta">
									<a class="post-category <?=CAT_COLOR[$blog->categoryid%4]?>" href="category.php?id=<?=$blog->categoryid?>"><?=$blog->category?></a>
									<span class="post-date"><?=date('M d Y', strtotime($blog->created_date))?></span>
								</div>
								<h3 class="post-title"><a href="blog-post.php?id=<?=$blog->id?>"><?=$blog->title?></a></h3>
							</div>
						</div>
					</div>
					<!-- /post -->
					<?php
							}
						}
					?>

				</div>
				<!-- /row -->
			</div>
			<!-- /container -->
		</div>
		<!-- /section -->

		<!-- section -->
		<div class="section">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">
					<div class="col-md-8">
						<div class="row">
							<div class="col-md-12">
								<div class="section-title">
									<h2>Most Read</h2>
								</div>
							</div>
							<?php
								$popularBlog = $Blog->getAllPopularBlogWithLimit(0,4);
								if ($popularBlog){
									foreach ($popularBlog as $key => $blog) {
										
							?>
							<!-- post -->
							<div class="col-md-12">
								<div class="post post-row">
									<?php
										if(isset($blog->image) && !empty($blog->image) && file_exists(UPLOAD_PATH.'blog-image/'.$blog->image)){
		 									$thumbnail = UPLOAD_URL.'blog-image/'.$blog->image;
										}else{
											$thumbnail = UPLOAD_URL.'noimg.png';
										}
									?>
									<a class="post-img" href="blog-post.php?id=<?=$blog->id?>"><img src="<?=$thumbnail?>" alt=""></a>
									<div class="post-body">
										<div class="post-meta">
											<a class="post-category <?=CAT_COLOR[$blog->categoryid%4]?>" href="category.php?id=<?=$blog->categoryid?>"><?=$blog->category?></a>
											<span class="post-date"><?=date('M d Y', strtotime($blog->created_date))?></span>
										</div>
										<h3 class="post-title"><a href="blog-post.php?id=<?=$blog->id?>"><?=$blog->title?></a></h3>
										<p><?=substr(html_entity_decode($blog->content),0,200).'...'?></p>
									</div>
								</div>
							</div>
							<!-- /post -->
							<?php
									}
								}
							?>
							<div id="filter_data" data-limit='0'></div>
							
							<div class="col-md-12">
								<div class="section-row">
									<button class="primary-button center-block" id="loadmore">Load More</button>
								</div>
							</div>
						</div>
					</div>

					<div class="col-md-4">
						<!-- ad -->
						<div class="aside-widget text-center">
							<a href="#" style="display: inline-block;margin: auto;">
								<img class="img-responsive" src="assets/img/ad-1.jpg" alt="">
							</a>
						</div>
						<!-- /ad -->
						
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
									<li><a href="category.php?id=<?php echo $category->id?>" class="<?=CAT_COLOR[$category->id%4]?>"><?=$category->categoryname?>
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
						
						<!-- archive -->
						<div class="aside-widget">
							<div class="section-title">
								<h2>Archive</h2>
							</div>
							<div class="archive-widget">
								<ul>
									<li><a href="#">Jan 2018</a></li>
									<li><a href="#">Feb 2018</a></li>
									<li><a href="#">Mar 2018</a></li>
								</ul>
							</div>
						</div>
						<!-- /archive -->
					</div>
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
	$(document).ready(function(){
		$('#loadmore').on('click', function(){
			console.log("test");
			limit = $('#filter_data').data('limit') + 4;
			$('#filter_data').data('limit', limit);
			console.log(limit);
			$.post('ajax_fetch/fetch_data.php',{
				limit: limit,
				offset: 4
			},function(data, status){
				console.log(status);
				$('#filter_data').html(data);
			});
		});
	});

</script>