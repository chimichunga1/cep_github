<?php
require_once("../support/config.php"); 


	$chat_code = $_POST['chat_code'];
	$sender_id = $_POST['sender_id'];
	$message = $_POST['message'];
	
	if ($_SESSION[WEBAPP]['user']['user_type'] == 'student') {
		$sender_type='1';
	}else {
		$sender_type='2';
	}


	$con->myQuery("INSERT INTO chat(chat_code,sender_id,sender_type,message,date_sent) VALUES('{$chat_code}','{$sender_id}','{$sender_type}','{$message}',NOW())");
	


?>