<?php 
	include $_SERVER['DOCUMENT_ROOT'].'/config/init.php';
	$header = 'about';
	$bread = 'About Us';
	include 'inc/header.php';
?>
		
		<!-- section -->
		<div class="section">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">
					<div class="col-md-8">
						<div class="section-row">
							<p>We made this site just for fun nothing else. You won't get any important information from this site. Just check the website and get the hell out of here. Just go and do some progessive. It's just waste of time to be in this website. Go Just Go.</p>
							<figure class="figure-img">
								<img class="img-responsive" src="./img/about-1.jpg" alt="">
							</figure>
							<p>Didn't I just made it clear???. Why?? Why are you still reading this?? Why are you wasting your time. Oh I get it you think there's no importance of you and your time for this world. See Child that's absort, every life on this world has importane except you Hahahahaha.. You thought this world need you? No, It doesn't so go fuck yourself.Get the Hell out of here..</p>
						</div>
						<div class="row section-row">
							<div class="col-md-6">
								<figure class="figure-img">
									<img class="img-responsive" src="./img/about-2.jpg" alt="">
								</figure>
							</div>
							<div class="col-md-6">
								<h3>Our Mission</h3>
								<p>Nothing Just playing around</p>
								<ul class="list-style">
									<li><p>To Make it clear this world don't need you</p></li>
									<li><p>Why are you still alive die</p></li>
									<li><p>Who the hell are you to tell my mission</p></li>
								</ul>
							</div>
						</div>
					</div>
					
					<!-- aside -->
					<div class="col-md-4">
						<!-- ad -->
						<div class="aside-widget text-center">
							<a href="#" style="display: inline-block;margin: auto;">
								<img class="img-responsive" src="./img/ad-1.jpg" alt="">
							</a>
						</div>
						<!-- /ad -->

						<!-- post widget -->
						<div class="aside-widget">
							<div class="section-title">
								<h2>Most Read</h2>
							</div>
							<?php  
								$Blog = new Blog;
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