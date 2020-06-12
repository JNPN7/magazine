<?php
	include $_SERVER['DOCUMENT_ROOT'].'/config/init.php';
	$header = 'category';
	if (isset($_GET['id']) && !empty($_GET['id'])) {
		$cat_id = (int)$_GET['id'];
		if($cat_id){
			$category = new Category();
			$category_info = $category->getCategorybyId($cat_id);
			// debugger($category_info);
			if ($category_info) {
				$category_info = $category_info[0];
				$bread = $category_info->categoryname ;
			}else{
				redirect('index.php');
			}
		}else{
			redirect('index.php');
		}
	}else{
		redirect('index.php');
	}
	include 'inc/header.php';
?>
		
		<!-- section -->
		<div class="section">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">
					<div class="col-md-8">
						<div class="row">
							<!-- post -->
							<?php
								$Blog = new Blog;
								$featuredBlog = $Blog->getAllFeaturedBlogByCategoryWithLimit($cat_id, 0, 3);
								if (isset($featuredBlog) && !empty($featuredBlog)){
									// debugger($featuredBlog);							}
							?>
							<div class="col-md-12">
								<div class="post post-thumb">
									<?php
										if (isset($featuredBlog[0]->image) && !empty($featuredBlog[0]->image) && file_exists(UPLOAD_PATH.'blog-image/'.$featuredBlog[0]->image)) {
											$thumbnail = UPLOAD_URL.'blog-image/'.$featuredBlog[0]->image;
										}else{
											$thumbnail = UPLOAD_URL.'noimg.png';
									}
									?>
									<a class="post-img" href="blog-post.php?id=<?=$featuredBlog[0]->id?>"><img src="<?=$thumbnail?>" alt=""></a>
									<div class="post-body">
										<div class="post-meta">
											<a class="post-category  <?=CAT_COLOR[$cat_id%4]?>" href="category.php?id=<?=$recent->categoryid?>"><?=$featuredBlog[0]->category?></a>
											<span class="post-date"><?=date('M d Y',strtotime($featuredBlog[0]->created_date))?></span>
										</div>
										<h3 class="post-title"><a href="blog-post.php?id=<?=$featuredBlog[0]->id?>"><?=$featuredBlog[0]->title?></a></h3>
									</div>
								</div>
							</div>
							<!-- /post -->
										
							<!-- post -->
							<div class="col-md-6">
								<div class="post">
									<?php
										if (isset($featuredBlog[1]->image) && !empty($featuredBlog[1]->image) && file_exists(UPLOAD_PATH.'blog-image/'.$featuredBlog[1]->image)) {
											$thumbnail = UPLOAD_URL.'blog-image/'.$featuredBlog[1]->image;
										}else{
											$thumbnail = UPLOAD_URL.'noimg.png';
									}
									?>
									<a class="post-img" href="blog-post.php?id=<?=$featuredBlog[1]->id?>"><img src="<?=$thumbnail?>" alt=""></a>
									<div class="post-body">
										<div class="post-meta">
											<a class="post-category  <?=CAT_COLOR[$cat_id%4]?>" href="category.php?id=<?=$recent->categoryid?>"><?=$featuredBlog[1]->category?></a>
											<span class="post-date"><?=date('M d Y',strtotime($featuredBlog[1]->created_date))?></span>
										</div>
										<h3 class="post-title"><a href="blog-post.php?id=<?=$featuredBlog[1]->id?>"><?=$featuredBlog[1]->title?></a></h3>
									</div>
								</div>
							</div>
							<!-- /post -->

							<!-- post -->
							<div class="col-md-6">
								<div class="post">
									<?php
										if (isset($featuredBlog[2]->image) && !empty($featuredBlog[2]->image) && file_exists(UPLOAD_PATH.'blog-image/'.$featuredBlog[2]->image)) {
											$thumbnail = UPLOAD_URL.'blog-image/'.$featuredBlog[2]->image;
										}else{
											$thumbnail = UPLOAD_URL.'noimg.png';
									}
									?>
									<a class="post-img" href="blog-post.php?id=<?=$featuredBlog[2]->id?>"><img src="<?=$thumbnail?>" alt=""></a>
									<div class="post-body">
										<div class="post-meta">
											<a class="post-category  <?=CAT_COLOR[$cat_id%4]?>" href="category.php?id=<?=$recent->categoryid?>"><?=$featuredBlog[2]->category?></a>
											<span class="post-date"><?=date('M d Y',strtotime($featuredBlog[2]->created_date))?></span>
										</div>
										<h3 class="post-title"><a href="blog-post.php?id=<?=$featuredBlog[2]->id?>"><?=$featuredBlog[2]->title?></a></h3>
									</div>
								</div>
							</div>
							<?php
								}
							?>
							<!-- /post -->
							
							<div class="clearfix visible-md visible-lg"></div>
							
							<!-- ad -->
							<div class="col-md-12">
								<div class="section-row">
									<a href="#">
										<img class="img-responsive center-block" src="./assets/img/ad-2.jpg" alt="">
									</a>
								</div>
							</div>
							<!-- ad -->
							
							<!-- post -->
							<?php
								$recentBlog = $Blog->getAllRecentBlogByCategoryWithLimit($cat_id, 0, 4);
								if (isset($recentBlog) && !empty($recentBlog)){
									foreach ($recentBlog as $key => $recent) {
									
							?>
							<div class="col-md-12">
								<div class="post post-row">
									<?php
										if (isset($recent->image) && !empty($recent->image) && file_exists(UPLOAD_PATH.'blog-image/'.$recent->image)) {
											$thumbnail = UPLOAD_URL.'blog-image/'.$recent->image;
										}else{
											$thumbnail = UPLOAD_URL.'noimg.png';
									}
									?>

									<a class="post-img" href="blog-post.php?id=<?=$recent->id?>"><img src="<?=$thumbnail?>" alt=""></a>
									<div class="post-body">
										<div class="post-meta">
											<a class="post-category <?=CAT_COLOR[$recent->categoryid%4]?>" href="category.php?id=<?=$recent->categoryid?>"><?=$recent->category?></a>
											<span class="post-date"><?=date('M d Y',strtotime($recent->created_date))?></span>
										</div>
										<h3 class="post-title"><a href="blog-post.php?id=<?=$recent->id?>"><?=$recent->title?></a></h3>
										<p><?php echo substr(html_entity_decode($recent->content), 0,200)."...<br>" ?></p>
									</div>
								</div>
							</div>
							<!-- /post -->
							<?php
									}
								}
							?>
							<div id="filter_data" data-limit='0' data-categoryid='<?=$category_info->id?>'></div>
							
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
								<img class="img-responsive" src="./assets/img/ad-1.jpg" alt="">
							</a>
						</div>
						<!-- /ad -->
						
						<!-- post widget -->
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
			categoryid = $('#filter_data').data('categoryid');
			limit = $('#filter_data').data('limit') + 4;
			$('#filter_data').data('limit', limit);
			console.log(limit);
			console.log(categoryid);
			$.post('ajax_fetch/fetch_data.php',{
				limit: limit,
				offset: 4,
				categoryid: categoryid
			},function(data, status){
				console.log(status);
				$('#filter_data').html(data);
			});
		});
	});

</script>