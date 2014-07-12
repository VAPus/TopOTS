<?php
if(is_logged()){
if(isset($_GET['delete'])){
	$delid=intval($_GET['delete']);
	
	$check_owner_q=$mysqli->query('SELECT `user` FROM `list_favorites` WHERE `id`="'.$delid.'"');
	if($check_owner_q->num_rows()==1){
		$check_owner=$check_owner_q->fetch_assoc();
		if($check_owner['user']!=$_SESSION['account']['id']){
			header("Location: ?page=list");
			exit;
		}
	}else{
		header("Location: ?page=list");
		exit;
	}
	
	$mysqli->query('DELETE FROM `list_favorites` WHERE `id`="'.$delid.'"');
}
	
	
	
$servers_q = $mysqli -> query ( 'SELECT id,server FROM `list_favorites` WHERE `user` = "'.$_SESSION['account']['id'].'"' );

echo '
<div class="row-fluid">
<div class="span12">
                        <div class="well dark_green">
                            <div class="well-header">
                                <h5>'.$_LANG['favorites']['favorites'].'</h5>
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
												$server_info=$mysqli->query('SELECT id, status, name FROM `list_ots` WHERE `id`="'.$server['server'].'"')->fetch_assoc();
												$check_ban=$mysqli->query('SELECT count(*) FROM `list_bans` where `server`="'.$server_info['id'].'"')->fetch_assoc();
												if($check_ban['count(*)']!=0){
													continue;
												}
												if($server_info['status']==1){
													$status='<span class="label label-success">Online</span>';
												}else{
													$status='<span class="label label-important">Offline</span>';
												}
												echo '<tr>
												  <td><a href="#quick_view" onclick="quick_view(\''.$_SESSION['lang'].'\','.$server_info['id'].')" role="button" data-toggle="modal" > '.$server_info['name'].'</a></td>
												  <td> '.$status.' </td>
												  <td> <a href="#ask_remove" onclick="setremoveid(\''.$server['id'].'\',\''.$server_info['name'].'\')" role="button" data-toggle="modal" title="'.$_LANG['myservers']['delete'].'" style="padding:0 20px;" href="#" ><i class="icon-remove"></i></a></td>
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
            <h3>'.$_LANG['myservers']['warning'].'!</h3>
        </div>
        <div id="delete_name" class="modal-body">
         
        </div>
        <div id="link" class="modal-footer">
            
        </div>
    </div>
	<script>
		function setremoveid(id,name){
			$("#link").html(\'<a href="?page=favorites&delete=\'+id+\'" class="btn red">Delete!</a>\');
			$("#delete_name").html(\'<p>'.$_LANG['myservers']['delete_ask'].' <b>\'+name+\'</b> ?</p>\');
		}
		</script>
	';
}else{
	header("Location: ?page=list");
	exit;
}
?>

	
