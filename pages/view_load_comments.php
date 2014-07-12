<?php
include('../mysql_config.php');
include('../config.php');
if($comments_enable==1 and isset($_GET['id'])){
	$ID=intval($_GET['id']);
	$serv_info_q=$mysqli->query('SELECT `comments` FROM `list_ots` WHERE `id`="'.$ID.'"');
	if($serv_info_q->num_rows()==1){
		$serv_info=$serv_info_q->fetch_assoc();
		if($serv_info['comments']==1){
			$comm_q = $mysqli -> query ( 'SELECT * FROM `list_comments` WHERE `server` = "' .$ID. '" ORDER BY `time` DESC' );
			while($comm_row=$comm_q->fetch_assoc()){
				echo '
				<div class="chat_line">
					<div class="message">
						<p>'.$comm_row['user'].' ('.date('d-m-Y, H:i',$comm_row['time']).'):</br>'.str_replace("\n","</br>",$comm_row['comment']).'</p>
					</div>
				</div>';
			}
		}
	}
}
?>