<?php
require_once("../support/config.php"); 

if(!empty($_GET['id'])){
    $chap_info=$con->myQuery("SELECT chapt_id,type, chapter_desc FROM chapter_tbl WHERE chapt_id=?",array($_GET['id']))->fetch(PDO::FETCH_ASSOC);
    
    $chap_des=$chap_info['chapter_desc'];
}
else{
	// $users=$con->myQuery("SELECT id,CONCAT(last_name,', ',first_name,' ',middle_name,' (',code,')') as display_name FROM employees WHERE is_deleted=0 ORDER BY last_name")->fetchAll(PDO::FETCH_ASSOC);
}
echo $chap_des;
?>