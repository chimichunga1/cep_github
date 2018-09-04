<?php
require_once("../support/config.php"); 


	$chat_code = $_POST['chat_code'];
	$sender_id = $_POST['sender_id'];
	$message = $_POST['message'];
	$receiver_id = $_POST['receiver_id'];
	$receiver_type = $_POST['receiver_type'];
	if ($_SESSION[WEBAPP]['user']['user_type'] == 'student') {
		$sender_type='1';
	}else {
		$sender_type='2';
	}

	$validate=$con->myQuery("SELECT * FROM chat WHERE chat_code=?",array($chat_code))->fetch(PDO::FETCH_ASSOC);

	$con->myQuery("INSERT INTO chat(chat_code,sender_id,sender_type,receiver_id,receiver_type,message,date_sent) VALUES('{$chat_code}','{$sender_id}','{$sender_type}','{$receiver_id}','{$receiver_type}','{$message}',NOW())");
	

	if ($receiver_id == '1') {
		if (empty($validate)) {


		$message = "Hi ".$_SESSION[WEBAPP]['user']['first_name'].", We will get back to you as soon as we reach your message. thanks!";
		$con->myQuery("INSERT INTO chat(chat_code,sender_id,sender_type,receiver_id,receiver_type,message,date_sent) VALUES('{$chat_code}','{$receiver_id}','{$receiver_type}','{$sender_id}','{$sender_type}','{$message}',NOW())");

		$con->myQuery("INSERT INTO chat_main(chat_code,user_id,user_type,last_activity) VALUES('{$chat_code}','{$sender_id}','{$sender_type}',NOW())");
		} else {
			$con->myQuery("UPDATE chat_main SET last_activity=NOW() WHERE chat_code='{$chat_code}'");
		}
	}



?>