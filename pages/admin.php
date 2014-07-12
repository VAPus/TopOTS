<?php
if(is_logged() and is_admin()){	
	if(isset($_POST['submit_ban'])){
		$type=explode("_",$_POST['submit_ban']);
		$banid=intval($type[0]);
		$type2=$type[1];
		$days=(intval($_POST['ban_days'])*24*60*60)+time();
		if($type2=="server"){	
			$getip=$mysqli->query('SELECT ip FROM `list_ots` WHERE `id`="'.$banid.'"')->fetch_assoc();
			$mysqli->query('INSERT INTO `list_bans`(`id`, `accid`, `banned`, `server`,`ip_ot`, `end`) VALUES (
			NULL,
			"0",
			"1",
			"'.$banid.'",
			"'.$getip['ip'].'",
			"'.$days.'")');
		}elseif($type2=="acc"){
			$mysqli->query('INSERT INTO `list_bans`(`id`, `accid`, `banned`, `server`,`ip_ot`, `end`) VALUES (
			NULL,
			"'.$banid.'",
			"1",
			"0",
			"0",
			"'.$days.'")');
		}
	}	
	
	if(isset($_GET['deleteban'])){
		$delid=intval($_GET['deleteban']);
		
		$check_ex=$mysqli->query('SELECT count(*) FROM `list_bans` WHERE `id`="'.$delid.'"')->fetch_assoc();
		if($check_ex['count(*)']==0){
			header("Location: ?page=admin");
			exit;
		}
		$mysqli->query('DELETE FROM `list_bans` WHERE `id`="'.$delid.'"');
	}
	
	if(isset($_GET['deletebanacc'])){
		$delid=intval($_GET['deletebanacc']);
		
		$check_ex=$mysqli->query('SELECT count(*) FROM `list_bans` WHERE `id`="'.$delid.'"')->fetch_assoc();
		if($check_ex['count(*)']==0){
			header("Location: ?page=admin");
			exit;
		}
		$mysqli->query('DELETE FROM `list_bans` WHERE `id`="'.$delid.'"');
	}
	
	if(isset($_GET['delete'])){
		$delid=intval($_GET['delete']);
		
		$check_ex=$mysqli->query('SELECT count(*) FROM `list_ots` WHERE `id`="'.$delid.'"')->fetch_assoc();
		if($check_ex['count(*)']==0){
			header("Location: ?page=admin");
			exit;
		}
		
		$check_owner_q=$mysqli->query('SELECT `owner` FROM `list_ots` WHERE `id`="'.$delid.'"');
		if($check_owner_q->num_rows()==1){
			$check_owner=$check_owner_q->fetch_assoc();
			$servers_count = $mysqli -> query ('SELECT count FROM `list_acc` WHERE `id`="'.$check_owner['owner'].'"')->fetch_assoc();
			$new_count=intval($servers_count['count'])-1;
			$mysqli->query('UPDATE `list_acc` SET `count`="'.$new_count.'" WHERE `id`="'.$check_owner['owner'].'"');	
		}
		
		$mysqli->query('DELETE FROM `list_ots` WHERE `id`="'.$delid.'"');
		$mysqli->query('DELETE FROM `list_comments` WHERE `server`="'.$delid.'"');
		$mysqli->query('DELETE FROM `list_motd` WHERE `server`="'.$delid.'"');
		$mysqli->query('DELETE FROM `list_promote` WHERE `server`="'.$delid.'"');
		$mysqli->query('DELETE FROM `list_votes` WHERE `server`="'.$delid.'"');
		$mysqli->query('DELETE FROM `list_favorites` WHERE `server`="'.$delid.'"');
		
		$img_name=check_img($delid);
		if($img_name!=false){
			$img_src='server_img/'.$img_name;
			unlink($img_src);
		}
	}
	if(isset($_GET['deleteacc'])){
		$delid=intval($_GET['deleteacc']);
		
		$check_ex=$mysqli->query('SELECT count(*) FROM `list_acc` WHERE `id`="'.$delid.'"')->fetch_assoc();
		if($check_ex['count(*)']==0){
			header("Location: ?page=admin");
			exit;
		}
		
		$check_ots_q=$mysqli->query('SELECT id FROM `list_ots` WHERE `owner`="'.$delid.'"');
		if($check_ots_q->num_rows()>0){
			while($check_ots=$check_ots_q->fetch_assoc()){
				$mysqli->query('DELETE FROM `list_ots` WHERE `id`="'.$check_ots['id'].'"');
				$mysqli->query('DELETE FROM `list_comments` WHERE `id`="'.$check_ots['id'].'"');
				$mysqli->query('DELETE FROM `list_motd` WHERE `id`="'.$check_ots['id'].'"');
				$mysqli->query('DELETE FROM `list_promote` WHERE `id`="'.$check_ots['id'].'"');
				$mysqli->query('DELETE FROM `list_votes` WHERE `id`="'.$check_ots['id'].'"');
				$mysqli->query('DELETE FROM `list_favorites` WHERE `id`="'.$check_ots['id'].'"');
				
				$img_name=check_img($check_ots['id']);
				if($img_name!=false){
					$img_src='server_img/'.$img_name;
					unlink($img_src);
				}
			}
		}
		
		$mysqli->query('DELETE FROM `list_acc` WHERE `id`="'.$delid.'"');
	}
	
	$servers_string="";
	$servers=$mysqli->query('SELECT id,name,status FROM `list_ots` ORDER BY `name` ASC');
	if($servers->num_rows()>0){
		while($server=$servers->fetch_assoc()){
			if($server['status']==1){
				$color="green";
			}else{
				$color="red";
			}
			$servers_string.='<option style="color:'.$color.'" value="'.$server['id'].'">'.$server['name'].'</option>';
		}
	}
	$acc_string="";
	$accs=$mysqli->query('SELECT id,login FROM `list_acc` ORDER BY `login` ASC');
	if($servers->num_rows()>0){
		while($acc=$accs->fetch_assoc()){
			$acc_string.='<option value="'.$acc['id'].'">'.$acc['login'].'</option>';
		}
	}
	
	$bans_string="";
	$servers=$mysqli->query('SELECT id,banned,server,end FROM `list_bans` WHERE `server`!="0"');
	if($servers->num_rows()>0){
		while($server=$servers->fetch_assoc()){
			if($server['banned']==0){
				continue;
			}
			$server_info=$mysqli->query('SELECT ip FROM `list_ots` WHERE `id`="'.$server['server'].'"');
			if($server_info->num_rows()==1){
				$name_fa=$server_info->fetch_assoc();
				$name=$name_fa['ip'];
			}else{
				$name='Deleted server';
			}
			$bans_string.='<tr>
			<td>'.$name.'</td>
			<td>'.date('d-m-Y, H:i',$server['end']).'</td>
			<td><a href="?page=admin&deleteban='.$server['id'].'" class="btn red">Delete ban</a></td>
			</tr>';
		}
	}
	
	$bansacc_string="";
	$accs=$mysqli->query('SELECT id,banned,accid,end FROM `list_bans` WHERE `accid`!="0"');
	if($accs->num_rows()>0){
		while($acc=$accs->fetch_assoc()){
			if($acc['banned']==0){
				continue;
			}
			$acc_info=$mysqli->query('SELECT login FROM `list_acc` WHERE `id`="'.$acc['accid'].'"');
			if($acc_info->num_rows()==1){
				$name_fa=$acc_info->fetch_assoc();
				$name=$name_fa['login'];
			}else{
				$name='Deleted acc';
			}
			$bansacc_string.='<tr>
			<td>'.$name.'</td>
			<td>'.date('d-m-Y, H:i',$acc['end']).'</td>
			<td><a href="?page=admin&deletebanacc='.$acc['id'].'" class="btn red">Delete ban</a></td>
			</tr>';
		}
	}
	
	echo '			
	<div class="row-fluid">
	 <div class="well brown">
		<div class="well-header">
			<h5>Admin panel</h5>
			<ul>
				<li class="color_pick"><a href="#"><i class="icon-th"></i></a>
					<ul>
						<li><a class="blue set_color" href="#"></a></li>
						<li><a class="light_blue set_color" href="#"></a></li>
						<li><a class="grey set_color" href="#"></a></li>
						<li><a class="pink set_color" href="#"></a></li>
						<li><a class="red set_color" href="#"></a></li>
						<li><a class="orange set_color" href="#"></a></li>
						<li><a class="yellow set_color" href="#"></a></li>
						<li><a class="green set_color" href="#"></a></li>
						<li><a class="dark_green set_color" href="#"></a></li>
						<li><a class="turq set_color" href="#"></a></li>
						<li><a class="dark_turq set_color" href="#"></a></li>
						<li><a class="purple set_color" href="#"></a></li>
						<li><a class="violet set_color" href="#"></a></li>
						<li><a class="dark_blue set_color" href="#"></a></li>
						<li><a class="dark_red set_color" href="#"></a></li>
						<li><a class="brown set_color" href="#"></a></li>
						<li><a class="black set_color" href="#"></a></li>
					</ul>
				</li>
			</ul>
		</div>

		<div class="well-content no_padding">
			<div class="navbar-inner">
				<ul class="nav nav-tabs">
					<li class="active"><a href="#tab_serv" data-toggle="tab">Servers</a></li>
					<li><a href="#tab_servban" data-toggle="tab">Banned server</a></li>
					<li><a href="#tab_acc" data-toggle="tab">Accounts</a></li>
					<li><a  href="#tab_accban" data-toggle="tab">Banned accounts</a></li>
				</ul>
			</div>
			<div class="tab-content">
			  <div class="tab-pane active" id="tab_serv">
					<div class="form_row">
						<label class="field_name align_right">'.$_LANG['promote']['server'].'</label>
						<div class="field">													 
							<select name="servers_server" class="chosen">
								'.$servers_string.'
							</select>
						</div>
					</div>
					<div class="form_row">
						<div class="field">
							<a onclick="more_info(\''.$_SESSION['account']['id'].'\')" href="#more_info" data-toggle="modal" role="button" class="btn btn-large blue">More info<i class="icon-arrow-right"></i></a>							
							<button onclick="admin_eots()" class="btn btn-large blue">Edit<i class="icon-arrow-right"></i></button>							
							<a href="#ask_remove" onclick="setremoveid()" role="button" data-toggle="modal" class="btn btn-large blue">Delete<i class="icon-arrow-right"></i></a>							
							<a href="#ask_ban" onclick="setbanid(\'server\')" role="button" data-toggle="modal" class="btn btn-large blue">Ban<i class="icon-arrow-right"></i></a>							
						</div>
					</div>
			  </div>
			  <div class="tab-pane" id="tab_servban">
					<table class="table table-striped table-hover">
					   <thead>
						  <tr>
							  <th>Name</th>
							  <th>End</th>
							  <th>Delete</th>																	
						  </tr>
					   </thead>
					   <tbody>
							'.$bans_string.'
					   </tbody>
					  </table>
			  </div>
			  
				<div class="tab-pane" id="tab_acc">
					<div class="form_row">
						<label class="field_name align_right">Accounts</label>
						<div class="field">													 
							<select name="accs_acc" class="chosen">
								'.$acc_string.'
							</select>
						</div>
					</div>
					<div class="form_row">
						<div class="field">
							<a onclick="more_info_acc(\''.$_SESSION['account']['id'].'\')" href="#more_info" data-toggle="modal" role="button" class="btn btn-large blue">More info<i class="icon-arrow-right"></i></a>							
							<button onclick="admin_eacc()" class="btn btn-large blue">Edit<i class="icon-arrow-right"></i></button>							
							<a href="#ask_remove" onclick="setremoveidacc()" role="button" data-toggle="modal" class="btn btn-large blue">Delete<i class="icon-arrow-right"></i></a>							
							<a href="#ask_ban" onclick="setbanid(\'acc\')" role="button" data-toggle="modal" class="btn btn-large blue">Ban<i class="icon-arrow-right"></i></a>							
						</div>
					</div>
			  </div>
			  
			  <div class="tab-pane" id="tab_accban">
					<table class="table table-striped table-hover">
					   <thead>
						  <tr>
							  <th>Name</th>
							  <th>End</th>
							  <th>Delete</th>																	
						  </tr>
					   </thead>
					   <tbody>
							'.$bansacc_string.'
					   </tbody>
					  </table>
			  </div>			  	  
			</div>
		</div>
	</div>
	</div>
	
	
	
	<div id="more_info" class="modal container hide fade" tabindex="-1">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="icon-remove"></i></button>
        </div>
        <div class="modal-body">
           <div id="more_infotab">
		   
		   </div>
		</div>
    </div>
	
	
	<div id="ask_remove" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="icon-remove"></i></button>
            <h3>'.$_LANG['myservers']['warning'].'</h3>
        </div>
        <div id="delete_name" class="modal-body">
         
        </div>
        <div id="link" class="modal-footer">
            
        </div>
    </div>
	<script>
		function setremoveid(){
			var id=$("[name=servers_server]").val();
			$("#link").html(\'<a href="?page=admin&delete=\'+id+\'" class="btn red">'.$_LANG['myservers']['delete'].'!</a>\');
			$("#delete_name").html(\'<p>'.$_LANG['myservers']['delete_ask'].' ?</p>\');
		}
		function setremoveidacc(){
			var id=$("[name=accs_acc]").val();
			$("#link").html(\'<a href="?page=admin&deleteacc=\'+id+\'" class="btn red">'.$_LANG['myservers']['delete'].'!</a>\');
			$("#delete_name").html(\'<p>'.$_LANG['myservers']['delete_ask'].' ?</p>\');
		}
	</script>
	
	<div id="ask_ban" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="icon-remove"></i></button>
            <h3>'.$_LANG['myservers']['warning'].'</h3>
        </div>
        <div id="ban_c" class="modal-body">
			<div class="form_row">
				<form method="POST" action="?page=admin">
					<label class="field_name align_right">Days</label>
					<div class="field">
						<input maxlength="20" name="ban_days"  placeholder="Days..." type="text">
					</div>
				
			</div>
        </div>
        <div id="linkban" class="modal-footer">
            <button id="submit_ban" name="submit_ban" type="submit" class="btn red">OK!</button>
        </div>
		</form>
    </div>
	<script>
		function setbanid(type){
			var id=$("[name="+type+"s_"+type+"]").val();
			$("#submit_ban").val(id+\'_\'+type);
		}
	</script>';
	
}else{
	header("Location: ?page=list");
	exit;
}
?>