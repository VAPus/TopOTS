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
	$acc_info_q=$mysqli->query('SELECT * FROM `list_acc` WHERE `id`="'.$ID.'"');
	if($acc_info_q->num_rows()==1){
		$acc_info=$acc_info_q->fetch_assoc();
		
		$my_promotions_string="";
		$my_promotions_q=$mysqli->query('SELECT type,start,end,server FROM `list_promote` WHERE `owner`="'.$ID.'"');
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
						<td>'.$my_promotions_info['type'].' ('.$my_promotions_info['server'].')</td>
						<td style="'.$style.'">'.date('d-m-Y, H:i',$my_promotions_info['start']).' - '.date('d-m-Y, H:i',$my_promotions_info['end']).'</td>
					</tr>';
			}
		}
		$my_servers_string="";
		$my_servers_q=$mysqli->query('SELECT id,name,ip FROM `list_ots` WHERE `owner`="'.$ID.'"');
		if($my_servers_q->num_rows()>0){
			while($my_servers_info=$my_servers_q->fetch_assoc()){			
				$my_servers_string.='
					<tr>
						<td>'.$my_servers_info['id'].'</td>
						<td>'.$my_servers_info['name'].' /('.$my_servers_info['ip'].')</td>
					</tr>';
			}
		}
		echo '
		<table  class="table table-hover">
		   <tbody>
			   <tr>
					<td>Mail</td>
					<td>'.$acc_info['mail'].'</td>
				</tr>
				<tr>
					<td>Points</td>
					<td>'.$acc_info['points'].'</td>
				</tr>
				<tr>
					<td>Accepted</td>
					<td>'.$acc_info['accepted'].'</td>
				</tr>
				<tr>
					<td colspan=2>Servers:</td>
				</tr>
				'.$my_servers_string.'
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