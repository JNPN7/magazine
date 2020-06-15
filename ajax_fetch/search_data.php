<?php
	include $_SERVER['DOCUMENT_ROOT'].'/config/init.php';
	$value = $_POST['value'];
	$searchin = $_POST['searchin'];
	$offset = $_POST['offset'];
	$limit = $_POST['limit'];
	$Blog = new Blog;
	$searchBlog = $Blog->getBlogbySearch($value, $searchin, $offset, $limit);
	if($searchBlog){
		foreach ($searchBlog as $key => $blog){
?>
	<div style="padding: 10px">
		<a href="./blog-post.php?id=<?=$blog->id?>" ><?=$blog->title?><a>
	</div>
<?php
		}
	}
?>