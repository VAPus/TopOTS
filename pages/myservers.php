<?php
if(is_logged()){
if(isset($_GET['delete'])){
	$delid=intval($_GET['delete']);
	
	$check_ex=$mysqli->query('SELECT count(*) FROM `list_ots` WHERE `id`="'.$delid.'"')->fetch_assoc();
	if($check_ex['count(*)']==0){
		header("Location: ?page=myservers");
		exit;
	}
		
	$check_owner_q=$mysqli->query('SELECT `owner` FROM `list_ots` WHERE `id`="'.$delid.'"');
	if($check_owner_q->num_rows()==1){
		$check_owner=$check_owner_q->fetch_assoc();
		if($check_owner['owner']!=$_SESSION['account']['id']){
			header("Location: ?page=list");
			exit;
		}
	}else{
		header("Location: ?page=list");
		exit;
	}
	
	$mysqli->query('DELETE FROM `list_ots` WHERE `id`="'.$delid.'"');
	$mysqli->query('DELETE FROM `list_comments` WHERE `server`="'.$delid.'"');
	$mysqli->query('DELETE FROM `list_motd` WHERE `server`="'.$delid.'"');
	$mysqli->query('DELETE FROM `list_promote` WHERE `server`="'.$delid.'"');
	$mysqli->query('DELETE FROM `list_votes` WHERE `server`="'.$delid.'"');
	$mysqli->query('DELETE FROM `list_favorites` WHERE `server`="'.$delid.'"');
	
	$img_name=check_img($delid);
	if($img_name!=false){
		$img_src='server_img/'.$img_name;
		unlink($img_src);
	}
	
	$servers_count = $mysqli -> query ('SELECT count FROM `list_acc` WHERE `id`="'.$_SESSION['account']['id'].'"')->fetch_assoc();
	$new_count=intval($servers_count['count'])-1;
	$mysqli->query('UPDATE `list_acc` SET `count`="'.$new_count.'" WHERE `id`="'.$_SESSION['account']['id'].'"');	
}	
	
	
$servers_q = $mysqli -> query ( 'SELECT id, name, status FROM `list_ots` WHERE `owner` = "'.$_SESSION['account']['id'].'" ORDER BY `add_time` DESC' );

echo '
<div class="row-fluid">
<div class="span12">
                        <div class="well turq">
                            <div class="well-header">
                                <h5>'.$_LANG['myservers']['myservers'].'</h5>
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

                            <div class="well-content">
                                <table class="table table-striped table-hover">
                                   <thead>
                                      <tr>
									  <th> '.$_LANG['server_info']['name'].'</th>
									  <th> '.$_LANG['server_info']['status'].'</th>
									  <th> '.$_LANG['myservers']['operations'].'</th>									
                                      </tr>
                                   </thead>
                                   <tbody>';
								   
										if ( $servers_q -> num_rows() < 1 )
										{
											echo $_LANG['search']['no_result'];
										} else {
											while ( $server = $servers_q -> fetch_assoc () )
											{
												$check_ban=$mysqli->query('SELECT count(*) FROM `list_bans` where `server`="'.$server['id'].'"')->fetch_assoc();
												if($check_ban['count(*)']!=0){
													continue;
												}
												if($server['status']==1){
													$status='<span class="label label-success">Online</span>';
												}else{
													$status='<span class="label label-important">Offline</span>';
												}
												echo '<tr>
												  <td><a href="#quick_view" onclick="quick_view(\''.$_SESSION['lang'].'\','.$server['id'].')" role="button" data-toggle="modal" > '.$server['name'].'</a></td>
												  <td> '.$status.' </td>
												  <td> <a rel="tooltip" title="'.$_LANG['myservers']['edit'].'" style="padding:0 20px;" href="?page=edit_serv&id='.$server['id'].'"><i class="icon-wrench"></i></a> <a href="#ask_remove" onclick="setremoveid(\''.$server['id'].'\',\''.$server['name'].'\')" role="button" data-toggle="modal" title="'.$_LANG['myservers']['delete'].'" style="padding:0 20px;" href="#" ><i class="icon-remove"></i></a></td>
												</tr>';
											}
										}
									echo '	
                                   </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
				</div>';
				
	echo'
	<div id="quick_view" class="modal container hide fade" tabindex="-1">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="icon-remove"></i></button>
        </div>
        <div class="modal-body">
           <div id="quick_viewtab">
		   
		   </div>
		</div>
    </div>
	
	<div id="ask_remove" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="icon-remove"></i></button>
            <h3>'.$_LANG['myservers']['warning'].'</h3>
        </div>
        <div id="delete_name" class="modal-body">
         
        </div>
        <div id="link" class="modal-footer">
            
        </div>
    </div>
	<script>
		function setremoveid(id,name){
			$("#link").html(\'<a href="?page=myservers&delete=\'+id+\'" class="btn red">'.$_LANG['myservers']['delete'].'!</a>\');
			$("#delete_name").html(\'<p>'.$_LANG['myservers']['delete_ask'].' <b>\'+name+\'</b> ?</p>\');
		}
		</script>
	';
}else{
	header("Location: ?page=list");
	exit;
}
?>

	
