<?php
if(isset($_POST['submit'])){
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
	
	$name_q="";
	$status_q="";
	$type_q="";
	$country_q="";
	$exptype_q="";
	$map_q="";
	$client_q="";
	$exp_q="";
	$players_q="";
	$uptime_q="";
	
	$mode_on=0;
	
	if($_POST['name_mode']=="true"){
		$name=mysql_real_escape_string($_POST['name']);
		if(!($name=="")){
			$name_q=' AND `name` like "%'.$name.'%" ';
			$mode_on++;
		}
	}
	
	if($_POST['status_mode']=="true"){
		if($_POST['status']=="true"){
			$status_q=" AND `status`=1 ";
			$mode_on++;
		}else{
			$status_q=" AND `status`=0 ";
			$mode_on++;
		}
	}
	
	if($_POST['type_mode']=="true"){
		$type=mysql_real_escape_string($_POST['type']);
		$type_q=' AND `type` ="'.$type.'" ';
		$mode_on++;
	}

	
	if($_POST['country_mode']=="true"){
		$country=mysql_real_escape_string($_POST['country']);
		$country_q=' AND `country` ="'.$country.'" ';
		$mode_on++;
	}
	
	if($_POST['exptype_mode']=="true"){
		if($_POST['exptype']==$_LANG['server_info']['stages']){	
			$exptype_q=' AND `exp_type` =1 ';
			$mode_on++;
		}else{
			$exptype_q=' AND `exp_type` =2 ';
			$mode_on++;
		}
	}
	
	if($_POST['map_mode']=="true"){
		$map=mysql_real_escape_string($_POST['map']);
		$map_q=' AND `map` ="'.$map.'" ';
		$mode_on++;
	}
	
	if($_POST['client_mode']=="true"){
		if($_POST['client']== $_LANG['server_info']['na']){
			$client=-1;
		}else{
			$client=mysql_real_escape_string($_POST['client']);
		}
		$client_q=' AND `client` LIKE '.$client.' ';
		$mode_on++;
	}
	
	if($_POST['exp_mode']=="true"){
		if($_POST['exp1']=="true"){
			$exp_q=' AND `exp`>'.intval($_POST['exp2']).' ';
			$mode_on++;
		}else{
			$exp_q=' AND `exp`<'.intval($_POST['exp2']).' ';
			$mode_on++;
		}
	}
	
	if($_POST['players_mode']=="true"){
		if($_POST['players1']=="true"){
			$players_q=' AND `players`>'.intval($_POST['players2']).' ';
			$mode_on++;
		}else{
			$players_q=' AND `players`<'.intval($_POST['players2']).' ';
			$mode_on++;
		}
	}
	
	if($_POST['uptime_mode']=="true"){
		if($_POST['uptime1']=="true"){
			$players_q=' AND `uptimepc`>'.intval($_POST['uptime2']).' ';
			$mode_on++;
		}else{
			$players_q=' AND `uptimepc`<'.intval($_POST['uptime2']).' ';
			$mode_on++;
		}
	}
	
	if($mode_on>0){
		$search_q_temp='SELECT * FROM `list_ots` WHERE `id`>0 '.$name_q.$status_q.$type_q.$country_q.$exptype_q.$map_q.$client_q.$exp_q.$players_q.$uptime_q;
		$search_q=$mysqli->query($search_q_temp);
		$i=0;
		
		echo '
	<table class="table footable">
	<thead>
		<tr>
			<th class="hidden-480" data-hide="phone,tablet">#</th>
			<th data-class="expand" data-sort-initial=""true"">'.$_LANG['server_info']['name'].'</th>
			<th class="hidden-480" data-hide="phone,tablet">IP</th>
			<th data-hide="phone,tablet">'.$_LANG['server_info']['client'].'</th>
			<th data-hide="phone,tablet">'.$_LANG['server_info']['players'].'</th>
			<th data-hide="phone,tablet">'.$_LANG['server_info']['country'].'</th>
			<th class="hidden-480" data-hide="phone,tablet">'.$_LANG['server_info']['uptime'].'</th>
			<th data-hide="phone,tablet">'.$_LANG['server_info']['status'].'</th>
		</tr>
	</thead>
	<tbody>';
		while($server_info=$search_q->fetch_assoc()){
			$check_ban=$mysqli->query('SELECT count(*) FROM `list_bans` where `server`="'.$server_info['id'].'"')->fetch_assoc();
			if($check_ban['count(*)']!=0){
				continue;
			}
			$i++;
			if($server_info['status']==1){
				$server_status='<td><span class="label label-success">Online</span></td>';
			}else{
				$server_status='<td><span class="label label-important">Offline</span></td>';
			}
			if($server_info['client']==-1){
				$server_info['client']=$_LANG['server_info']['na'];
			}
			$uptime_temp=explode('.',number_format($server_info['uptimepc'],2));
			$uptime=$uptime_temp[0];
			echo '
			<tr>
				<td class="hidden-480">'.$i.'</td>
				<td><a href="?page=view&id='.$server_info['id'].'">'.$server_info['name'].'</a></td>
				<td class="hidden-480">'.$server_info['ip'].'</td>
				<td>'.$server_info['client'].'</td>
				<td>'.$server_info['players'].' ('.$server_info['rec'].') / '.$server_info['maxplayers'].'</td>
				<td>'.$server_info['country'].'</td>
				<td class="hidden-480">'.$uptime.' %</td>		
				'.$server_status.'
			</tr>';
		}
		echo'
		</tbody>
		</table>';	
		if($i==0){
			echo '<p class="text-error">'.$_LANG['search']['no_result'].'</p>';
		}
	}else{
		echo '<p class="text-error">'.$_LANG['search']['no_result'].'</p>';
	}
}
?> 