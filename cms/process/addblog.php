<?php
	include $_SERVER['DOCUMENT_ROOT'].'/config/init.php';
	debugger($_POST);
	debugger($_GET);
	
	if($_POST){
		$file = $_FILES['image'];
		debugger($file);
		if(isset($_POST['blogtitle']) && !empty($_POST['blogtitle'])){
			$data = array(
				'title' => $_POST['blogtitle'],
				'content' => htmlentities($_POST['blogcontent']),
				'featured' => $_POST['featured'],
				'categoryid' => $_POST['category'],
				'status' =>	'Active',
				'added_by' => $_SESSION['user_id'],
			);
			$image = $file;
			if(isset($image) && !empty($image)){
				
				$success = uploadimage($image, 'blog-image');
				if($success){
					$temp = array('image' => $success);
					$data = array_merge($data, $temp);
					 if (isset($_POST['old_img']) && !empty($_POST['old_img']) && file_exists(UPLOAD_PATH.'blog-image/'.$_POST['old_img'])){
						unlink(UPLOAD_PATH.'blog-image/'.$_POST['old_img']);
					}
				}
			}else if(isset($_POST['old_img']) && !empty($_POST['old_img']) && file_exists(UPLOAD_PATH.'blog-image/'.$_POST['old_img'])){
				$data['image'] = $_POST['old_img'];
			}else{
					redirect('../addblog.php', 'error', 'Error while uploading image');
			}
			$blog = new Blog;
			if (isset($_POST['blog_id']) && !empty($_POST['blog_id'])){
				$act = 'updat';
				$success = $blog->updateBlogById($data, $_POST['blog_id']);
			}else{
				$success = $blog->addBlog($data);
				$act = 'add';
			}
			if ($success){
				
				redirect('../blog.php', 'success', 'Blog '.$act.'ed successfully');
				debugger($data);
			}else{;
				redirect('../addblog.php', 'error', 'Error while '.$act.'ing data Try Again');
			}
		}else{
			redirect('../addblog.php', 'error', 'Blogtitle is needed');
		}
	}else if($_GET){ //DELETE
		echo "xbch";
		if (isset($_GET['id']) && !empty($_GET['id'])) {
			$blog_id = $_GET['id'];
			if ($blog_id) {
				$act = substr(md5("Delete-Blog-".$blog_id.$_SESSION['token']), 3,15);
				if ($act) {
					if ($act == $_GET['act']){
						$blog = new Blog;
						$blog_info = $blog->getBlogbyId($blog_id);
						if ($blog_info) {
							$data =  array(
								'status'=>'Passive'
								);
							$success = $blog->updateBlogById($data,$blog_id);
							if ($success) {
								redirect('../blog.php','success','Blog Deleted Succesfully.');
							}else{
								redirect('../blog.php','error','Error while Deleting.');
							}
						} else {
							redirect('../blog.php','error','Blog Not Found.');
						}
					}else{
						// redirect('../blog.php','error',"Invalid Action");
						echo $act;
						echo $_GET['act'];
					}
				}else{
					redirect('../blog.php','error','action is required');
				}
			}else{
				redirect('../blog.php','error','Id is Invalid');
			}
		}else{
			redirect('../blog.php','error','Id is required.');
		}
	}else{
		redirect('../addblog.php', 'error', 'Authorization Required!');
	}

?>