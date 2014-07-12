<?php
include('../mysql_config.php');
include('../config.php');
if ( isset ( $_GET['lang'] ) )
{
	$lang = addslashes ( $_GET['lang'] );
	if ( is_file ( '../lang/' .$lang. '.php' ) )
	{
		include '../lang/'.$lang.'.php';
	}else{
		include '../lang/'.$default_lang.'.php';
	}
}


if(isset($_GET['id'])){
	$ID=intval($_GET['id']);
	$serv_info_q=$mysqli->query('SELECT * FROM `list_ots` WHERE `id`="'.$ID.'"');
	if($serv_info_q->num_rows()==1){
		$serv_info=$serv_info_q->fetch_assoc();
		
		$uptime_temp=explode('.',number_format($serv_info['uptimepc'],2));
		$uptime=$uptime_temp[0];
		if($uptime_temp[1]!="00") $uptime.='.'.$uptime_temp[1];	
		
		$now_uptime=intval($serv_info['now_uptime']);
		
		if($now_uptime>=86400){
			$now_uptime_d=intval($now_uptime/86400);
			$now_uptime=$now_uptime-$now_uptime_d*86400;
		}else{
			$now_uptime_d=0;
		}
		
		if($now_uptime>=3600){
			$now_uptime_h=intval($now_uptime/3600);
			$now_uptime=$now_uptime-$now_uptime_h*3600;
		}else{
			$now_uptime_h=0;
		}
		if($now_uptime>=60){
			$now_uptime_m=intval($now_uptime/60);
		}else{
			$now_uptime_m=0;
		}
		
		if($serv_info['exp_type']==1){
			$exp_type=$_LANG['server_info']['stages'];
		}else{
			$exp_type=$_LANG['server_info']['const'];
		}
		
		if($serv_info['client']==-1){
			$serv_info['client']=$_LANG['server_info']['na'];
		}
	
		echo '
		<table  class="table table-hover">
				   <tbody>
					   <tr>
							<td>IP</td>
							<td>'.$serv_info['ip'].'</td>
						</tr>
						<tr>
							<td>Port</td>
							<td>'.$serv_info['port'].'</td>
						</tr>
						<tr>
							<td>'.$_LANG['server_info']['players'].'</td>
							<td>'.$serv_info['players'].' / '.$serv_info['maxplayers'].'</td>
						</tr>
						<tr>
							<td>'.$_LANG['server_info']['record'].'</td>
							<td>'.$serv_info['rec'].'</td>
						</tr>
						<tr>
							<td>'.$_LANG['server_info']['client'].'</td>
							<td>'.$serv_info['client'].'</td>
						</tr>
						<tr>
							<td>Exp</td>
							<td>'.$serv_info['exp'].' x</td>
						</tr>
						<tr>
							<td>'.$_LANG['server_info']['country'].'</td>
							<td>'.$serv_info['country'].'</td>
						</tr>
						<tr>
							<td>'.$_LANG['server_info']['uptime'].'</td>
							<td>'.$uptime.' %</td>
						</tr>
						<tr>
							<td>'.$_LANG['server_info']['now_uptime'].'</td>
							<td>'.$now_uptime_d.'d '.$now_uptime_h.'h '.$now_uptime_m.'m</td>
						</tr>
						<tr>
							<td>'.$_LANG['server_view']['map'].'</td>
							<td>'.$serv_info['map'].'</td>
						</tr>
						<tr>
							<td>'.$_LANG['server_view']['exp_type'].'</td>
							<td>'.$exp_type.'</td>
						</tr>
						<tr>
							<td>'.$_LANG['server_view']['server'].'</td>
							<td>'.$serv_info['server_ver'].'</td>
						</tr>
						<tr>
							<td>'.$_LANG['server_view']['owner'].'</td>
							<td>'.$serv_info['server_owner'].'</td>
						</tr>
						<tr>
							<td>'.$_LANG['server_view']['added'].'</td>
							<td>'.date('d-m-Y, H:i',$serv_info['add_time']).'</td>
						</tr>
						<tr>
							<td>'.$_LANG['server_view']['last_online'].'</td>
							<td>'.date('d-m-Y, H:i',$serv_info['last_online']).'</td>
						</tr>
				   </tbody>
				</table>';
	}
}
?>