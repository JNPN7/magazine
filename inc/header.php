<?php
	define('CAT_COLOR', ['cat-1','cat-2','cat-3','cat-4']);
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		 <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

		<title><?php echo(isset($header)&&!empty($header)? 'HAHAMAG | '.$header : 'HAHAMAG');?></title>

		<!-- Google font -->
		<link href="https://fonts.googleapis.com/css?family=Nunito+Sans:700%7CNunito:300,600" rel="stylesheet"> 

		<!-- Bootstrap -->
		<link type="text/css" rel="stylesheet" href="assets/css/bootstrap.min.css"/>

		<!-- Font Awesome Icon -->
		<link rel="stylesheet" href="assets/css/font-awesome.min.css">

		<!-- Custom stlylesheet -->
		<link type="text/css" rel="stylesheet" href="assets/css/style.css"/>

		<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
		  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
		  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->

    </head>
	<body>

		<!-- Header -->
		<header id="header">
			<!-- Nav -->
			<div id="nav">
				<!-- Main Nav -->
				<div id="nav-fixed">
					<div class="container">
						<!-- logo -->
						<div class="nav-logo">
							<a href="index.php" class="logo"><img src="./assets/img/logo.png" alt=""></a>
						</div>
						<!-- /logo -->

						<!-- nav -->
						<ul class="nav-menu nav navbar-nav">
							<?php
								$Category = new Category;
								$categories = $Category->getAllCategory();
								if ($categories){
									foreach ($categories as $key => $category) {
										// debugger($category);
							?>
							<li class="<?=CAT_COLOR[$category->id%4]?>"><a href="category.php?id=<?=$category->id?>"><?=$category->categoryname?></a></li>
							<?php
									}
								}
							?>

						</ul>
						<!-- /nav -->

						<!-- search & aside toggle -->
						<div class="nav-btns">
							<button class="aside-btn"><i class="fa fa-bars"></i></button>
							<button class="search-btn"><i class="fa fa-search"></i></button>
							<form class="search-form" action="search.php" method="POST">
									<input id="search_input" class="search-input" type="text" name="search" placeholder="Enter Your Search ...">
									<button class="search-close"><i class="fa fa-times"></i></button>
									<div id='search_filter' style="background: #fff"></div>
							</form>
						</div>
						<!-- /search & aside toggle -->
					</div>
				</div>
				<?php
			    	flashmessage();
			    ?>
				<!-- /Main Nav -->

				<!-- Aside Nav -->
				<div id="nav-aside">
					<!-- nav -->
					<div class="section-row">
						<ul class="nav-aside-menu">
							<li><a href="index.php">Home</a></li>
							<li><a href="about.php">About Us</a></li>
							<li><a href="contact.php">Contacts</a></li>
						</ul>
					</div>
					<!-- /nav -->

					<!-- widget posts -->
					<div class="section-row">
						<h3>Recent Posts</h3>
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
					<!-- /widget posts -->

					<!-- social links -->
					<div class="section-row">
						<h3>Follow us</h3>
						<ul class="nav-aside-social">
							<li><a href="#"><i class="fa fa-facebook"></i></a></li>
							<li><a href="#"><i class="fa fa-twitter"></i></a></li>
							<li><a href="#"><i class="fa fa-google-plus"></i></a></li>
							<li><a href="#"><i class="fa fa-pinterest"></i></a></li>
						</ul>
					</div>
					<!-- /social links -->

					<!-- aside nav close -->
					<button class="nav-aside-close"><i class="fa fa-times"></i></button>
					<!-- /aside nav close -->
				</div>
				<!-- Aside Nav -->
			</div>
			<!-- /Nav -->
		<?php
			if (isset($bread) && !empty($bread)){
		?>
			<!-- Page Header -->
			<div class="page-header">
				<div class="container">
					<div class="row">
						<div class="col-md-10">
							<ul class="page-header-breadcrumb">
								<li><a href="index.php">Home</a></li>
								<li><?=$bread?></li>
							</ul>
							<h1><?=$bread?></h1>
						</div>
					</div>
				</div>
			</div>
			<!-- /Page Header -->
		<?php
			}
		?>
		</header>
		<!-- /Header -->

<script src="assets/js/jquery.min.js"></script>

<script type="text/javascript">
	$(document).ready(function(){
		$('#search_input').on('keyup', function(){
			value = $(this).val();
			console.log(value);
			$.post('ajax_fetch/search_data.php',{
				value: value,
				searchin: 'title',
				offset: 0,
				limit: 4
			},function(data, status){
				console.log(status);
				$('#search_filter').html(data);
			});
		});
	});
</script>