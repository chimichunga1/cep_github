<?php
	require_once("../support/config.php"); 
	if(!isLoggedIn())
	{
		toLogin();
		die();
	}
	if(!empty($_GET['id']))
	{
		$data=$con->myQuery("SELECT sub_category_id as `id`,  sub_category_name as `name` FROM sub_categories
		 WHERE  sub_categories.category_id=?",array($_GET['id']))->fetchAll(PDO::FETCH_ASSOC);
	}else
	{
		$data=$con->myQuery("SELECT sub_category_id as `id`,  sub_category_name as `name` FROM sub_categories")->fetchAll(PDO::FETCH_ASSOC);
	}
	echo makeOptions($data);
?>