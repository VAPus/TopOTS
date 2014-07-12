 <?php
 if(is_logged()){
	include('includes/type.php');
	include('includes/countries.php');
	include('includes/clients.php');
	include('includes/maps.php');
	include('includes/ImgUploader.class.php');
	require('includes/OTSChecker.class.php');
	
	$type_string=NULL;
	$country_string=NULL;
	$client_string=NULL;
	$map_string=NULL;

	foreach($type as $value){
		$type_string.='<option>'.$value.'</option>';
	}

	foreach($countries as $value){
		$country_string.='<option>'.$value.'</option>';
	}

	foreach($Clients as $value){
		if($value=='-1'){
			$client_string.='<option>'. $_LANG['server_info']['na'].'</option>';
		}else{
			$client_string.='<option>'.$value.'</option>';
		}
	}
	
	foreach($maps as $value){
		$map_string.='<option>'.$value.'</option>';
	}

	$echo_form=1;
	$name="";
	$ip="";
	$port="7171";
	$exp="";
	$desc="";
 
	echo '<div class="row-fluid">
		<div class="span12">
			<div class="well red">
				<div class="well-header">
					<h5>'.$_LANG['add']['add_server'].'</h5>
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

				<div class="well-content">';
				if(isset($_POST['submit'])){
					$error=NULL;
					$name=mysql_real_escape_string($_POST['name']);
					$ip=mysql_real_escape_string($_POST['ip']);
					$port=intval($_POST['port']);
					$exp=intval($_POST['exp']);
					$desc=mysql_real_escape_string(strip_tags($_POST['description']));
					$ip_exist = $mysqli -> query ('SELECT count(*) FROM `list_ots` WHERE `ip`="'.$ip.'"')->fetch_assoc();
					$ban_exist = $mysqli -> query ('SELECT count(*) FROM `list_bans` WHERE `ip_ot`="'.$ip.'"')->fetch_assoc();
					$servers_count = $mysqli -> query ('SELECT count FROM `list_acc` WHERE `id`="'.$_SESSION['account']['id'].'"')->fetch_assoc();
					if(isset($_POST['exptype'])){
						$exp_type=1;
					}else{
						$exp_type=2;
					}
					
						if (!in_array($_POST['country'], $countries))
						{
							header("Location: ?page=list");
							exit;
						}
						
						if (!in_array($_POST['client'], $Clients))
						{
							header("Location: ?page=list");
							exit;
						}
						
						if (!in_array($_POST['map'], $maps))
						{
							header("Location: ?page=list");
							exit;
						}
						
						if (!in_array($_POST['type'], $type))
						{
							header("Location: ?page=list");
							exit;
						}
					
					$client=mysql_real_escape_string($_POST['client']);
					$country=mysql_real_escape_string($_POST['country']);
					$serv_type=mysql_real_escape_string($_POST['type']);
					$map=mysql_real_escape_string($_POST['map']);
					if(isset($_POST['comments'])){
						$comments=1;
					}else{
						$comments=0;
					}
					
					$do_upload=0;
					if($add_image_enable==1){
						$img = new ImgUploader($_FILES['file']);
						switch($img->getError()){
							case 101: $error.='<p class="text-error">'.$_LANG['add']['max_size'].'</p>'; break;
							case 104: $error.='<p class="text-error">'.$_LANG['add']['image_error'].'</p>'; break;
							case 105: $error.='<p class="text-error">'.$_LANG['add']['image_error'].'</p>'; break;
							case 103: $do_upload=0; break;
							case 0: $do_upload=1; break;
							default: $error.='<p class="text-error">'.$_LANG['add']['image_error'].'</p>'; break;
						}
					}
					
					if($client==$_LANG['server_info']['na']){
						$client=-1;
					}
					
					if(!(strlen($name)>=5 and strlen($name)<=20)){
						$error.='<p class="text-error">'.$_LANG['add']['name_error'].'</p>';
					}
					
					if(!(strlen($ip)>=3 and strlen($ip)<=30)){
						$error.='<p class="text-error">'.$_LANG['add']['ip_error'].'</p>';
					}
					
					if(!($port>=1000 and $port<=99999)){
						$error.='<p class="text-error">'.$_LANG['add']['port_error'].'</p>';
					}
					
					if(!($exp>0 and $exp<99999)){
						$error.='<p class="text-error">'.$_LANG['add']['exp_error'].'</p>';
					}
					
					if(!(strlen($desc)>=10 and strlen($desc)<=5000)){
						$error.='<p class="text-error">'.$_LANG['add']['desc_error'].'</p>';
					}
					
					if($ip_exist['count(*)']>0){
						$error.='<p class="text-error">'.$_LANG['add']['ip_exs'].'</p>';
					}
					
					if($ban_exist['count(*)']>0){
						$error.='<p class="text-error">'.$_LANG['add']['ip_ban'].'</p>';
					}
					
					if(intval($servers_count['count'])>= $max_servers){
						$error.='<p class="text-error">'.$_LANG['add']['max_serv'].'</p>';
					}
									
					if($error==NULL){
						$check_status2 = new OTSChecker($ip, $port);
						$check_status2 -> SocketTimeOut( 3 );
						$check_status2 -> GetData();
					
						if ( $check_status2 -> Status() != 'Online' )
						{
							$error.='<p class="text-error">'.$_LANG['add']['offline'].'</p>';
						}
						if($error==NULL){
						$echo_form=0;
						
						$time=time();
						$ins_q='INSERT INTO `list_ots`(
						`id`, 
						`owner`,
						`name`,
						`lastcheck`,
						`add_time`,
						`status`,
						`players`,
						`maxplayers`, 
						`country`,
						`ip`,
						`port`,
						`client`,
						`desc`,
						`exp`,
						`special`,
						`feat`,
						`header_promote`,
						`type`,
						`uptime`,
						`uptimepc`,
						`now_uptime`, 
						`rec`,
						`server_owner`,
						`server_ver`,
						`monsters`,
						`exp_type`,
						`map`,
						`last_online`,
						`comments`) VALUES (
						NULL,
						"'.$_SESSION['account']['id'].'",
						"'.$name.'",
						"'.$time.'",
						"'.$time.'",
						"1",
						"'.$check_status2 -> GetCountOfPlayersOnline().'",
						"'.$check_status2 -> GetMaxPlayersCount().'",
						"'.$country.'",
						"'.$ip.'",
						"'.$port.'",
						"'.$client.'",
						"'.$desc.'",
						"'.$exp.'",
						"0",
						"0",
						"0",
						"'.$serv_type.'",
						"1",
						"100",
						"'.$check_status2 -> GetNowUptime().'",
						"'.$check_status2 -> GetMaxPlayersRecord().'",
						"'.$check_status2 -> GetOwnerName().'",
						"'.$check_status2 -> GetServerVersion().'",
						"0",
						"'.$exp_type.'", 
						"'.$map.'",
						"'.$time.'",
						"'.$comments.'")';
						
						$mysqli->query($ins_q);
						$new_count=intval($servers_count['count'])+1;
						$up_q=$mysqli->query('UPDATE `list_acc` SET `count`="'.$new_count.'" WHERE `id`="'.$_SESSION['account']['id'].'"');		
						$server_id=$mysqli->query('SELECT `id` FROM `list_ots` ORDER BY `add_time` DESC LIMIT 1')->fetch_assoc();
						
						if($do_upload==1){
							$img->upload_unscaled('server_img',$server_id['id']);
						}
						
						$motd = mysql_real_escape_string(strip_tags($check_status2 -> GetMotd()));
						if($motd!=NULL or $motd!=0){
							$mysqli->query('INSERT INTO `list_motd` (`id`, `server`, `motd`, `date`) VALUES(NULL, "'.$server_id['id'].'", "'.$motd.'", "'.$time.'")');
						}
						
						echo '<p class="text-success">'.$_LANG['add']['added'].'</p>';
						}
						$j=0;
					}else{
						echo $error;
						$j=1;
					}
					if($error!=NULL and $j==0){
						echo $error;
					}
				}
				
							
				if($echo_form==1){
					echo '<form autocomplete="off" method="POST" action="?page=add" enctype="multipart/form-data">
						<div class="form_row">
							<label class="field_name align_right">'.$_LANG['server_info']['name'].'</label>
							<div class="field">
								<input maxlength="20" name="name" class="span6" placeholder="5-20 '.$_LANG['register']['chars'].'" type="text" value="'.$name.'">
							</div>
						</div>
						<div class="form_row">
							<label class="field_name align_right">IP</label>
							<div class="field">
								<input maxlength="30" name="ip" class="span6" placeholder="Max 20 '.$_LANG['register']['chars'].'" type="text" value="'.$ip.'">
							</div>
						</div>
						<div class="form_row">
							<label class="field_name align_right">Port</label>
							<div class="field">
								<input maxlength="5" name="port" class="span2" type="text" value="'.$port.'">
							</div>
						</div>
						<div class="form_row">
							<label class="field_name align_right">Exp</label>
							<div class="field">
								<input maxlength="4" name="exp" class="span2" placeholder="100" type="text" value="'.$exp.'">
							</div>
						</div>
						<div class="form_row">
							<label class="field_name align_right">'.$_LANG['server_view']['exp_type'].'</label>
							<div class="field">
								<div class="switch " data-animated="false" data-on-label="'.$_LANG['server_info']['stages'].'" data-on="primary" data-off="primary" data-off-label="'.$_LANG['server_info']['const'].'">
									<input name="exptype" type="checkbox" checked>
								</div>
							</div>
						</div>
						<div class="form_row">
							<label class="field_name align_right">'.$_LANG['server_info']['client'].'</label>
							<div class="field">													 
								<select name="client" class="chosen">
									'.$client_string.'
								</select>                                      
							</div>
						</div>
						<div class="form_row">
							<label class="field_name align_right">'.$_LANG['server_info']['country'].'</label>
							<div class="field">													 
								<select name="country" class="chosen">
									'.$country_string.'
								</select>                                      
							</div>
						</div>
						<div class="form_row">
							<label class="field_name align_right">'.$_LANG['server_info']['type'].'</label>
							<div class="field">													 
								<select name="type" class="chosen">
									'.$type_string.'
								</select>                                      
							</div>
						</div>
						<div class="form_row">
							<label class="field_name align_right">'.$_LANG['server_view']['map'].'</label>
							<div class="field">													 
								<select name="map" class="chosen">
									'.$map_string.'
								</select>                                      
							</div>
						</div>
						<div class="form_row">
							<label class="field_name align_right">'.$_LANG['add']['comments_en'].'</label>
							<div class="field">
								<div class="switch " data-animated="false" data-on-label="'.$_LANG['add']['enable'].'" data-on="success" data-off="danger" data-off-label="'.$_LANG['add']['disable'].'">
									<input name="comments" type="checkbox" checked>
								</div>
							</div>
						</div>';
					if( $add_image_enable==1){
						echo'<div class="form_row">
							<label class="field_name align_right">'.$_LANG['add']['map_opt'].'</label>
							<div class="field">
								<div class="fileupload fileupload-new" data-provides="fileupload">
								  <div class="fileupload-new thumbnail" style="width: 200px; height: 150px;"><img src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image" /></div>
								  <div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 200px; max-height: 150px; line-height: 20px;"></div>
								  <div>
									<span class="btn btn-file"><span class="fileupload-new">'.$_LANG['add']['select'].'</span><span class="fileupload-exists">'.$_LANG['add']['map_change'].'</span><input type="hidden" name="MAX_FILE_SIZE" value="30000000" />
									<input type="file" name="file" /></span>
								  </div>
								</div>
							</div>
						</div>';
					}
					echo'	<div class="form_row">
							<label class="field_name align_right">'.$_LANG['server_info']['desc'].'</label>
							<div class="field">
								<textarea maxlength="5000" name="description" class="textarea" placeholder="10-5000 '.$_LANG['register']['chars'].'" style="width: 100%; height: 300px">'.$desc.'</textarea>
							</div>
						</div>
						
						<div class="form_row">
							<div class="field">
								<button name="submit" type="submit" class="btn btn-large blue">'.$_LANG['add']['add'].' <i class="icon-arrow-right"></i></button>
							</div>
						</div>
					</form>';
				}
				echo '</div>
			</div>
		</div>
	</div>
	 <script src="js/library/bootstrap-fileupload.js"></script>';
}else{
	header("Location: ?page=list");
	exit;
}
?>