<?php

die;
require_once 'support/config.php';
	// var_dump($_POST);
	die;
if(!empty($_POST)){

	$user=$con->myQuery("SELECT *  FROM student WHERE BINARY student_id=? AND BINARY password=? AND is_deleted=0",array($_POST['username'],encryptIt($_POST['password'])))->fetch(PDO::FETCH_ASSOC);

// var_dump($user);
// die;
	// if(!empty($_SESSION[WEBAPP]['attempt_no']) && $_SESSION[WEBAPP]['attempt_no']>2){
	// 	Alert("Maximum login attempts achieved. <br/>Your account will be deactivated. </br> Contact your system administrator to retreive your password.","danger");
	// 	UNSET($_SESSION[WEBAPP]['attempt_no']);
	// 	$con->myQuery("UPDATE users SET is_active=0 WHERE username=?",array($_POST['username']));
	// 	redirect(".");
	// 	die;
	// }
	die;
	if(empty($user)){
		Alert("Invalid Student ID/Password","danger");
		redirect('.');
		if(!empty($_SESSION[WEBAPP]['attempt_no'])){
				// setcookie("attempt_no",$_SESSION[WEBAPP]['attempt_no']+1,time()+(3600));
			$_SESSION[WEBAPP]['attempt_no']+=1;
		}
		else{
			$_SESSION[WEBAPP]['attempt_no']=1;
		}
	}
	else{
		if($user['is_login']==0){
			if($user['is_active']==1){
				UNSET($_SESSION[WEBAPP]['attempt_no']);
				// $con->myQuery("UPDATE users SET is_login=1 WHERE user_id=?",array($user['user_id']));
				//$user['answer']=!empty($user['answer']);
				$_SESSION[WEBAPP]['user']=$user;
				refresh_activity($_SESSION[WEBAPP]['user']['user_id']);
					// var_dump($user['password_question']);
					// die;
				// var_dump($user['question_id']);
				// die;
				die;
					redirect('index.php');
					insertAuditLog($_SESSION[WEBAPP]['user']['last_name'].", ".$_SESSION[WEBAPP]['user']['first_name']," Logged in.");
				// }

				die;
			}
			else{
				Alert("This account is currently deactivated.","danger");
				redirect(".");
				die;
			}

		}
		else{
			Alert("This account is currently already logged in.","danger");
			redirect(".");
			die;
		}
	}
	die;
}
else{
	redirect('.');
	die();
}
redirect('.');
?>