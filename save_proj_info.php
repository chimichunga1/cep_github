<?php
	require_once("support/config.php");
	 if(!isLoggedIn()){
	 	toLogin();
	 	die();
	 }



		if(!empty($_POST)){
		//Validate form inputs
		$inputs=$_POST;
		

        $pr_id=$inputs['proj_id'];
        $pr_validate = $con->myQuery("SELECT * FROM project_info WHERE project_id='{$pr_id}'")->fetch(PDO::FETCH_ASSOC);
        
        // var_dump($inputs);
        // die;
        $saba = $inputs['saba'];
        $po   = $inputs['po'];
		$c_amnt = $inputs['c_amnt'];
		$company=$inputs['company'];

			if(empty($pr_validate)){

                $con->myQuery("INSERT INTO project_info(project_id,saba,po,contract_amount,company_name) VALUES('{$pr_id}','{$saba}','{$po}','{$c_amnt}','{$companyt}')");
              
			}
			else{
				//Update
                $id = $pr_validate['id'];
				$con->myQuery("UPDATE project_info SET saba='{$saba}',po='{$po}',contract_amount='{$c_amnt}',company_name='{$company}' WHERE id='{$id}'");
			}

			Alert("Save succesful","success");
			redirect(".");
		
		die;
	}
	else{
		redirect('.');
		die();
	}
	redirect('.');
?>