<?php
if(is_logged()){
	$_SESSION['account']['status']=0;
	$_SESSION['account']['id']=-1;
	$_SESSION['account']['name']="";
	$_SESSION['account']['admin']=0;
	header("Location: ?page=list");
	exit;
}else{
	header("Location: ?page=list");
	exit;
}
?>