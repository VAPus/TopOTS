 <?php
 if(is_admin() and isset($_GET['id'])){
	$error=NULL;
	$ID=$_GET['id'];
	if(isset($_POST['submit'])){
		$mail=mysql_real_escape_string($_POST['mail']);
		$login=mysql_real_escape_string($_POST['login']);
		$pass=mysql_real_escape_string($_POST['pass1']);
		$pass2=mysql_real_escape_string($_POST['pass2']);
		$points=intval($_POST['points']);
		if(isset($_POST['admin'])){
			$admin=1;
		}else{
			$admin=0;
		}
		if(isset($_POST['accepted'])){
			$accepted=1;
		}else{
			$accepted=0;
		}
		
		
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
		
		if(!(check_string2($login) and strlen($login)>=5 and strlen($login)<=15)){
			$error.='<p class="text-error">'.$_LANG['register']['login_error'].'</p>';
		}
		
		if(!($points>0 and $points<9999999999)){
			$error.='<p class="text-error">Points error</p>';
		}
		
		if($error==NULL){
			$ins_q='UPDATE `list_acc` SET `login`="'.$login.'", `mail`="'.$mail.'", `points`="'.$points.'", `admin`="'.$admin.'", `accepted`="'.$accepted.'" '.$pass_string.' WHERE `id`="'.$ID.'"';
			
			$mysqli->query($ins_q);
		}
	}
	
	$user_info=$mysqli->query('SELECT login,mail, points,admin,accepted FROM `list_acc` WHERE `id`="'.$ID.'"')->fetch_assoc();
	$login=mysql_real_escape_string($user_info['login']);
	$mail=mysql_real_escape_string($user_info['mail']);
	$points=intval($user_info['points']);
	if($user_info['admin']==1){
		$admin_string='
		<div class="switch " data-animated="false" data-on-label="Yes" data-on="primary" data-off="primary" data-off-label="No">
			<input name="admin" type="checkbox" checked>
		</div>';
	}else{
		$admin_string='
		<div class="switch " data-animated="false" data-on-label="Yes" data-on="primary" data-off="primary" data-off-label="No">
			<input name="admin" type="checkbox">
		</div>';
	}
	if($user_info['accepted']==1){
		$accepted_string='
		<div class="switch " data-animated="false" data-on-label="Yes" data-on="primary" data-off="primary" data-off-label="No">
			<input name="accepted" type="checkbox" checked>
		</div>';
	}else{
		$accepted_string='
		<div class="switch " data-animated="false" data-on-label="Yes" data-on="primary" data-off="primary" data-off-label="No">
			<input name="accepted" type="checkbox">
		</div>';
	}
	
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
					<form autocomplete="off" method="POST" action="?page=admin_eacc&id='.$ID.'">
						<div class="form_row">
							<label class="field_name align_right">Login</label>
							<div class="field">
								<input value="'.$login.'" maxlength="60" value="placeholder="" name="login" class="span6" type="text">
							</div>
						</div>
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
							<label class="field_name align_right">Points</label>
							<div class="field">
								<input maxlength="10" name="points" class="span2" type="text" value="'.$points.'">
							</div>
						</div>
						<div class="form_row">
							<label class="field_name align_right">Admin</label>
							<div class="field">
								'.$admin_string.'
							</div>
						</div>
						<div class="form_row">
							<label class="field_name align_right">Accepted</label>
							<div class="field">
								'.$accepted_string.'
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