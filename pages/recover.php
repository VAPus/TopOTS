 <?php
 if(!is_logged()){
	$echo_form=1;
	$mail="";
 
	echo '<div class="row-fluid">
		<div class="span12">
			<div class="well purple">
				<div class="well-header">
					<h5>'.$_LANG['recover']['recover'].'</h5>
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
					$mail=mysql_real_escape_string($_POST['mail']);
					$mail_exist = $mysqli -> query ('SELECT count(*) FROM `list_acc` WHERE `mail`="'.$mail.'"')->fetch_assoc();
					
					if(!(check_mail($mail) and strlen($mail)<60)){
						$error.='<p class="text-error">'.$_LANG['recover']['mail_error'].'</p>';
					}
					
					if ($_SESSION['captcha']['code']!=$_POST['captcha']) {
						$error.='<p class="text-error">'.$_LANG['recover']['code_error'].'</p>';
					}
					
					
					if($mail_exist['count(*)']!=1){
						$error.='<p class="text-error">'.$_LANG['recover']['mail_exist'].'</p>';
					}
					
					if($error==NULL){
						$echo_form=0;
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
						
						$ins_q='UPDATE `list_acc` SET `to_reset`="1", `reset_key`="'.$key.'" WHERE `mail`="'.$mail.'"';
						$get_id=$mysqli->query('SELECT id FROM `list_acc` WHERE `mail`="'.$mail.'"')->fetch_assoc();
						$mysqli->query($ins_q);
						include('includes/class.phpmailer.php');
						send_recover($mail,$key,$get_id['id'],$domain);
						//mailer('recover',$mail,$key,$get_id['id'],$domain);
						echo '<p class="text-success">'.$_LANG['recover']['success'].'</p>';
					}else{
						echo $error;
					}
				}
				
				$_SESSION['captcha'] = captcha();
				if($echo_form==1){
					echo '<form autocomplete="off" method="POST" action="?page=recover">
						<div class="form_row">
							<label class="field_name align_right">Email</label>
							<div class="field">
								<input maxlength="60" placeholder="name@domain.com" name="mail" class="span6" type="text" value="'.$mail.'" autofocus>
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
							<label class="field_name align_right">'.$_LANG['recover']['code'].'</label>
							<div class="field">
								<input placeholder="Captcha" name="captcha" class="span4" type="text">
							</div>
						</div>
						<div class="form_row">
							<div class="field">
								<button name="submit" type="submit" class="btn btn-large blue">'.$_LANG['recover']['recover'].' <i class="icon-arrow-right"></i></button>
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