<?php
	include ( '../mysql_config.php' );
	
	$SearchQuery = $mysqli -> query ( 'SELECT id,end FROM `list_bans`' );
	while ($Row = $SearchQuery -> fetch_assoc())
	{
		$now_time=time();
		if($Row['end']>=$now_time){
			$mysqli->query('DELETE FROM `list_bans` WHERE `id`="'.$Row['id'].'"');
		}			
	}
?>
