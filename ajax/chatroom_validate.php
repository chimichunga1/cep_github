<?php
require_once("../support/config.php"); 

	$chat_code=$_GET['id'];

	
	$validate=$con->myQuery("SELECT COUNT(id) as total FROM chat WHERE chat_code=?",array($chat_code))->fetch(PDO::FETCH_ASSOC);

	
	if (!empty($_SESSION['number_chat_room'])) {

		
		// $con->myQuery("UPDATE chat SET sender_read='1' WHERE chat_code=?",array($chat_code));
		if ($validate['total'] != $_SESSION['number_chat_room']) {
			echo 'true';


			$_SESSION['number_chat_room'] = $validate['total'];
		} else {
			echo '';
			$_SESSION['number_chat_room'] = $validate['total'];
		}
		

	}	else {
		$_SESSION['number_chat_room'] = 'false';
		echo '';
	
	}
	$validate='';





?>