<?php
	require_once 'support/config.php';

	if(!empty($_GET['id'])){

		Alert("Account set successfully." , "success");
		$con->myQuery("UPDATE users SET is_login=0 WHERE user_id=?",array($_SESSION[WEBAPP]['user']['user_id']));
		insertAuditLog($_SESSION[WEBAPP]['user']['last_name'].", ".$_SESSION[WEBAPP]['user']['first_name']," Logged out Account was set.");
		session_destroy();
		redirect('.?id=1');
		
		die;
	}
	if(isLoggedIn()){
		// var_dump('xxx');
		// die;
	$con->myQuery("UPDATE users SET is_login=0 WHERE user_id=?",array($_SESSION[WEBAPP]['user']['user_id']));
	insertAuditLog($_SESSION[WEBAPP]['user']['last_name'].", ".$_SESSION[WEBAPP]['user']['first_name']," Logged out.");
	session_destroy();

	}

	redirect('index.php');
?>