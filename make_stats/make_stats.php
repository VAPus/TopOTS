<?php
function OneOrTwo ( $One, $Two )
{
	if ( $One == NuLL OR $One == 0 OR !isset ($One) )
		return $Two;
	else
		return $One;
}
$gl_time1=time();


	include ( '../mysql_config.php' );
	include ( '../config.php' );
	include ( '../includes/OTSChecker.class.php' );


	$SearchQuery = $mysqli -> query ( 'SELECT * FROM `list_ots`' );
	$OTServ = NuLL;
	while ($Row = $SearchQuery -> fetch_assoc())
	{
		$check_ban=$mysqli->query('SELECT count(*) FROM `list_bans` where `server`="'.$Row['id'].'"')->fetch_assoc();
		if($check_ban['count(*)']!=0){
			continue;
		}
		$motd=NULL;
		$OTServ = new OTSChecker ( $Row['ip'] , $Row['port']);
		$OTServ -> SocketTimeOut( 1 );
		$OTServ -> GetData();
		$time=time();
		
		if ( $OTServ -> Status() == 'Online')
		{
			//motd
			$motd = mysql_real_escape_string(strip_tags($OTServ -> GetMotd()));
			if( $motd==$delete_motd){
				$mysqli->query('DELETE FROM `list_ots` WHERE `id`="'.$Row['id'].'"');
				continue;
			}
			if($motd!=NULL or $motd!=0)
			{
				$MQuery = 'INSERT INTO `list_motd` (`id`, `server`, `motd`, `date`) VALUES(NULL, "'.$Row['id'].'", "'.$motd.'", "'.$time.'")';
				$SearchQuery2 = $mysqli -> query ( 'SELECT `motd` AS motd FROM `list_motd` WHERE `server`="'.$Row['id'].'" ORDER BY `date` DESC LIMIT 1' );
				$last_motd = $SearchQuery2->fetch_assoc();
				$last_motd = $last_motd['motd'];
				if($motd!=$last_motd){
					$SearchQuery2 = $mysqli -> query ( 'SELECT count(*) FROM `list_motd` WHERE `server`="'.$Row['id'].'"' );
					$count = $SearchQuery2->fetch_assoc();
					$count = $count['count(*)'];
					if($count<$max_motd){
						$mysqli -> query ( $MQuery );
					}else{
						$SearchQuery2 = $mysqli -> query ( 'SELECT `id` AS id FROM `list_motd` WHERE `server`="'.$Row['id'].'" ORDER BY ASC LIMIT 1' );
						$Row2 = $SearchQuery2->fetch_assoc();
						$mysqli -> query ( 'DELETE FROM `list_motd` WHERE `id`="'.$Row2['id'].'"' );
						$mysqli -> query ( $MQuery );
					}
				}
			}
		
			//uptime
			
			
			
			if($Row['status']==1){	
				$online_time=$Row['uptime']+ ($time-$Row['lastcheck']);	
				$uptimepc=($online_time / ($time-$Row['add_time']+1))*100;
				$mysqli -> query ( 'UPDATE `list_ots` SET `uptimepc`="'.$uptimepc.'", `uptime`="'.$online_time.'", `lastcheck`="'.$time.'" WHERE `id`="'.$Row['id'].'"');
			}else{
				$uptimepc=($Row['uptime'] / ($time-$Row['add_time']+1))*100;
				$mysqli -> query ( 'UPDATE `list_ots` SET `uptimepc`="'.$uptimepc.'", `lastcheck`="'.$time.'" WHERE `id`="'.$Row['id'].'"');
			}
			
			
			//others
			$players_on=OneOrTwo( $OTServ -> GetCountOfPlayersOnline() , $Row['players'] );
			$players_rec=OneOrTwo( $OTServ -> GetMaxPlayersRecord() , $Row['rec'] );
			$players_max=OneOrTwo( $OTServ -> GetMaxPlayersCount() , $Row['maxplayers'] );
			$serv_owner=OneOrTwo( $OTServ -> GetOwnerName() , $Row['server_owner'] );
			$serv_ver=OneOrTwo( $OTServ -> GetServerVersion() , $Row['server_ver'] );
			$serv_monsters=OneOrTwo( 0 , $Row['monsters'] );
			$now_uptime=OneOrTwo( $OTServ -> GetNowUptime() , $Row['now_uptime'] );
			$mysqli -> query ( 'UPDATE `list_ots` SET `status`="1", `last_online`="'.$time.'", `now_uptime`="'.$now_uptime.'", `players`="'.$players_on.'", `rec`="'.$players_rec.'", `maxplayers`="'.$players_max.'", `server_owner`="'.$serv_owner.'", `server_ver`="'.$serv_ver.'", `monsters`="'.$serv_monsters.'" WHERE `id`="'.$Row['id'].'"');
		}else{
			$uptimepc=($Row['uptime'] / ($time-$Row['add_time']+1))*100;
			$mysqli -> query ( 'UPDATE `list_ots` SET `uptimepc`="'.$uptimepc.'", `lastcheck`="'.$time.'", `status`="0", `now_uptime`="0", `players` = "0" WHERE `id`="' .$Row['id']. '"' );		
		}
	}
$gl_time2=time();
echo $gl_time2-$gl_time1.'</br>';
?>
