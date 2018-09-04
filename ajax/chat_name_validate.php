<?php
require_once("../support/config.php"); 


	
	$validate=$con->myQuery("SELECT * FROM chat WHERE receiver_type='2' AND receiver_read='0'")->fetch(PDO::FETCH_ASSOC);

	
	if (!empty($validate)) {

		
		// $con->myQuery("UPDATE chat SET receiver_read='1' WHERE receiver_type='2'");
		
			echo 'true';


	}	else {
		
		echo '';
	
	}
	$validate='';





?>