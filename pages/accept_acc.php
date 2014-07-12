 <?php
 if(!is_logged() and isset($_GET['id']) and isset($_GET['key'])){
	$echo_form=0;
	$id=intval($_GET['id']);
	$key=intval($_GET['key']);
	
	$check_rst=$mysqli->query('SELECT accepted, accept_key FROM `list_acc` WHERE `id`="'.$id.'" AND `accept_key`="'.$key.'"');
	if($check_rst->num_rows()==1){
		$acc=$check_rst->fetch_assoc();
		if($acc['accepted']==0 and $acc['accept_key']==$key){
			$ins_q='UPDATE `list_acc` SET `accepted`="1", `accept_key`="0" WHERE `id`="'.$id.'"';
			$mysqli->query($ins_q);
			echo '<p style="padding:15px;" class="text-success">'.$_LANG['register']['accepted'].'</p>';
		}else{
			header("Location: ?page=list");
			exit;
		}
	}else{
		header("Location: ?page=list");
		exit;
	}
}else{
	header("Location: ?page=list");
	exit;
}