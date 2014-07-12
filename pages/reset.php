 <?php
 if(!is_logged() and isset($_GET['id']) and isset($_GET['key'])){
	$echo_form=0;
	$id=intval($_GET['id']);
	$key=intval($_GET['key']);
	
	$check_rst=$mysqli->query('SELECT to_reset, reset_key FROM `list_acc` WHERE `id`="'.$id.'" AND `reset_key`="'.$key.'"');
	if($check_rst->num_rows()==1){
		$acc=$check_rst->fetch_assoc();
		if($acc['to_reset']==1 and $acc['reset_key']==$key){
			$echo_form=1;
		}else{
			header("Location: ?page=list");
			exit;
		}
	}else{
		header("Location: ?page=list");
		exit;
	}
 
	echo '<div class="row-fluid">
		<div class="span12">
			<div class="well purple">
				<div class="well-header">
					<h5>'.$_LANG['reset']['resetpass'].'</h5>
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
					$pass=mysql_real_escape_string($_POST['pass1']);
					$pass2=mysql_real_escape_string($_POST['pass2']);
					
					if(!(check_string2($pass) and strlen($pass)>=5 and strlen($pass)<=15)){
						$error.='<p class="text-error">'.$_LANG['reset']['pass_error'].'</p>';
					}
					
					if($pass!=$pass2){
						$error.='<p class="text-error">'.$_LANG['reset']['pass_error2'].'</p>';
					}
					
					if($error==NULL){
						$echo_form=0;						
						$ins_q='UPDATE `list_acc` SET `pass`="'.md5($pass).'", `reset_key`="0", `to_reset`="0" WHERE `id`="'.$id.'"';
						$mysqli->query($ins_q);
						echo '<p class="text-success">'.$_LANG['reset']['success'].'</p>';
					}else{
						echo $error;
					}
				}
				
				$_SESSION['captcha'] = captcha();
				if($echo_form==1){
					echo '<form autocomplete="off" method="POST" action="?page=reset&id='.$id.'&key='.$key.'">
						<div class="form_row">
							<label class="field_name align_right">'.$_LANG['reset']['pass'].'</label>
							<div class="field">
								<input maxlength="15" name="pass1" placeholder="5-15 '.$_LANG['reset']['chars'].'" type="password" class="span6" type="text" autofocus>
							</div>
						</div>
						<div class="form_row">
							<label class="field_name align_right">'.$_LANG['reset']['pass2'].'</label>
							<div class="field">
								<input maxlength="15" placeholder="5-15 '.$_LANG['reset']['chars'].'" name="pass2" type="password" class="span6" type="text">
							</div>
						</div>
						<div class="form_row">
							<div class="field">
								<button name="submit" type="submit" class="btn btn-large blue">'.$_LANG['reset']['reset'].' <i class="icon-arrow-right"></i></button>
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