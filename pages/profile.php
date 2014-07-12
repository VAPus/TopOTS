 <?php
 if(is_logged()){
	$error=NULL;
	if(isset($_POST['submit'])){
		$mail=mysql_real_escape_string($_POST['mail']);
		$pass=mysql_real_escape_string($_POST['pass1']);
		$pass2=mysql_real_escape_string($_POST['pass2']);
		$pass3=mysql_real_escape_string($_POST['pass3']);
		$check_pass=$mysqli->query('SELECT pass FROM `list_acc` WHERE `id`="'.$_SESSION['account']['id'].'"')->fetch_assoc();
		
		$pass_string="";
		if(strlen($pass)!=0){	
			if(!(check_string2($pass) and strlen($pass)>=5 and strlen($pass)<=15)){
				$error.='<p class="text-error">'.$_LANG['profile']['new_pass'].'</p>';
			}
			
			if($pass!=$pass2){
				$error.='<p class="text-error">'.$_LANG['register']['pass_error2'].'</p>';
			}
			
			$pass_string=' ,`pass`="'.md5($pass).'" ';
		}
		
		if(!(check_mail($mail) and strlen($mail)<60)){
			$error.='<p class="text-error">'.$_LANG['register']['mail_error'].'</p>';
		}
		
		if($check_pass['pass']!=md5($pass3)){
			$error.='<p class="text-error">'.$_LANG['profile']['curr_pass'].'</p>';
		}
		
		if($error==NULL){
			$ins_q='UPDATE `list_acc` SET `mail`="'.$mail.'"'.$pass_string.'WHERE `id`="'.$_SESSION['account']['id'].'"';
			$mysqli->query($ins_q);
		}
	}
	
	$user_info=$mysqli->query('SELECT mail, pass FROM `list_acc` WHERE `id`="'.$_SESSION['account']['id'].'"')->fetch_assoc();
	$mail=mysql_real_escape_string($user_info['mail']);
	
	echo '<div class="row-fluid">
		<div class="span12">
			<div class="well dark_blue">
				<div class="well-header">
					<h5>'.$_LANG['profile']['profile'].'</h5>
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
				<div class="well-content">
					'.$error.'
					<form autocomplete="off" method="POST" action="?page=profile">
						<div class="form_row">
							<label class="field_name align_right">Mail</label>
							<div class="field">
								<input value="'.$mail.'" maxlength="60" value="placeholder="name@domain.com" name="mail" class="span6" type="text" value="'.$mail.'">
							</div>
						</div>
						<div class="form_row">
							<label class="field_name align_right">'.$_LANG['profile']['new_password'].'</label>
							<div class="field">
								<input maxlength="15" name="pass1" placeholder="5-15 '.$_LANG['register']['chars'].'" type="password" class="span6" type="text">
							</div>
						</div>
						<div class="form_row">
							<label class="field_name align_right">'.$_LANG['profile']['new_password2'].'</label>
							<div class="field">
								<input maxlength="15" placeholder="5-15 '.$_LANG['register']['chars'].'" name="pass2" type="password" class="span6" type="text">
							</div>
						</div>
						<div class="form_row">
							<label class="field_name align_right">'.$_LANG['profile']['password'].'</label>
							<div class="field">
								<input maxlength="15" placeholder="5-15 '.$_LANG['register']['chars'].'" name="pass3" type="password" class="span6" type="text">
							</div>
						</div>
						<div class="form_row">
							<div class="field">
								<button name="submit" type="submit" class="btn btn-large blue">OK<i class="icon-arrow-right"></i></button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>';
}else{
	header("Location: ?page=list");
	exit;
}
?>