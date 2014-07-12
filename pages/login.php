<?php


if(!is_logged() and isset($_POST['submit'])){
	if ($_SESSION['csrf'] != $_POST['csrf']) die('You homo');

	$login=mysql_real_escape_string($_POST['login']);
	$pass=mysql_real_escape_string($_POST['password']);
	$login_q=$mysqli->query('SELECT id, login, admin, ban, accepted FROM `list_acc` WHERE `login`="'.$login.'" AND `pass`="'.md5($pass).'"');
	if($login_q->num_rows()==1){
		$user=$login_q->fetch_assoc();
		$ban_exist = $mysqli -> query ('SELECT count(*) FROM `list_bans` WHERE `accid`="'.$user['id'].'"')->fetch_assoc();
		if($ban_exist['count(*)']>=1){
			echo '<p style="padding:15px;" class="text-error">'.$_LANG['login']['banned'].'</p>';
		}elseif($user['accepted']==0){
			echo '<p style="padding:15px;" class="text-error">'.$_LANG['login']['not_accepted'].'</p>';
		}else{
			$_SESSION['account']['status']=1;
			$_SESSION['account']['id']=$user['id'];
			$_SESSION['account']['name']=$user['login'];
			if($user['admin']==1){
				$_SESSION['account']['admin']=1;
			}else{
				$_SESSION['account']['admin']=0;
			}
			header("Location: ?page=list");
			exit;
		}
	}else{
		echo '<p style="padding:15px;" class="text-error">'.$_LANG['login']['not_found'].'</p>';
	}
}

if(!is_logged()){
	$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
	$randomString = '';
	for ($i = 0; $i < 20; $i++)
	{
	 $randomString .= $characters[rand(0, strlen($characters) - 1)];
	}

	$_SESSION['csrf'] = $randomString;
	echo '
	<div style="padding:15px;" class="row-fluid">
	<div class="span4">
			<div class="login-header bordered">
				<h4>'.$_LANG['login']['login'].'</h4>
			</div>
			<form action="?page=login" method="POST">
			<input type="hidden" name="csrf" value="'.$randomString.'">
			
				<div class="login-field">
					<label for="username">'.$_LANG['login']['username'].'</label>
					<input type="text" name="login" id="login" placeholder="'.$_LANG['login']['username'].'" autofocus >
					<i class="icon-user"></i>
				</div>
				<div class="login-field">
					<label for="password">'.$_LANG['login']['password'].'</label>
					<input type="password" name="password" id="password" placeholder="'.$_LANG['login']['password'].'">
					<i class="icon-lock"></i>
				</div>
				<div class="login-button clearfix">
					<button name="submit" type="submit" class="pull-right btn btn-large blue">'.$_LANG['login']['login'].'<i class="icon-arrow-right"></i></button>
				</div>
				<div class="forgot-password">
					<a href="?page=recover" role="button" data-toggle="modal">'.$_LANG['login']['recover'].'</a>
				</div>
			</form>
		</div>
	</div>';
}else{
	header("Location: ?page=list");
	exit;
}

?>