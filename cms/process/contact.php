<?php
	include $_SERVER['DOCUMENT_ROOT'].'/config/init.php';
	
	$Contact = new Contact();
	 debugger($_GET);
	
 if ($_GET) {		//Delete
	if (isset($_GET['id']) && !empty($_GET['id'])) {
		$contact_id = (int)$_GET['id'];
		if ($contact_id) {
			$seen_act = substr(md5("Seen-Contact-".$contact_id.$_SESSION['token']), 3,15);
			$delete_act = substr(md5("Delete-Contact-".$contact_id.$_SESSION['token']), 3,15);
				if ($seen_act == $_GET['act']){
					$contact_info = $Contact->getContactbyId($contact_id);
					if ($contact_info) {
						$data =  array(
							'state'=>'Seen'
							);
						$success = $Contact->updateContactbyId($data,$contact_id);
						if ($success) {
							redirect('../contact.php','success','Contact Seen');
						}else{
							redirect('../contact.php','error','Error');
						}
					} else {
						redirect('../contact.php','error','Contact Not Found.');
					}
				}
				else if ($delete_act == $_GET['act']){
					$contact_info = $Contact->getContactbyId($contact_id);
					if ($contact_info) {
						$data =  array(
							'state'=>'deleted'
							);
						$success = $Contact->updateContactbyId($data,$contact_id);
						if ($success) {
							redirect('../contact.php','success','Contact Deleted Succesfully.');
						}else{
							redirect('../contact.php','error','Error while Deletinging.');
						}
					} else {
						redirect('../contact.php','error','Contact Not Found.');
					}
				}
				else{
					redirect('../contact.php','error',"Invalid Action");
				}
		}else{
			redirect('../contact.php','error','Id is Invalid');
		}
	}else{
		redirect('../contact.php','error','Id is required.');
	}
}
else{
	redirect('../contact.php','error','Error Occurs during submitting');
}
?>