<?php
require_once("../support/config.php"); 

if(!empty($_GET['id'])){
    $chap_info=$con->myQuery("SELECT * FROM content_type WHERE id=?",array($_GET['id']))->fetch(PDO::FETCH_ASSOC);
    
    $amount=$chap_info['price'];
}
else{
	// $users=$con->myQuery("SELECT id,CONCAT(last_name,', ',first_name,' ',middle_name,' (',code,')') as display_name FROM employees WHERE is_deleted=0 ORDER BY last_name")->fetchAll(PDO::FETCH_ASSOC);
}
echo $amount;
?>