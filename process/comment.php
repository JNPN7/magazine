<?php
include $_SERVER['DOCUMENT_ROOT'].'/config/init.php';
if($_POST){
	if (isset($_SESSION['user_id']) && !empty($_SESSION['user_id'])){
		$Comment = new Comment;
		if(isset($_POST['name']) && !empty($_POST['name']) && isset($_POST['email']) && !empty($_POST['email']) && isset($_POST['message']) && !empty($_POST['message']))
			$data = array(
				'name' => sanitize($_POST['name']),
				'email' => filter_var($_POST['email'],FILTER_VALIDATE_EMAIL),
				'website' => $_POST['website'],
				'message' => sanitize(htmlentities($_POST['message'])),
				'status' =>	'Active',
				'blogid' => (int)$_POST['blog_id'],
				'state' => 'waiting'
				// 'updated_date' => 
			);
		$act = 'Add';
		if(isset($_POST['comment_id']) && !empty($_POST['comment_id'])){
			$data['commentType'] = 'reply';
			$data['replyto'] = $_POST['comment_id'];
			$act = 'reply';
		}
		$success = $Comment->addComment($data);
		if($success){
			redirect('../blog-post.php?id='.$_POST['blog_id'], 'success', 'Comment '.$act.'ed Succesfully');
		}
	}else{
		echo 12;
		// redirect('../blog-post.php?id='.$_POST['blog_id'], 'error', 'Login to comment');
	}
}else{
	echo 10;
	// redirect('../blog-post.php?id='.$_POST['blog_id'], 'error', 'Data not entered');
}

?>