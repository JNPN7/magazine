<?php
	include $_SERVER['DOCUMENT_ROOT'].'/config/init.php';
	$data = array();
	echo "djh";
	$error = array();
	if (isset($_POST)){
		if(isset($_POST['username']) && !empty($_POST['username']) && isset($_POST['email']) && !empty($_POST['email']) && isset($_POST['password']) && !empty($_POST['password']) && isset($_POST['newpassword']) && !empty($_POST['newpassword']) ){
			if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
				if (preg_match('/^[a-zA-Z1-9]+$/', $_POST['username'])){
					if ($_POST['password'] == $_POST['newpassword']){
						$user = new User;
						$token = tokenize();
						$data = array(
							'username' => $_POST['username'],
							'email' => $_POST['email'],
							'password' => sha1($_POST['email'].$_POST['password']),
							'session_token' => $token,
							'status' => 'Active',
						);
						$success = $user->addUser($data); 
						if($success){

							$_SESSION['user_id'] = $user_info[0]->id;
							$_SESSION['user_name'] = $user_info[0]->username;
							$_SESSION['user_email'] = $user_info[0]->email;
							$_SESSION['user_role'] = $user_info[0]->role;
							$_SESSION['user_status'] = $user_info[0]->status;
							$_SESSION['token'] = $token;

							redirect('../index.php','success','Welcome to Dashboard');
						}else{
							redirect('../login.php', 'error', "Data transfer error Try Again!");
						}
					}else{
						redirect('../login.php', 'error', "Password does'nt match");
					}
				}else{
					redirect('../login.php', 'error', 'Invalid username');
				}
			}else{
				redirect('../login.php', 'error', 'Invalid Email!');
			}
		}else{
			redirect('../login.php', 'error', 'All fields not filled!');
		}
	}else{
		redirect('../login.php', 'error', 'Unauthorized Access!');
	}

?>