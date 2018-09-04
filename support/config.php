<?php
	session_start();
	date_default_timezone_set("Asia/Manila");
	define("WEBAPP", 'Enrollment System');
	//$_SESSION[WEBAPP]=array();
	// function __autoload($class)
	// {
	// 	require_once 'class.'.$class.'.php';
	// }
	if (!empty($_SESSION[WEBAPP]['user']['user_type'])) {
		if ($_SESSION[WEBAPP]['user']['user_type'] == 'student') {
		    redirect("logout.php");
		}
	}
	
	function my_info($id)
	{
		    global $con;
		    return $con->myQuery("SELECT * FROM users WHERE user_id=?",array($id))->fetch(PDO::FETCH_ASSOC);

	}

	function redirect($url)
	{
		header("location:".$url);
	}

	function jsredirect($url)
	{
		echo "<script>window.history.back()</script>";
		echo "<a href='{$url}'>Click here if you are not redirected.</a>";
	}

	function getFileExtension($filename){
		return substr($filename, strrpos($filename,"."));
	}
	function DisplayDate($unformmatted_date){
	return date("m/d/Y",strtotime($unformmatted_date));
}

	function format_date($date_string)
	{
		$date=new DateTime($date_string);
		return $date->format("Y-m-d");
	}
	function inputmask_format_date($date_string){
		$date=new DateTime($date_string);
		return $date->format("m/d/Y");	
	}
// ENCRYPTOR
	function encryptIt( $q ) {
	    $cryptKey  = 'JPB0rGtIn5UB1xG03efyCp';
	    $qEncoded      = base64_encode( mcrypt_encrypt( MCRYPT_RIJNDAEL_256, md5( $cryptKey ), $q, MCRYPT_MODE_CBC, md5( md5( $cryptKey ) ) ) );
	    return( $qEncoded );
	}
	function decryptIt( $q ) {
	    $cryptKey  = 'JPB0rGtIn5UB1xG03efyCp';
	    $qDecoded      = rtrim( mcrypt_decrypt( MCRYPT_RIJNDAEL_256, md5( $cryptKey ), base64_decode( $q ), MCRYPT_MODE_CBC, md5( md5( $cryptKey ) ) ), "\0");
	    return( $qDecoded );
	}
	function ordinal($number) {
		$ends = array('th','st','nd','rd','th','th','th','th','th','th');
		if ((($number % 100) >= 11) && (($number%100) <= 13))
			return $number. 'th';
		else
			return $number. $ends[$number % 10];
	}

//End Encryptor
function PHPemailer($username, $password, $from, $to, $subject, $body, $host='tls://smtp.gmail.com', $port=587) {
    require_once("support/PHPMailer/PHPMailerAutoload.php");
    $mail = new PHPMailer;
    $mail->isSMTP();
    $mail->Host = 'tls://smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'episarainfo@gmail.com';
    $mail->Password = 'cjay1996';
    $mail->SMTPSecure = 'tls';
    $mail->Port = '587';

    $mail->setFrom($from);
    
   
    $mail->AddBCC($to);
    

    $mail->isHTML(true);

    $mail->Subject = $subject;
    $mail->Body    = $body;
    // var_dump($mail->ErrorInfo);
    return $mail->send();
}
function email_template($header, $message)
{
    return <<<html
    <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
    <html xmlns="http://www.w3.org/1999/xhtml" style="font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
    <head>
        <meta name="viewport" content="width=device-width" />
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <title>Spark Global Tech Systems Inc. HRIS</title>


        <style type="text/css">
            img {
                max-width: 100%;
            }
            body {
                -webkit-font-smoothing: antialiased; -webkit-text-size-adjust: none; width: 100% !important; height: 100%; line-height: 1.6em;
            }
            body {
                background-color: #f6f6f6;
            }
            @media only screen and (max-width: 640px) {
              body {
                padding: 0 !important;
            }
            h1 {
                font-weight: 800 !important; margin: 20px 0 5px !important;
            }
            h2 {
                font-weight: 800 !important; margin: 20px 0 5px !important;
            }
            h3 {
                font-weight: 800 !important; margin: 20px 0 5px !important;
            }
            h4 {
                font-weight: 800 !important; margin: 20px 0 5px !important;
            }
            h1 {
                font-size: 22px !important;
            }
            h2 {
                font-size: 18px !important;
            }
            h3 {
                font-size: 16px !important;
            }
            .container {
                padding: 0 !important; width: 100% !important;
            }
            .content {
                padding: 0 !important;
            }
            .content-wrap {
                padding: 10px !important;
            }
            .invoice {
                width: 100% !important;
            }
        }
    </style>
</head>

<body itemscope itemtype="http://schema.org/EmailMessage" style="font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; -webkit-font-smoothing: antialiased; -webkit-text-size-adjust: none; width: 100% !important; height: 100%; line-height: 1.6em; background-color: #f6f6f6; margin: 0;" bgcolor="#f6f6f6">

    <table class="body-wrap" style="font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; width: 100%; background-color: #f6f6f6; margin: 0;" bgcolor="#f6f6f6"><tr style="font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;"><td style="font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0;" valign="top"></td>
        <td class="container" width="600" style="font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; display: block !important; max-width: 600px !important; clear: both !important; margin: 0 auto;" valign="top">
            <div class="content" style="font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; max-width: 600px; display: block; margin: 0 auto; padding: 20px;">
                     <div class="">
                                        
                    </div>
                <table class="main" width="100%" cellpadding="0" cellspacing="0" style="font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; border-radius: 3px; background-color: white; margin: 0; border: 1px solid #e9e9e9;" bgcolor="white">
                <tr><td><center><img src='https://lh3.googleusercontent.com/vIQgKO6o8L8Q86lREXkEUTLBlSOOh0_O9zvV6HbeK4QXwN971iHt9fhwk5XeE3YO5FyLSyDAuOTOxckZXvohZ5Stw6W82XDa14IEPHFUaHunBg5W7-TDs8TVyfxCmEMui_eaenmjgt0=w2400' width='200px'></center>
                </td></tr>
                <tr style="font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;"><td class="alert alert-warning" style="font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 16px; vertical-align: top; color: black; font-weight: 500; text-align: left; border-radius: 3px 3px 0 0; background-color: #fff; margin: 0; padding: 20px;" bgcolor="#348EDA" valign="top">
                    {$header}
                </td>

                
            </tr><tr style="font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;"><td class="content-wrap" style="font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0; padding: 20px;" valign="top">
            <table width="100%" cellpadding="0" cellspacing="0" style="font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
                <tr style="font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
                    <td class="content-block" style="font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; text-align: center; margin: 0; padding: 0 0 20px;" valign="top">
                        {$message}
                    </td>
                </tr><tr style="font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;"><td class="content-block" style="font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0; padding: 0 0 20px;" valign="top">

            </td>
        </tr>
        <tr style="font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;"><td class="content-block" style="font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0; padding: 0 0 20px;" valign="top">
        Thanks,<br>
            EPISARA TEAM.<br>
            <a href='pisara-elearning.com'>www.pisara-elearning.com</a>
        </td>
    </tr>
</table>
</td>
</tr></table><div class="footer" style="font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; width: 100%; clear: both; color: #999; margin: 0; padding: 20px;">
</td>
<td style="font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0;" valign="top"></td>
</tr></table></body>
</html>
html;
}

	function insertAuditLog($user, $action)
{
    #user,action,date
        // if (file_exists("./audit_log.txt")) {
        //     $user=htmlspecialchars($user);
        //     $action=htmlspecialchars($action);
        //     $new_input=json_encode(array($user,$action,date('Y-m-d H:i:s')), JSON_PRETTY_PRINT);
        //     $file = fopen("./audit_log.txt", "r+");
        //     fseek($file, -4, SEEK_END);
        //     fwrite($file, ",".$new_input."\n\t]\n}");
        //     fclose($file);
        // } else {
        //     $file = fopen("./audit_log.txt", "w+");

        //     #CREATE NEW TEXT FILE
        //     $data=json_encode(array("data"=>array(array("NONE","INITIAL START UP",date('Y-m-d H:i:s')))), JSON_PRETTY_PRINT);
        //     fwrite($file, $data);

        //     $user=htmlspecialchars($user);
        //     $action=htmlspecialchars($action);
        //     $new_input=json_encode(array($user,$action,date('Y-m-d H:i:s')), JSON_PRETTY_PRINT);

        //     fseek($file, -4, SEEK_END);
        //     fwrite($file, ",".$new_input."\n\t]\n}");

        //     fclose($file);
        // }
}

function archiveAuditLog()
{
    if (file_exists("./audit_log.txt")) {
        $current=new DateTime();
        rename("./audit_log.txt", "./archive/Audit log ".$current->format("Y-m-d h-i-s").".txt");
    }
}

/* User FUNCTIONS */
	function isLoggedIn()
	{
		if(empty($_SESSION[WEBAPP]['user']))
		{
			return false;
		}
		else
		{
			return true;
		}
	}
	function toLogin($url=NULL)
	{
		if(empty($url))
		{
			// Alert('Please Log in to Continue',"danger");
			header("location: index.php");
		}
		else{
			header("location: ".$url);
		}
	}
	function Login($user)
	{
		$_SESSION[WEBAPP]['user']=$user;
	}
/* End User FUnctions */
//HTML Helpers
	function makeHead($pageTitle=WEBAPP,$level=0)
	{
		require_once str_repeat('../',$level).'template/head.php';
		unset($pageTitle);
	}
	function makeFoot($level=0)
	{
		require_once 'template/foot.php';
	}

	function makeOptions($array,$placeholder="",$checked_value=NULL){
		$options="";
		// if(!empty($placeholder)){
			$options.="<option value=''>{$placeholder}</option>";
		// }
		foreach ($array as $row) {
			list($value,$display) = array_values($row);
				if($checked_value!=NULL && $checked_value==$value){

					$options.="<option value='".htmlspecialchars($value)."' checked>".htmlspecialchars($display)."</option>";
				}
				else
				{
					$options.="<option value='".htmlspecialchars($value)."'>".htmlspecialchars($display)."</option>";
				}
		}
		return $options;
	}
//END HTML Helpers
/* BOOTSTRAP Helpers */
	function Modal($content=NULL,$title="Alert")
	{
		if(!empty($content))
		{
			$_SESSION[WEBAPP]['Modal']=array("Content"=>$content,"Title"=>$title);
		}
		else
		{
			if(!empty($_SESSION[WEBAPP]['Modal']))
			{
				include_once 'template/modal.php';
				unset($_SESSION[WEBAPP]['Modal']);
			}
		}
	}
	function Alert($content=NULL,$type="info")
	{
		if(!empty($content))
		{
			$_SESSION[WEBAPP]['Alert']=array("Content"=>$content,"Type"=>$type);
		}
		else
		{
			if(!empty($_SESSION[WEBAPP]['Alert']))
			{
				$alertcontent = $_SESSION[WEBAPP]['Alert']['Content'];
				$alerttype = $_SESSION[WEBAPP]['Alert']['Type'];

				if ($alerttype == "danger") {
					$alerttype="warning";
				}

				echo "<script>swal('{$alertcontent}','','{$alerttype}');</script>";
				
			}
			unset($_SESSION[WEBAPP]['Alert']);
		}
	}
	function createAlert($content='',$type='info')
	{
		echo "<div class='alert alert-{$type}' role='alert'>{$content}</div>";
	}
/* End BOOTSTRAP Helpers */


function AllowUser($user_type_id){
	
}




function validate_room($room_id, $start_time, $end_time, $days, $sched_det_id = 0)
{
	global $con;
	$inputs['room_id'] = $room_id;
	$inputs['start_time'] = $start_time;
	$inputs['end_time'] = $end_time;

	$query="SELECT sched_det_id, 
		       start_time, 
		       end_time, 
		       rooms.room_name ,
		       schedule_details.room_id,
		       DAY 
		FROM   schedule_details 
		LEFT JOIN rooms ON
			rooms.room_id = schedule_details.room_id
		LEFT JOIN schedules ON schedule_details.sched_id=schedules.sched_id
		LEFT JOIN school_year ON schedules.school_year_id=school_year.school_year_id
		WHERE school_year.is_active='1' AND schedules.is_deleted=0 AND schedule_details.room_id = :room_id 
		       AND ( STR_TO_DATE(start_time, '%h:%i %p') <= 
			     STR_TO_DATE(:start_time, '%h:%i %p') 
			     AND STR_TO_DATE(:start_time, '%h:%i %p') < 
				 STR_TO_DATE(end_time, '%h:%i %p') 
			      OR STR_TO_DATE(start_time, '%h:%i %p') < 
				 STR_TO_DATE(:end_time, '%h:%i %p') 
				 AND STR_TO_DATE(:end_time, '%h:%i %p') <= 
				     STR_TO_DATE(end_time, '%h:%i %p') ) ";
	if (!empty($sched_det_id)) {
		$query.=" AND sched_det_id <> :sched_det_id";
		$inputs['sched_det_id'] = $sched_det_id;
	}
	
	$schedules = $con->myQuery($query, $inputs)->fetchAll(PDO::FETCH_ASSOC);

	if (!empty($schedules)) {
		$selected_days = $days;
		$room_name=$schedules[0]['room_name'];
		foreach ($schedules as $key => $schedule) {
			if(empty($intersected_days)){
				$intersected_days=array_intersect($selected_days, explode(",", $schedule['DAY']));
			}else{
				array_merge($intersected_days,array_diff($intersected_days, explode(",", $schedule['DAY'])));
			}
		}
		if(!empty($intersected_days)){
			$error_msg="The Following days are not available during the selected time for (".htmlspecialchars($room_name)."): <br/>";
			if(in_array("M", $intersected_days)){
				$error_msg.="Monday <br/>";
			}

			if(in_array("T", $intersected_days)){
				$error_msg.="Tuesday <br/>";
			}

			if(in_array("W", $intersected_days)){
				$error_msg.="Wednesday <br/>";
			}

			if(in_array("TH", $intersected_days)){
				$error_msg.="Thursday <br/>";
			}

			if(in_array("F", $intersected_days)){
				$error_msg.="Friday <br/>";
			}

			if(in_array("S", $intersected_days)){
				$error_msg.="Saturday <br/>";
			}
			$error_msg.="Please review existing schedules in the reports.<br/>";
			return $error_msg;
		}
		return;
	} else {
		return ;
	}
}
function validate_teacher($teacher_id, $start_time, $end_time, $days, $sched_det_id = 0)
{
	global $con;
	$inputs['teacher_id'] = $teacher_id;
	$inputs['start_time'] = $start_time;
	$inputs['end_time'] = $end_time;

	$query="SELECT sched_det_id, 
		       start_time, 
		       end_time, 
		       teachers.last_name ,
		       schedule_details.teacher_id,
		       DAY 
		FROM   schedule_details 
		LEFT JOIN teachers ON
			teachers.teacher_id = schedule_details.teacher_id
		LEFT JOIN schedules ON schedule_details.sched_id=schedules.sched_id
		LEFT JOIN school_year ON schedules.school_year_id=school_year.school_year_id
		WHERE school_year.is_active='1' AND schedules.is_deleted=0 AND schedule_details.teacher_id = :teacher_id 
		       AND ( STR_TO_DATE(start_time, '%h:%i %p') <= 
			     STR_TO_DATE(:start_time, '%h:%i %p') 
			     AND STR_TO_DATE(:start_time, '%h:%i %p') < 
				 STR_TO_DATE(end_time, '%h:%i %p') 
			      OR STR_TO_DATE(start_time, '%h:%i %p') < 
				 STR_TO_DATE(:end_time, '%h:%i %p') 
				 AND STR_TO_DATE(:end_time, '%h:%i %p') <= 
				     STR_TO_DATE(end_time, '%h:%i %p') ) ";
	if (!empty($sched_det_id)) {
		$query.=" AND sched_det_id <> :sched_det_id";
		$inputs['sched_det_id'] = $sched_det_id;
	}

	$schedules = $con->myQuery($query, $inputs)->fetchAll(PDO::FETCH_ASSOC);
	// echo $query;
	// var_dump( $inputs);
	// var_dump($schedules);
	if (!empty($schedules)) {
		$selected_days = $days;
		$room_name=$schedules[0]['last_name'];
		foreach ($schedules as $key => $schedule) {
			if(empty($intersected_days)){
				$intersected_days=array_intersect($selected_days, explode(",", $schedule['DAY']));
			}else{
				array_merge($intersected_days,array_diff($intersected_days, explode(",", $schedule['DAY'])));
			}
		}
		if(!empty($intersected_days)){
			$error_msg="The Following days are not available during the selected time for (".htmlspecialchars($room_name)."): \n";
			if(in_array("M", $intersected_days)){
				$error_msg.="Monday \n";
			}

			if(in_array("T", $intersected_days)){
				$error_msg.="Tuesday \n";
			}

			if(in_array("W", $intersected_days)){
				$error_msg.="Wednesday \n";
			}

			if(in_array("TH", $intersected_days)){
				$error_msg.="Thursday \n";
			}

			if(in_array("F", $intersected_days)){
				$error_msg.="Friday \n";
			}

			if(in_array("S", $intersected_days)){
				$error_msg.="Saturday \n";
			}

			return $error_msg;
		}
		return;
	} else {
		return ;
	}
}
/* END SPECIFIC TO WEBAPP */
	require_once('class.myPDO.php');
	$cepsystem_con=new myPDO('cep_system','root','miguel');

	$con=new myPDO('cep_project','root','miguel');

	if(isLoggedIn()){
		// if(!user_is_active($_SESSION[WEBAPP]['user']['user_id'])){
		// 	refresh_activity($_SESSION[WEBAPP]['user']['user_id']);
		// 	session_destroy();
		// 	session_start();
		// 	Alert("Your account has been deactivated.","danger");
		// 	redirect('.');
		// 	die;
		// }
	
	}

	$actual_link = "$_SERVER[REQUEST_URI]";

	if (strpos($actual_link, '.php') !== false) {
	//   redirect(str_replace(".php","",$actual_link));
	}
	
	
?>
