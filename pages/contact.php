 <?php
	$mail="";
	$message="";
	$error="";
	if(isset($_POST['submit'])){
		$error=NULL;
		$mail=mysql_real_escape_string($_POST['mail']);
		$message=mysql_real_escape_string(strip_tags($_POST['message']));
		
		if ($_SESSION['captcha']['code']!=$_POST['captcha']) {
			$error.='<p class="text-error">'.$_LANG['register']['captcha_error'].'</p>';
		}
		
		if(!(check_mail($mail) and strlen($mail)<60)){
			$error.='<p class="text-error">'.$_LANG['register']['mail_error'].'</p>';
		}
		
		if(!(strlen($message)>=20 and strlen($message)<=250)){
			$error.='<p class="text-error">'.$_LANG['contact']['message_error'].'</p>';
		}

		if($error==NULL){
			include('includes/class.phpmailer.php');
			send_form('contact',$admin_mail,$mail.': </br> - '.$message);
			//mailer('contact',$admin_mail,$mail.': </br> - '.$message);
			echo '<p class="text-success">'.$_LANG['contact']['sent'].'</p>';
		}
	}
	echo '<div class="row-fluid">
		<div class="span12">
			<div class="well black">
				<div class="well-header">
					<h5>'.$_LANG['contact']['contact'].'</h5>
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
				</div>';
				
				$_SESSION['captcha'] = captcha();
				
				echo '
				<div class="well-content">
					'.$error.'								
					<form autocomplete="off" method="POST" action="?page=contact">
						<div class="form_row">
							<label class="field_name align_right">Mail</label>
							<div class="field">
								<input maxlength="60" name="mail" class="span6" placeholder="5-20 '.$_LANG['register']['chars'].'" type="text" value="'.$mail.'">
							</div>
						</div>
							<div class="form_row">
							<label class="field_name align_right">'.$_LANG['contact']['message'].'</label>
							<div class="field">
								<textarea maxlength="250" name="message" class="textarea" placeholder="20-250 '.$_LANG['register']['chars'].'" style="width: 100%; height: 300px">'.$message.'</textarea>
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
								<button name="submit" type="submit" class="btn btn-large blue">OK <i class="icon-arrow-right"></i></button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
';
?>