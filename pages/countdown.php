<?php
$time_now=time();
$server_cd_q=$mysqli->query('SELECT server,start,end FROM `list_promote` WHERE type="3" AND `start`<"'.$time_now.'" AND `end`>"'.$time_now.'"');
if($server_cd_q->num_rows()==1){
	$server_cd=$server_cd_q->fetch_assoc();
	$time_left='var time2='.($server_cd['end']-$time_now);
	$ID=$server_cd['server'];
	$server_cd=$mysqli->query('SELECT name FROM `list_ots` WHERE `id`="'.$ID.'"')->fetch_assoc();
	$string_cd='var string2=\' '.$_LANG['countdown']['part1'].' <a href="?page=view&id='.$ID.'">'.$server_cd['name'].' '.$_LANG['countdown']['part2'].'</a>\';';
	echo '
	<script>
		'.$time_left.'
		'.$string_cd.'
		
		var myVar2=setInterval(function(){myTimer2()},1000);
		function myTimer2()
		{
			time2--;
			if(time2<0){
				time2=0;
			}
			time_temp=time2;
			
			
			if(time_temp>=3600){
				time_h=Math.floor(time_temp/3600);
				time_temp=time_temp-time_h*3600;
			}else{
				time_h=0;
			}
			
			if(time_h<10){
				time_h2=\'0\';
			}else{
				time_h2=\'\';
			}
			
			if(time_temp>=60){
				time_m=(time_temp/60)|0;
				time_temp=time_temp-time_m*60;
			}else{
				time_m=0;
			}
			if(time_m<10){
				time_m2=\'0\';
			}else{
				time_m2=\'\';
			}
			if(time_temp<10){
				time_temp2=\'0\';
			}else{
				time_temp2=\'\';
			}
			$(\'#countdown\').html(\'<font style="font-size:43px">\'+time_h2+time_h+\':\'+time_m2+time_m+\':\'+time_temp2+time_temp+\'</font><font style="font-size:20px">\'+string2+\'</font>\');
			
		}
		</script>';
}
?> 