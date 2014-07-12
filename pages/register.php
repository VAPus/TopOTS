 <?php
 if(!is_logged()){
	$echo_form=1;
	$login="";
	$mail="";
 
	echo '<div class="row-fluid">
		<div class="span12">
			<div class="well red">
				<div class="well-header">
					<h5>'.$_LANG['register']['register'].'</h5>
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
					if ($_SESSION['csrf'] != $_POST['csrf']) die('You homo');

					$error=NULL;
					$login=mysql_real_escape_string($_POST['login']);
					$mail=mysql_real_escape_string($_POST['mail']);
					$pass=mysql_real_escape_string($_POST['pass1']);
					$pass2=mysql_real_escape_string($_POST['pass2']);
					$login_exist = $mysqli -> query ('SELECT count(*) FROM `list_acc` WHERE `login`="'.$login.'"')->fetch_assoc();
					$mail_exist = $mysqli -> query ('SELECT count(*) FROM `list_acc` WHERE `mail`="'.$mail.'"')->fetch_assoc();
					
					if(!(check_string2($login) and strlen($login)>=3 and strlen($login)<=15)){
						$error.='<p class="text-error">'.$_LANG['register']['login_error'].'</p>';
					}
					
					if(!(check_string2($pass) and strlen($pass)>=3 and strlen($pass)<=15)){
						$error.='<p class="text-error">'.$_LANG['register']['pass_error'].'</p>';
					}
					
					if($pass!=$pass2){
						$error.='<p class="text-error">'.$_LANG['register']['pass_error2'].'</p>';
					}
					
					if(!(check_mail($mail) and strlen($mail)<60)){
						$error.='<p class="text-error">'.$_LANG['register']['mail_error'].'</p>';
					}
					
					if ($_SESSION['captcha']['code']!=$_POST['captcha']) {
						$error.='<p class="text-error">'.$_LANG['register']['captcha_error'].'</p>';
					}
					
					if($login_exist['count(*)']>0){
						$error.='<p class="text-error">'.$_LANG['register']['login_ex'].'</p>';
					}
					
					if($mail_exist['count(*)']>0){
						$error.='<p class="text-error">'.$_LANG['register']['mail_ex'].'</p>';
					}
					
					if($error==NULL){
						$echo_form=0;
						if($register_accept==1){
							$accepted=0;
							$chars="1234567890";
							$minchars=7;
							$maxchars=9;
							$escapecharplus=0;
							$repeat=mt_rand($minchars,$maxchars);
							$key='';
							while ($escapecharplus<$repeat)
							{
								$key.=$chars[mt_rand(1, strlen($chars)-1)];
								$escapecharplus+=1;
							}
						}else{
							$accepted=1;
							$key=0;
						}
						
						$IP = $_SERVER['REMOTE_ADDR'];
						$IP = ip2long($IP);
						
						$ins_q='INSERT INTO `list_acc`(`id`, `login`, `pass`, `mail`, `points`, `admin`, `count`, `ban`, `accepted`, `accept_key`,`to_reset`, `reset_key`, `ip`) VALUES (
						NULL,
						"'.$login.'",
						"'.md5($pass).'",
						"'.$mail.'",
						"0",
						"0",
						"0",
						"0",
						"'.$accepted.'",
						"'.$key.'",
						"0",
						"0",
						"'.$IP.'")';
						$mysqli->query($ins_q);
							
						echo '<p class="text-success">'.$_LANG['register']['succes'].'</br>';
						if($register_accept==1){
							echo ''.$_LANG['register']['succes_accept'].'</p>';
							$getid=$mysqli->query('SELECT id FROM `list_acc` WHERE `login`="'.$login.'" AND `mail`="'.$mail.'"')->fetch_assoc();
							//mailer('register', $mail,$key,$getid['id'],$domain);
							include('includes/class.phpmailer.php');
							send_register($mail,$key,$getid['id'],$domain);
						}else{
							echo ''.$_LANG['register']['succes_noaccept'].'</p>';
						}
					}else{
						echo $error;
					}
				}
				
				$_SESSION['captcha'] = captcha();
				if($echo_form==1){
					$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
					$randomString = '';
					for ($i = 0; $i < 20; $i++)
						{
					$randomString .= $characters[rand(0, strlen($characters) - 1)];
						}

					$_SESSION['csrf'] = $randomString;
					
					echo '<form method="POST" action="?page=register">
							<input type="hidden" name="csrf" value="'.$randomString.'">
						<div class="form_row">
							<label class="field_name align_right">'.$_LANG['register']['username'].'</label>
							<div class="field">
								<input maxlength="15" name="login" class="span6" placeholder="3-15 '.$_LANG['register']['chars'].'" type="text" value="'.$login.'">
							</div>
						</div>
						<div class="form_row">
							<label class="field_name align_right">Mail</label>
							<div class="field">
								<input maxlength="60" placeholder="name@domain.com" name="mail" class="span6" type="text" value="'.$mail.'">
							</div>
						</div>
						<div class="form_row">
							<label class="field_name align_right">'.$_LANG['register']['pass'].'</label>
							<div class="field">
								<input maxlength="15" name="pass1" placeholder="3-15 '.$_LANG['register']['chars'].'" type="password" class="span6" type="text">
							</div>
						</div>
						<div class="form_row">
							<label class="field_name align_right">'.$_LANG['register']['pass2'].'</label>
							<div class="field">
								<input maxlength="15" placeholder="3-15 '.$_LANG['register']['chars'].'" name="pass2" type="password" class="span6" type="text">
							</div>
						</div>
						
						<div class="form_row">
							<label class="field_name align_right">Captcha</label>
							<div class="field">
								<div class="fileupload fileupload-new" data-provides="fileupload">
								  <div class="fileupload-new thumbnail" ><img src="'.$_SESSION['captcha']['image_src'].'"/></div>
								</div>
							</div>
						</div>
						<div class="form_row">
							<label class="field_name align_right">'.$_LANG['register']['code'].'</label>
							<div class="field">
								<input placeholder="Captcha" name="captcha" class="span4" type="text">
							</div>
						</div>
						<div class="form_row">
							<div class="field">
								<button name="submit" type="submit" class="btn btn-large blue">'.$_LANG['register']['register'].' <i class="icon-arrow-right"></i></button>
							</div>
						</div>
					</form>';
				}
				echo '</div>
			</div>
		</div>
	</div>';
}else{
	header("Location: ?page=list");
	exit;
}
?>