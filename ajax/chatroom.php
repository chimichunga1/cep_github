<?php
// require_once '../support/config.php';
//$con->myQuery("SELECT FROM comments c WHERE ");
$empty_message="No message yet.";




// if(!empty($_GET['id'])){
		if(empty($_SESSION[WEBAPP]['user']['user_type'])){

			$sender_id = $_SESSION[WEBAPP]['user']['user_id'];
			$sender_type='2';

		} else {
			$sender_id = $_SESSION[WEBAPP]['user']['id'];
			$sender_type='1';
		}

		$messages=$con->myQuery("SELECT message,
								

								-- (SELECT CONCAT(last_name,', ',first_name,' ',middle_name) FROM users e WHERE e.id=sender_id) as sender,
								-- (SELECT CONCAT(last_name,', ',first_name,' ',middle_name) FROM users e WHERE e.id=receiver_id) as receiver,

								date_sent,
								sender_id,
								sender_type
								
								FROM chat 
								WHERE chat_code='{$chat_code}'")->fetchAll(PDO::FETCH_ASSOC);
								// WHERE query_id=? ORDER BY date_sent DESC",array($_GET['id'])

		//echo $_GET['request_type']."<br>".$_GET['id'];
		// var_dump($messages);
		// die();

		if(empty($messages)){
			echo $empty_message;
		}
		else{
			//echo "<ul class='timeline'>";
			echo "<br><br><div class='direct-chat-messages'>";
			foreach ($messages as $row):


				if ($row['sender_type'] == '2') {
					$sender_info=$con->myQuery("SELECT CONCAT(first_name,' ',last_name) as name,picture FROM users WHERE user_id=?",array($row['sender_id']))->fetch(PDO::FETCH_ASSOC);

				}else {
					$sender_info=$con->myQuery("SELECT CONCAT(first_name,' ',last_name) as name,picture FROM student WHERE id=?",array($row['sender_id']))->fetch(PDO::FETCH_ASSOC);
				}
				

				//$con->myQuery("UPDATE `chat` SET `read` = '1' WHERE `receiver_id`= {$sender_id} AND `query_id` = ".$_GET['id']);
			?>
					
				<div class='direct-chat-info clearfix'>
					<?php 
					
					if ($row['sender_id']==$sender_id && $row['sender_type'] == $sender_type){
						$user_pic='right';
					} else {
						$user_pic=null;
					}

					if ($row['sender_type'] == '2') {
						$is_faculty='true';
					} else {
						$is_faculty='';
					}

					?>

						<!-- <?php echo htmlspecialchars($sender_info['name']) ?> -->
							

					</span>
					
				</div>
			
				
				<!-- </div> -->

				<div class='col-12'>
					<a href='#' title="<?php echo $sender_info['name']; ?>">
					<img src="../assets/p_pic/<?php echo $sender_info['picture']; ?>" alt="user" style="float:<?php echo !empty($user_pic)?'right':'left' ?>;" class="rounded-circle" height="40px" />
					</a>
					<?php if ($row['sender_id']==$sender_id && $row['sender_type'] == $sender_type): ?>
					<div class="pl-2 pr-2 bg-primary rounded text-white send-msg mb-1 pull-right text-left" style="max-width: 60%">
					<?php else: ?>
					<div class='pl-2 pr-2 bg-secondary rounded text-white pull-left text-left' style="max-width: 60%">
					<?php endif; ?>
						
	                    <?php echo htmlspecialchars($row['message'])?><br>
	                    <small class="pull-right"><font size='1'><?php echo htmlspecialchars($row['date_sent'])?></font></small>

	                     
						
						
					</div>
					

				</div>

				
		<br><br>	
			<?php

			endforeach;
			echo "<br><br></div>";
			//echo "</ul>";
		


	}
	
// }
// else{
// 	echo $empty_message;
// }

?>

<!-- <script type = "text/javascript">
window.onload=function(){window.scrollTo(0,1000000)}
</script> -->