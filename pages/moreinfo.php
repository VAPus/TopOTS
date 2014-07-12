<?php
if(isset($_GET['id']) and isset($_GET['id2'])){
	include('../mysql_config.php');
	include('../config.php');
	$adm_id=intval($_GET['id']);
	$adm_ch=$mysqli->query('SELECT count(*) FROM `list_acc` WHERE `id`="'.$adm_id.'"')->fetch_assoc();
	if($adm_ch['count(*)']==0){
		exit;
	}
	$ID=intval($_GET['id2']);
	$serv_info_q=$mysqli->query('SELECT * FROM `list_ots` WHERE `id`="'.$ID.'"');
	if($serv_info_q->num_rows()==1){
		$serv_info=$serv_info_q->fetch_assoc();
		$owner_name=$mysqli->query('SELECT login FROM `list_acc` WHERE `id`="'.$serv_info['owner'].'"')->fetch_assoc();
		$my_promotions_string="";
		$my_promotions_q=$mysqli->query('SELECT type,start,end FROM `list_promote` WHERE `server`="'.$ID.'"');
		if($my_promotions_q->num_rows()>0){
			while($my_promotions_info=$my_promotions_q->fetch_assoc()){
				switch($my_promotions_info['type']){
					case 1:$my_promotions_info['type']="Featured box";break;
					case 2:$my_promotions_info['type']="Golden highlight";break;
					case 3:$my_promotions_info['type']="Countdown";break;
					case 4:$my_promotions_info['type']="First-in-table";break;
				}
				$now_time=time();
				if($now_time<$my_promotions_info['end'] and $now_time>$my_promotions_info['start']){
					$style="color: green;";
				}else{
					$style="color: red;";
				}
				
				$my_promotions_string.='
					<tr>
						<td>'.$my_promotions_info['type'].'</td>
						<td style="'.$style.'">'.date('d-m-Y, H:i',$my_promotions_info['start']).' - '.date('d-m-Y, H:i',$my_promotions_info['end']).'</td>
					</tr>';
			}
		}
		echo '
		<table  class="table table-hover">
		   <tbody>
			   <tr>
					<td>IP</td>
					<td>'.$serv_info['ip'].'</td>
				</tr>
				<tr>
					<td>Name</td>
					<td>'.$serv_info['name'].'</td>
				</tr>
				<tr>
					<td>Owner ID</td>
					<td>'.$serv_info['owner'].'</td>
				</tr>
				<tr>
					<td>Owner name</td>
					<td>'.$owner_name['login'].'</td>
				</tr>
				<tr>
					<td colspan=2>Promotions:</td>
				</tr>
				'.$my_promotions_string.'
		   </tbody>
		</table>';
	}else{
		exit;
	}
}
?>