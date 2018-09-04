<?php
	require_once("support/config.php");

if(!isLoggedIn()){
	toLogin();
    die();
}



	if(!empty($_POST)){
		//Validate form inputs

		

		$inputs=$_POST;
		$inputs=array_map("trim",$inputs);

		$errors="";

        // var_dump($_FILES);
        // die;

        if ($inputs['dp_type']=='1') {
            $first_dp=$inputs['amnt'];
            $dp = 0;
            $ret=0;
            $final_dp=0;
        } elseif ($inputs['dp_type']=='2') {
            $first_dp=0;
            $dp = $inputs['amnt'];
            $ret=0;
            $final_dp=0;
        } elseif ($inputs['dp_type']=='3') {
            $first_dp=0;
            $dp = 0;
            $ret=$inputs['amnt'];
            $final_dp=0;
        } elseif ($inputs['dp_type']=='4') {
            $first_dp=0;
            $dp = 0;
            $ret=0;
            $final_dp=$inputs['amnt'];
        }

        
        $pr_id=$inputs['proj_id'];
        $payment_type=$inputs['p_type'];

        if ($payment_type == "2") {
            $bank_name=$inputs['c_bank'];
            $b_branch=$inputs['c_branch'];
            $check_no=$inputs['c_cn'];
            $check_date=$inputs['c_date'];
        } else {
            $bank_name="";
            $b_branch="";
            $check_no="";
            $check_date="";
        }
        $date=$inputs['date'];
        $file_name=$_FILES['image']['name'];
        $type=$inputs['dp_type'];
        


        
        $id = $con->lastInsertId();
/*  		if (!empty($_FILES['image']['name'])) {
       
	        $filename=$_SESSION[WEBAPP]['user']['id'].date("mdyhis").getFileExtension($_FILES['image']['name']);
	        move_uploaded_file($_FILES['image']['tmp_name'], "attachment/".$filename);
	        $file_sql="attachment=:image";
	        $insert['image']=$filename;
	        $insert['id']=$id;
	        $con->myQuery("UPDATE project_downpayment SET {$file_sql} WHERE id=:id", $insert);
        }
*/
        $pr_dp_info=$con->myQuery("SELECT * FROM project_info WHERE project_id={$pr_id}")->fetch(PDO::FETCH_ASSOC);
        $dp_all = $pr_dp_info['downpayment'] + $first_dp + $dp + $ret + $final_dp;
        $con->myQuery("UPDATE project_info SET downpayment='{$dp_all}' WHERE project_id='{$pr_id}'");



        // var_dump($inputs);
        // die();
		// $con->myQuery("UPDATE users SET email=?,mobile_no=? WHERE user_id='{$stud_id}'",array($inputs['email'],$inputs['contact']));
        // insertAuditLog($_SESSION[WEBAPP]['user']['last_name'].", ".$_SESSION[WEBAPP]['user']['first_name']," Update account setting ID");

        // PRE PAGAWANG PDO HAHAHA LABYU
        // PRE PAGAWANG PDO HAHAHA LABYU
        // PRE PAGAWANG PDO HAHAHA LABYU





if(!empty($_FILES['files']['name'])){


    $files = $_FILES['files'];

    $uploaded = array();
    $failed = array();

    $allowed = array('txt', 'jpg', 'png');
    foreach($files['name'] as $position => $file_name){
        $file_tmp = $files['tmp_name'][$position];
        $file_size = $files['size'][$position];
        $file_error = $files['error'][$position];
/*      echo $file_tmp, '<br>';
    */  
        $file_ext = explode('.', $file_name);
        $file_ext = strtolower(end($file_ext));
        if(in_array($file_ext, $allowed)){
            if($file_error === 0){
                if($file_size <= 2097152){
/*
            $filename=$_SESSION[WEBAPP]['user']['id'].date("mdyhis").getFileExtension($_FILES['image']['name']);
            move_uploaded_file($_FILES['image']['tmp_name'], "attachment/".$filename);
                    $schema_name = "cjay";
                    $file_name_new = uniqid('',true) . '.' . $file_ext;*/
/*                    $file_name_new = $_SESSION[WEBAPP]['user']['id'].date("mdyhis").'.'.$file_ext;*/
                    $file_name_attachment = $_FILES['image']['name'];
                    $file_name_new = uniqid('',true) . '.' . $file_ext;
                    $file_destination = 'attachment/'.$file_name_new;
            

                    $a=array("red","green");
                    array_push($a,"blue","yellow");
      
                        $con->myQuery("INSERT INTO project_images(project_id,attachment_name,attachment) 
                    VALUES('{$pr_id}','{$file_name_new}','{$file_name_new}')");



/*        $con->myQuery("INSERT INTO project_images(project_id,attachment_name) 
        VALUES('{$pr_id}','{$file_destination}')");*/

                    if(move_uploaded_file($file_tmp, $file_destination)){
                        $uploaded[$position] = $file_destination;


                        
                    }
                    else {
                        $failed[$position] = "[{$file_name}] is too large.";

                    }

                    if(!empty($uploaded)){
                        print_r($uploaded);

                    }
                    if(!empty($failed)){
                        print_r($failed);
                    }
                }
            }
        }
        print_r($file_ext);
    }


                        $con->myQuery("INSERT INTO project_downpayment(project_id,type,payment_type,first_dp,dp,retention,final_dp,date_dp,bank_name,bank_branch,check_no,check_date) 
                    VALUES('{$pr_id}','{$type}','{$payment_type}','{$first_dp}','{$dp}','{$ret}','{$final_dp}','{$date}','{$bank_name}','{$b_branch}','{$check_no}','{$check_date}')");


}







        // die;
        Alert("Save successful","success");
        redirect("vw_project.php?id=".$pr_id);
		 
		die;
	}
	else{
		redirect('.');
		die();
	}
	redirect('.');
?>