<?php 
require_once '../support/config.php';
    if(!empty($_POST['project_id'])){
        $pr_id=$_POST['project_id'];
        $pr_info = $con->myQuery("SELECT * FROM project_info WHERE project_id='{$pr_id}'")->fetch(PDO::FETCH_ASSOC);
                        



       
        $outputs[0]['name'] = "saba";
        $outputs[0]['value'] = $pr_info['saba'];
        $outputs[0]['disabled'] = "true";
        $outputs[1]['name'] = "po";
        $outputs[1]['value'] = $pr_info['po'];
        $outputs[2]['name'] = "c_amnt";
        $outputs[2]['value'] = $pr_info['contract_amount'];
        $outputs[3]['name'] = "proj_id";
        $outputs[3]['value'] = $pr_id;
        $outputs[4]['name'] = "company";
        $outputs[4]['value'] = $pr_info['company_name'];

        echo json_encode($outputs);
    }
?>

