
<?php
	include $_SERVER['DOCUMENT_ROOT'].'/config/init.php';
	// debugger($_POST);
	if($_POST){
		if(isset($_POST['categoryname']) && !empty($_POST['categoryname'])){
			if(isset($_POST['categorydescription']) && !empty($_POST['categorydescription'])){
				$category = new Category;
				$data = array(
					'categoryname' => $_POST['categoryname'],
					'description' => htmlentities($_POST['categorydescription']),
					'status' => 'Active',
					'added_by' => $_SESSION['user_id'],
				);
				if(isset($_POST['id']) && !empty($_POST['id'])){
					$act = 'updat';
					$success = $category->updateCategorybyId($data, $_POST['id']);
				}else{
					$act = 'add';
					$success = $category->addCategory($data);
				}
				if($success){
					redirect('../category.php', 'success', 'Category '.$act.'ed sucessfully');
				}else{
					redirect('../category.php', 'error', 'Problem while '.$act.'ing Category');
				}
			}else{
				redirect("../category.php", 'error', 'Category Description Required!');
			}
		}else{
			redirect('../category.php', 'error', 'Category Name Required!');
		}
	}else if($_GET){
		if(isset($_GET['categoryid']) && !empty($_GET['categoryid'])){
			$categoryid = (int)$_GET['categoryid'];
			$act = substr(sha1('Delete-category:'.$categoryid.$_SESSION['token']),5,17);
			if($act == $_GET['act']){
				$category = new Category;
				$data = array(
					'status' => 'Passive',
				);
				$success = $category->updateCategorybyId($data, $categoryid);
				if ($success){
					redirect('../category.php', 'success', 'Category deleted Successfully');
				}else{
					redirect('../category.php', 'error', 'Failed to delete Category. Try AGAIN!');
				}
			}else{
				redirect('../category.php', 'error', 'Invalid Attempt!');
			}
		}else{
			redirect('../category.php', 'error', 'ID is required!');
		}
	}

?>