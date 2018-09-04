<?php 
require_once '../support/config.php';
    if(!empty($_POST['id'])){
        $id=$_POST['id'];
        $pr_info = $con->myQuery("SELECT * FROM project_downpayment WHERE id='{$id}'")->fetch(PDO::FETCH_ASSOC);
                        


       
        $outputs[0]['name'] = "modal_p_type";
        if ($pr_info['type'] == "1") {
            $outputs[0]['value'] = "Downpayment";
        } elseif($pr_info['type'] == "2"){
            $outputs[0]['value'] = "Accomplishment Billing";
        }elseif($pr_info['type'] == "3"){
            $outputs[0]['value'] = "Retention";
        }elseif($pr_info['type'] == "4"){
            $outputs[0]['value'] = "Final Payment";
        }
        $outputs[1]['name'] = "modal_mode_of_payment";
        if ($pr_info['payment_type'] == "1") {
            $outputs[1]['value'] = "Cash";
        } elseif($pr_info['payment_type'] == "2"){
            $outputs[1]['value'] = "Check";
        }
        $outputs[2]['name'] = "modal_bank";
        $outputs[2]['value'] = $pr_info['bank_name'];
        $outputs[3]['name'] = "modal_branch";
        $outputs[3]['value'] = $pr_info['bank_branch'];
        $outputs[4]['name'] = "modal_cn";
        $outputs[4]['value'] = $pr_info['check_no'];
        $outputs[5]['name'] = "modal_cd";
        $outputs[5]['value'] = $pr_info['check_date'];
        $outputs[6]['name'] = "modal_amount";
        $amount=$pr_info['first_dp']+$pr_info['dp']+$pr_info['retention']+$pr_info['final_dp'];
        $outputs[6]['value'] = "P".number_format($amount,2);
        $outputs[7]['name'] = "modal_date";
        $outputs[7]['value'] = $pr_info['date_dp'];

        echo json_encode($outputs);
      
    }
?>

