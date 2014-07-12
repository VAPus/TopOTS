<?php
if(is_logged()){
	if(isset($_POST['message'])){
		$message=mysql_real_escape_string($_POST['message']);
		$user=mysql_real_escape_string($_SESSION['account']['name']);
		$message_q=$mysqli->query('SELECT `time` FROM `list_comments` WHERE `user`="'.$user.'" ORDER BY `time` DESC LIMIT 1');
		if($message_q->num_rows()>=1){
			$message_time=$message_q->fetch_assoc();
			$message_time['time']=intval($message_time['time']);
			if(time()-$message_time['time']< $comment_delay){
				echo '<h2>'.$_LANG['server_view']['comment_delay'].' '.($comment_delay-(time()-$message_time['time'])).'s...</h2>';
			}else{
				$mysqli->query('INSERT INTO `list_comments`(`id`, `server`, `comment`, `user`, `time`) VALUES (
							NULL,
							"'.$_GET['id'].'",
							"'.$message.'",
							"'.$user.'",
							"'.time().'")');
			}
		}else{
			$q='INSERT INTO `list_comments`(`id`, `server`, `comment`, `user`, `time`) VALUES (
			NULL,
			"'.$ID.'",
			"'.$message.'",
			"'.$user.'",
			"'.time().'")';
			$mysqli->query($q);
		}
	}
}
?>