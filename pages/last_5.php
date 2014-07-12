<?php
$last_5="";
$last_5_q=$mysqli->query('SELECT id,name,players,rec,maxplayers,status,country,client FROM `list_ots` ORDER BY `add_time` DESC LIMIT 5');
while($last5_r=$last_5_q->fetch_assoc()){
	if($last5_r['client']==-1){
		$last5_r['client']=$_LANG['server_info']['na'];
	}
	if($last5_r['status']==1){
		$last5_status="ONLINE";
	}else{
		$last5_status="OFFLINE";
	}
	
	$last_5.='<li>
			<a href="?page=view&id='.$last5_r['id'].'">
				<div class="details">
					<div class="name"><b>'.$last5_r['name'].'</b></div>
					<div class="message">
						'.$last5_r['players'].' ('.$last5_r['rec'].') / '.$last5_r['maxplayers'].'  -  '.$last5_status.'  -  '.$last5_r['country'].'
					</div>
				</div>
			</a>
		</li>';
}
?>