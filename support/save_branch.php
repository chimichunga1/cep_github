<?php
require_once 'support/config.php';
// if(!hasAccess(21)){
//   redirect("index.php");
// }
if(!isLoggedIn()){
	toLogin();
	die();
}
if(!AllowUser(array(1,2))){
        redirect("index.php");
 }
if(!empty($_POST)){
		//Validate form inputs
	$inputs=$_POST;
	// var_dump($inputs);
	// die;
	$errors="";
			//IF id exists update ELSE insert
		if(empty($inputs['branch_id'])){
				//Insert
			//$inputs=$_POST;
			unset($inputs['branch_id']);
			$bname=$con->myQuery("SELECT branch_id,lcase(branch_name) as `branch_name`,company_id FROM branches WHERE is_deleted=0 and branch_name=? ",array(strtolower($inputs['branch_name'])))->fetch(PDO::FETCH_ASSOC);
			if(!empty($bname)){
				if($bname['branch_name'] == strtolower($inputs['branch_name']) && $bname['company_id'] == $inputs['company_id'] ){ // //additional condition
					$errors.="Branch Name " .$inputs['branch_name']. " is exist already.";

				}
			}
			if($errors!=""){

				Alert("You have the following errors: <br/>".$errors,"danger");
				if(empty($inputs['branch_id'])){
					redirect("frm_branches.php");
				}
				else{
					redirect("frm_branches.php?branch_id=".urlencode($inputs['branch_id']));
				}
				die;
			}
			// $date = strtotime($inputs['birthdate']);
			// $newformat = date('m-d-Y',$date);
			// $inputs['birthdate'] = $newformat;


			// $date = strtotime($inputs['joined_date']);
			// $newformat = date('m-d-Y',$date);
			// $inputs['joined_date'] = $newformat;

			// $inputs['basic_salary'] = encryptIt($inputs['basic_salary']);
			
			
				// $userid=$_SESSION[WEBAPP]['user']['id'];
				// var_dump($inputs);
				// die;
			$con->myQuery("INSERT INTO branches (branch_name,address,fax_no,mobile_no,telephone_no,email,website,company_id,regCode,provCode,cityminCode) VALUES (:branch_name,:address,:fax_no,:mobile_no,:phone_no,:email,:website,:company_id,:regCode,:provCode,:cityminCode)", $inputs);	
			insertAuditLog($_SESSION[WEBAPP]['user']['last_name'].", ".$_SESSION[WEBAPP]['user']['first_name']," Add Branch named " . $inputs['branch_name']. ".");
				// var_dump($con);
				// die;				
			
			Alert("Save successful.","success");
			

		}
		else{
			// $date = strtotime($inputs['birthdate']);
			// $newformat = date('m-d-Y',$date);
			// $inputs['birthdate'] = $newformat;


			// $date = strtotime($inputs['joined_date']);
			// $newformat = date('m-d-Y',$date);
			// $inputs['joined_date'] = $newformat;

			// $inputs['basic_salary'] = encryptIt($inputs['basic_salary']);
			// var_dump($inputs);
			// 	die;
			$bname=$con->myQuery("SELECT branch_id,lcase(branch_name) as `branch_name` FROM branches WHERE is_deleted=0 and branch_name=? and branch_id <> ?",array(strtolower($inputs['branch_name']),$inputs['branch_id']))->fetch(PDO::FETCH_ASSOC);
		
				if(!empty($bname)){
					if($bname['branch_name'] == strtolower($inputs['branch_name']) && $bname['company_id'] == $inputs['company_id']){
						$errors.="Branch Name " .$inputs['branch_name']. " is exist already.";
					}
				}
				if($errors!=""){

					Alert("You have the following errors: <br/>".$errors,"danger");
					if(empty($inputs['branch_id'])){
						redirect("frm_branches.php");
					}
					else{
						redirect("frm_branches.php?branch_id=".urlencode($inputs['branch_id']));
					}
					die;
				}
			$con->myQuery("UPDATE branches SET branch_name=:branch_name,address=:address,fax_no=:fax_no,mobile_no=:mobile_no,telephone_no=:phone_no,email=:email,website=:website,company_id=:company_id,regCode=:regCode,provCode=:provCode,citymunCode=:citymunCode WHERE branch_id=:branch_id", $inputs);

			insertAuditLog($_SESSION[WEBAPP]['user']['last_name'].", ".$_SESSION[WEBAPP]['user']['first_name']," Update Branch ID " . $inputs['branch_id']. ".");
			 
			Alert("Update successful.","success");
		}
		
		redirect("view_branches.php");
	//}
	die();
	
}
else{
	redirect('index.php');
	die();
}
redirect('index.php');
?>