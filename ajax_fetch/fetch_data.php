<?php
	include $_SERVER['DOCUMENT_ROOT'].'/config/init.php';
	define('CAT_COLOR', ['cat-1','cat-2','cat-3','cat-4']);
	$count = 0;
	function fetch_data($offset, $limit=4, $categoryid = -1){
		if ($categoryid == -1){
			$Blog = new Blog;
			$popularBlog = $Blog->getAllPopularBlogWithLimit($offset, $limit);
		}else{
			$Blog = new Blog;
			$popularBlog = $Blog->getAllRecentBlogByCategoryWithLimit($categoryid, $offset, $limit);
		}
		return $popularBlog;
	}
	function fetch_search_data($offset, $limit=4, $search, $searchin){
		$Blog = new Blog;
		$searchBlog = $Blog->getBlogbySearch($search, $searchin, $offset, $limit);
		return $searchBlog;
	}
	$offset = $_POST['offset'];
	$limit = $_POST['limit'];
	if (isset($_POST['categoryid']) && !empty($_POST['categoryid'])){

		$categoryid = $_POST['categoryid'];
		$popularBlog = fetch_data($offset , $limit, $categoryid);
	}elseif (isset($_POST['search']) && !empty($_POST['search'])) {
		$popularBlog = fetch_search_data($offset, $limit, $_POST['search'], $_POST['searchin']);
	}else{
		$popularBlog = fetch_data($offset ,$limit);
	}
	if ($popularBlog) {
		foreach ($popularBlog as $key => $blog) {
			$count += 1;
			# code...
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
		if ($count < $limit){
?>
			<div>
				<p style="text-align: center;">Sorry!!!  No More Results</p>
			</div>
			<script type="text/javascript">
				console.log($('#loadmore').html());
				// document.getElementById('#loadmore').remove();
				$('#loadmore').remove();
			</script>
		
<?php
		}
	}else{
?>
		<div>
			<p style="text-align: center;">Sorry!!!  No More Results</p>
		</div>
		<script type="text/javascript">
			console.log($('#loadmore').html());
			// document.getElementById('#loadmore').remove();
			$('#loadmore').remove();

		</script>
<?php
	}
?>
