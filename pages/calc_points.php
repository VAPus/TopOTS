<?php
if(isset($_GET['start']) and isset($_GET['end']) and isset($_GET['type'])){
	include('../includes/promote_config.php');
	if($_GET['type']=="cd"){
		$multipl=$_COUNTDOWN;
	}elseif($_GET['type']=="fit"){
		$multipl=$_FIT;
	}else{
		$multipl=0;
	}
	
	$date_start=str_replace("+"," ",$_GET['start']);
	$date_start=str_replace("_",":",$date_start);
	
	$date_end=str_replace("+"," ",$_GET['end']);
	$date_end=str_replace("_",":",$date_end);
	
	$date_start=strtotime($date_start);
	$date_end=strtotime($date_end);
	
	echo calc_points($date_start, $date_end, $multipl);
}
?>