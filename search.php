<?php
	include $_SERVER['DOCUMENT_ROOT'].'/config/init.php';
	$header = 'Search';
	include 'inc/header.php';
	$search = $_POST['search'];
	$searchin = 'content';
?>
		
		<!-- section -->
		<div class="section">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">
					<div class="col-md-8">
						<div class="row">
						
							<?php
								$Blog = new Blog;
								$searchBlog = $Blog->getBlogbySearch($search, 'content', 0, 6);
								if($searchBlog){
									foreach ($searchBlog as $key => $blog) {
										# code...
							?>
							<!-- post -->
							<div class="col-md-12">
								<div class="post post-row">
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
										<p><?php echo substr(html_entity_decode($blog->content), 0,200)."...<br>" ?></p>
									</div>
								</div>
							</div>
							<div id="filter_data" data-search="<?=$search?>" data-searchin="<?=$searchin?>" data-limit='0'></div>
							
							<div class="col-md-12">
								<div class="section-row">
									<button id="loadmore" class="primary-button center-block">Load More</button>
								</div>
							</div>
							<!-- /post -->
							<?php
									}
								}else{
							?>
								<div>
									<p style="text-align: center;">Sorry!!!  No Results</p>
								</div>
							<?php
								}
							?>
							
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
			searchin = $('#filter_data').data('searchin');
			search = $('#filter_data').data('search');
			limit = $('#filter_data').data('limit') + 4;
			$('#filter_data').data('limit', limit);
			console.log(limit);
			console.log(search);
			$.post('ajax_fetch/fetch_data.php',{
				limit: limit,
				offset: 6,
				search: search,
				searchin: searchin
			},function(data, status){
				console.log(status);
				$('#filter_data').html(data);
			});
		});
	});

</script>