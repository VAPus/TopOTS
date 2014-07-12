 <?php
 if(is_admin() and isset($_GET['id'])){
	echo '<div class="row-fluid">
		<div class="span12">
			<div class="well red">
				<div class="well-header">
					<h5>'.$_LANG['edit']['edit_serv'].'</h5>
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
				
	
	include('includes/type.php');
	include('includes/countries.php');
	include('includes/clients.php');
	include('includes/maps.php');
	include('includes/ImgUploader.class.php');
	require('includes/OTSChecker.class.php');
	
	$ID=intval($_GET['id']);
	
	
	$server=$mysqli->query('SELECT * FROM `list_ots` WHERE `id`="'.$ID.'"')->fetch_assoc();
	
	$type_string=NULL;
	$country_string=NULL;
	$client_string=NULL;
	$map_string=NULL;

	foreach($type as $value){
		if($value==$server['type']){
			$type_string.='<option selected="selected">'.$value.'</option>';
		}else{
			$type_string.='<option>'.$value.'</option>';
		}
	}

	foreach($countries as $value){
		if($value==$server['country']){
			$country_string.='<option selected="selected">'.$value.'</option>';
		}else{
			$country_string.='<option>'.$value.'</option>';
		}
	}

	foreach($Clients as $value){
		if($value==$server['client']){
			if($value=='-1'){
				$value=$_LANG['server_info']['na'];
			}
			$client_string.='<option selected="selected">'.$value.'</option>';
		}else{
			if($value=='-1'){
				$value=$_LANG['server_info']['na'];
			}
			$client_string.='<option>'.$value.'</option>';
		}
	}
	
	foreach($maps as $value){
		if($value==$server['map']){
			$map_string.='<option selected="selected">'.$value.'</option>';
		}else{
			$map_string.='<option>'.$value.'</option>';
		}
	}
	
	if($server['exp_type']==1){
		$exp_type_string='
		<div class="switch " data-animated="false" data-on-label="'.$_LANG['server_info']['stages'].'" data-on="primary" data-off="primary" data-off-label="'.$_LANG['server_info']['const'].'">
			<input name="exptype" type="checkbox" checked>
		</div>';
	}else{
		$exp_type_string='
		<div class="switch " data-animated="false" data-on-label="'.$_LANG['server_info']['stages'].'" data-on="primary" data-off="primary" data-off-label="'.$_LANG['server_info']['const'].'">
			<input name="exptype" type="checkbox">
		</div>';
	}
	
	if($server['comments']==1){
		$comments_string='
		<div class="switch " data-animated="false" data-on-label="'.$_LANG['add']['enable'].'" data-on="success" data-off="danger" data-off-label="'.$_LANG['add']['disable'].'">
			<input name="comments" type="checkbox" checked>
		</div>';
	}else{
		$comments_string='
		<div class="switch " data-animated="false" data-on-label="'.$_LANG['add']['enable'].'" data-on="success" data-off="danger" data-off-label="'.$_LANG['add']['disable'].'">
			<input name="comments" type="checkbox">
		</div>';
	}
	
	if($add_image_enable==1){
		$img_name=check_img($ID);
		if($img_name!=false){
			$img_src='server_img/'.$img_name;
			$remove_img=1;
			if(isset($_GET['action']) and $_GET['action']=="delete_img"){
				unlink($img_src);
				$remove_img=0;
				$img_src='http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image';
			}
		}else{
			$img_src='http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image';
			$remove_img=0;
		}
	}

	$name=$server['name'];
	$ip=$server['ip'];
	$port=$server['port'];
	$exp=$server['exp'];
	$desc=$server['desc'];
 
				if(isset($_POST['submit'])){
					$error=NULL;
					$name=mysql_real_escape_string($_POST['name']);
					$port=intval($_POST['port']);
					$exp=intval($_POST['exp']);
					$desc=mysql_real_escape_string(strip_tags($_POST['description']));
					if(isset($_POST['exptype'])){
						$exp_type=1;
					}else{
						$exp_type=2;
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
					
					
					if(!($port>=1000 and $port<=99999)){
						$error.='<p class="text-error">'.$_LANG['add']['port_error'].'</p>';
					}
					
					if(!($exp>0 and $exp<99999)){
						$error.='<p class="text-error">'.$_LANG['add']['exp_error'].'</p>';
					}
					
					if(!(strlen($desc)>=10 and strlen($desc)<=5000)){
						$error.='<p class="text-error">'.$_LANG['add']['desc_error'].'</p>';
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
						$time=time();
						$ins_q='UPDATE `list_ots`SET
						`name`="'.$name.'",
						`country`="'.$country.'",
						`port`="'.$port.'",
						`client`="'.$client.'",
						`desc`="'.$desc.'",
						`exp`="'.$exp.'",
						`type`="'.$serv_type.'",
						`exp_type`="'.$exp_type.'",
						`map`="'.$map.'",
						`comments`="'.$comments.'" 
						WHERE `id`="'.$ID.'"';
					
						$mysqli->query($ins_q);	
						
						if($do_upload==1){
							if($remove_img==1){
								unlink($img_src);
							}
							$img->upload_unscaled('server_img',$ID);
						}						
						
						echo '<p class="text-success">'.$_LANG['edit']['edited'].'</p>';
						header("Location: ?page=admin");
						exit;
						}
						$j=0;
					}else{
						$j=1;
						echo $error;
						if($client==-1){
							$client=$_LANG['server_info']['na'];
						}
					}
					if($errorr!=NULL and $j==0){
						echo $error;
						if($client==-1){
							$client=$_LANG['server_info']['na'];
						}
					}
				}
				
							
					$desc=str_replace("</br>","\n",$desc);
					echo '<form autocomplete="off" method="POST" action="?page=admin_eots&id='.$ID.'" enctype="multipart/form-data">
						<div class="form_row">
							<label class="field_name align_right">'.$_LANG['server_info']['name'].'</label>
							<div class="field">
								<input maxlength="20" name="name" class="span6" placeholder="5-20 '.$_LANG['register']['chars'].'" type="text" value="'.$name.'">
							</div>
						</div>
						<div class="form_row">
							<label class="field_name align_right">IP</label>
							<div class="field">
								<p>'.$ip.'</p>
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
								'.$exp_type_string.'
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
								'.$comments_string.'
							</div>
						</div>';
					if($add_image_enable==1){
						echo '<div class="form_row">
							<label class="field_name align_right">'.$_LANG['add']['map_opt'].'</label>
							<div class="field">
								<div class="fileupload fileupload-new" data-provides="fileupload">
								  <div class="fileupload-new thumbnail" style="width: 200px; height: 150px;"><img src="'.$img_src.'" /></div>
								  <div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 200px; max-height: 150px; line-height: 20px;"></div>
								  <div>
									<span class="btn btn-file"><span class="fileupload-new">'.$_LANG['add']['select'].'</span><span class="fileupload-exists">'.$_LANG['add']['map_change'].'</span>
									<input type="hidden" name="MAX_FILE_SIZE" value="30000000" />
									<input type="file" name="file" /></span>';
									if($remove_img==1){
										echo '<span class="btn btn-file"><a href="?page=admin_eots&id='.$ID.'&action=delete_img">'.$_LANG['edit']['delete'].'</a></span>';
									}
								  echo '
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
								<button name="submit" type="submit" class="btn btn-large blue">'.$_LANG['edit']['edit'].' <i class="icon-arrow-right"></i></button>
							</div>
						</div>
					</form>';
				
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