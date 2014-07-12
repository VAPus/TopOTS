<?php
/*
1 - voted +
2 - voted -
0 - no vote
*/

function vote($type, &$sql){
	$query = $sql -> query ( 'SELECT * FROM `list_votes` WHERE `server` = "' .$_GET['id']. '" AND `user`="'.$_SESSION['account']['id'].'"' );
	if ( $query -> num_rows == 0){
		if($type==1){
			$sql->query('INSERT INTO `list_votes`(`id`, `user`, `server`, `vote`) VALUES (NULL,"'.$_SESSION['account']['id'].'", "' .$_GET['id']. '", "1")');
		}elseif($type==2){
			$sql->query('INSERT INTO `list_votes`(`id`, `user`, `server`, `vote`) VALUES (NULL,"'.$_SESSION['account']['id'].'", "' .$_GET['id']. '", "2")');
		}
	}else{
		$vote_type=$query->fetch_assoc();
		if($vote_type['vote']!=$type){
			$sql->query('DELETE FROM `list_votes` WHERE `id`="'.$vote_type['id'].'"');
		}			
	}
}

function fav(&$sql){
	$query = $sql -> query ( 'SELECT count(*) FROM `list_favorites` WHERE `server` = "' .$_GET['id']. '" AND `user`="'.$_SESSION['account']['id'].'"' )->fetch_assoc();
	if ( $query['count(*)'] == 0){
		$sql -> query ( 'INSERT INTO `list_favorites`(`id`, `user`, `server`) VALUES (NULL,"'.$_SESSION['account']['id'].'","' .$_GET['id']. '")');
	}else{
		$sql -> query ( 'DELETE FROM `list_favorites` WHERE `server` = "' .$_GET['id']. '" AND `user`="'.$_SESSION['account']['id'].'"');
	}
}

if(is_logged()){
	if(isset($_GET['action'])){
		switch($_GET['action']){
			case "vote_good": vote(1, $mysqli); break;
			case "vote_bad": vote(2,$mysqli); break;
			case "fav": fav($mysqli); break;
		}
	}
	$vote_q=$mysqli -> query ( 'SELECT `vote` FROM `list_votes` WHERE `server` = "' .$ID. '" AND `user`="'.$_SESSION['account']['id'].'"' );
	if ( $vote_q -> num_rows == 1){
		$vote_type=$vote_q->fetch_assoc();
		if($vote_type['vote']==1){
			$class['vote_good']="used";
			$class['vote_bad']="";
		}else{
			$class['vote_good']="";
			$class['vote_bad']="used";
		}
		
	}else{
		$class['vote_good']="";
		$class['vote_bad']="";
	}
	
	$fav_q = $mysqli -> query ( 'SELECT count(*) FROM `list_favorites` WHERE `server` = "' .$_GET['id']. '" AND `user`="'.$_SESSION['account']['id'].'"' )->fetch_assoc();
	if ( $fav_q['count(*)'] == 0){
		$class['fav']="";
	}else{
		$class['fav']="used";
	}
}
?>