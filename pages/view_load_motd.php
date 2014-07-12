<?php
include('../mysql_config.php');
include('../config.php');
if(isset($_GET['id'])){
	$ID=intval($_GET['id']);
	$serv_info=$mysqli->query('SELECT count(*) FROM `list_ots` WHERE `id`="'.$ID.'"')->fetch_assoc();
	if($serv_info['count(*)']==1){
		$motd_query = $mysqli -> query ( 'SELECT * FROM `list_motd` WHERE `server`="'.$ID.'" ORDER BY `date` DESC' );
		while($motd_row=$motd_query->fetch_assoc()){
			echo '<p><b>'.date('d-m-Y, H:i',$motd_row['date']).':</b> </br>'.str_replace("\n","</br>",$motd_row['motd']).'</p>';
		}
	}
}
?>