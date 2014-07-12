<?php
include_once('../mysql_config.php');
include_once('../config.php');


$now_time=time();
$featured_q=$mysqli->query('SELECT server FROM `list_promote` WHERE `start`<"'.$now_time.'" AND `end`>"'.$now_time.'" AND `type`="1"');
$i=0;
$servers=array();
if($featured_q->num_rows()>0){
	while($featured=$featured_q->fetch_assoc()){
		$i++;
		$servers[]=$featured['server'];
	}
}

if($i>0){
	$j=0;
	$array_string="";
	foreach($servers as $value){
		$j++;
		$server = $mysqli -> query ( 'SELECT id,name,ip,port,client,players,rec,maxplayers,country FROM `list_ots` WHERE `status` = "1" AND `id`="'.$value.'"' )->fetch_assoc();
		if($server['client']==-1){
			$server['client']=$_LANG['server_info']['na'];
		}
		$array_string.='myArray['.$j.']=[\'<a href="?page=view&id='.$server['id'].'">'.$server['name'].'</a>\',
		\''.$server['ip'].'\',
		\''.$server['port'].'\',
		\''.$server['client'].'\',
		\''.$server['country'].'\',
		\''.$server['players'].' ('.$server['rec'].') / '.$server['maxplayers'].'\'];';
	}
	$var='var count='.$j.';';
	
	echo '
	<script>
		'.$var.'
		var current=1;
		var myArray=[];
		'.$array_string.'
		var myVar=setInterval(function(){myTimer()},8000);
		var pre_img=\'<div class="preloader"><img class="preloader-img" src="img/preloader4.gif"></div>\';
		myTimer();
		function myTimer()
		{
			$(\'#feat_box\').fadeOut(0);
			$(\'#feat_box\').fadeIn(500);
	
			$(\'#feat_name\').html(myArray[current][0]);
			$(\'#feat_ip\').html(myArray[current][1]);
			$(\'#feat_port\').html(myArray[current][2]);
			$(\'#feat_ver\').html(myArray[current][3]);
			$(\'#feat_country\').html(myArray[current][4]);
			$(\'#feat_players\').html(myArray[current][5]);
			current++;
			if(current>count){
				current=1;
			}
			
		}
		</script>
';
}
?>