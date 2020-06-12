<?php
	include $_SERVER['DOCUMENT_ROOT'].'/config/init.php';
	include '../inc/checklogin.php';

	if($_POST){
		if(isset($_POST['oldpassword']) && !empty($_POST['oldpassword'])){
			if(isset($_POST['password']) && !empty($_POST['password']) && isset($_POST['newpassword']) && !empty(['newpassword'])){
				if($_POST['password'] == $_POST['newpassword']){
					$user = new User;
					$user_info = $user->getUserbyEmail($_SESSION['user_email']);
					if($user_info){
						$password = sha1($_SESSION['user_email'].$_POST['oldpassword']);
						if($password == $user_info[0]->password){
							$data = array(
								'password' => sha1($_SESSION['user_email'].$_POST['password']), 
							);
							$success = $user->updateUserbyEmail($data, $_SESSION['user_email']);
							if($success){
								redirect('../password-change.php', 'success', 'Password Changed Sucessfully');
							}else{
								redirect('../password-change.php', 'error', 'Error During Changing Password: Retry!!')
							}
						}else{
							redirect('../password-change.php', 'error', 'Old Password not matched!');
						}
					}else{
						redirect('../logout.php');
					}
				}else{
					redirect('../password-change.php', 'error', "Password doesn't match!");
				}
			}else{
				redirect('../password-change.php', 'error', 'New Password Required!');
			}
		}else{
			redirect('../password-change.php', 'error', 'Old Password Required!');
		}
	}else{
		redirect('../password-change.php', 'error', 'Unauthorized Access!');
	}
?>