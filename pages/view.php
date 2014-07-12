<?php
if(isset($_GET['postlang'])){
	include('../mysql_config.php');
	include('../config.php');
	include('../includes/functions.php');
	include('view_quick_buttons.php');
	include('view_comments.php');
	$lang = addslashes ( $_GET['postlang'] );
	if ( is_file ( '../lang/' .$lang. '.php' ) )
	{
		include '../lang/'.$lang.'.php';
		$_SESSION['lang']=$lang;
	}else{
		include '../lang/'.$default_lang.'.php';
		$_SESSION['lang']=$default_lang;
	}
}
$class['fav']="";
$SearchQuery = $mysqli -> query ( 'SELECT * FROM `list_ots` WHERE `id` = "' .intval ( $_GET['id'] ). '"' );

if ( $SearchQuery -> num_rows == 1)
{
	$ID = intval ( $_GET['id'] );
	if(!isset($_GET['postlang'])){
		include('pages/view_quick_buttons.php');
		include('pages/view_comments.php');
	}
	
	$vote_good = $mysqli -> query ( 'SELECT count(*) FROM `list_votes` WHERE `server`="'.$ID.'" AND `vote`="1"')->fetch_assoc();	
	$vote_bad = $mysqli -> query ( 'SELECT count(*) FROM `list_votes` WHERE `server`="'.$ID.'" AND `vote`="2"')->fetch_assoc();

	$Row = $SearchQuery -> fetch_assoc();	
	$check_ban=$mysqli->query('SELECT count(*) FROM `list_bans` where `server`="'.$Row['id'].'"')->fetch_assoc();
	if($check_ban['count(*)']!=0){
		header("Location: ?page=list");
		exit;
	}
	
	if ( $Row['status'] == 1)
	{
		$ColorStatus = 'dark_green';
		$Status = 'Online';
		$PlayersCount = $Row['players']. ' (' .$Row['rec']. ') / ' .$Row['maxplayers'];
	}else{
		$ColorStatus = 'red';
		$Status = 'Offline';
		$PlayersCount = '0 (' .$Row['rec']. ') / ' .$Row['maxplayers'];
	}

	$desc=str_replace("\n","</br>",$Row['desc']);

	if($Row['client']==-1){
		$Row['client']=$_LANG['server_info']['na'];
	}
	$uptime_temp=explode('.',number_format($Row['uptimepc'],2));
	$uptime=$uptime_temp[0];
	if($uptime_temp[1]!="00") $uptime.='.'.$uptime_temp[1];
	
echo '
<div class="status-widgets">
	<div class="row-fluid">
		<div class="span4">
			<div class="widget yellow clearfix">
				<div class="details">
					<div class="number">
						<p>'.$Row['ip'].'</p>
					</div>
					<div class="description">
						IP
					</div>
				</div>
			</div>
		</div>

		<div class="span4">
			<div class="widget orange clearfix">
				<div class="details">
					<div class="number">
						'.$Row['port'].'
					</div>
					<div class="description">
						PORT
					</div>
				</div>
			</div>
		</div>

		<div class="span4">
			<div class="widget dark_turq clearfix">
				<div class="details">
					<div class="number">
						'.$Row['client'].'
					</div>
					<div class="description">
						'.$_LANG['server_info']['client'].'
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="row-fluid">
		<div class="span4">
			<div class="widget blue clearfix">
				<div class="details">
					<div class="number">
						'.$PlayersCount.'
					</div>
					<div class="description">
						'.$_LANG['server_info']['players'].'
					</div>
				</div>
			</div>
		</div>

		<div class="span4">
			<div class="widget grey clearfix">
				<div class="details">
					<div class="number">
						'.$uptime.' %
					</div>
					<div class="description">
						'.$_LANG['server_info']['uptime'].'
					</div>
				</div>
			</div>
		</div>

		<div class="span4">
			<div class="widget '.$ColorStatus.' clearfix">
				<div class="details">
					<div class="number">
						'.$Status.'
					</div>
					<div class="description">
						Status
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="quick-actions">
	<ul>
		<li><a class="btn green"> '.$vote_good['count(*)'].'</a></li>
		<li><a class="btn red" >'.$vote_bad['count(*)'].'</a></li>';
		if(is_logged()){
			echo'
			<li><a class="'.$class['vote_good'].'" rel="tooltip" data-placement="bottom" title="'.$_LANG['server_view']['good'].'" href="?page=view&id='.$Row['id'].'&action=vote_good"><i class="icon-plus"></i></a></li>
			<li><a class="'.$class['vote_bad'].'" rel="tooltip" data-placement="bottom" title="'.$_LANG['server_view']['bad'].'" href="?page=view&id='.$Row['id'].'&action=vote_bad"><i class="icon-minus"></i></a></li>
			<li><a class="'.$class['fav'].'" rel="tooltip" data-placement="bottom" title="'.$_LANG['server_view']['fav'].'" href="?page=view&id='.$Row['id'].'&action=fav"><i class="icon-heart"></i></a></li>';
		}else{
			echo'
			<li><a rel="tooltip" data-placement="bottom" title="'.$_LANG['account']['for_users'].'" href="#"><i class="icon-plus"></i></a></li>
			<li><a rel="tooltip" data-placement="bottom" title="'.$_LANG['account']['for_users'].'" href="#"><i class="icon-minus"></i></a></li>
			<li><a rel="tooltip" data-placement="bottom" title="'.$_LANG['account']['for_users'].'" href="#"><i class="icon-heart"></i></a></li>';
		}
	echo' </ul>
</div>
			
<div class="row-fluid">
 <div class="well blue">
	<div class="well-header">
		<h5>'.$Row['name'].'</h5>
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

	<div class="well-content no_padding">
		<div class="navbar-inner">
			<ul class="nav nav-tabs">
			  <li class="active"><a href="#tab_desc" data-toggle="tab">'.$_LANG['server_view']['desc'].'</a></li>
			  <li><a onclick="load_motd('.$Row['id'].')" href="#tab_motd" data-toggle="tab">MOTD</a></li>';
			  if( $add_image_enable==1){
					echo '<li><a onclick="load_map('.$Row['id'].')" href="#tab_map" data-toggle="tab">'.$_LANG['server_view']['map'].'</a></li>';
				}
			  echo '<li><a onclick="load_more_info('.$Row['id'].', \''.$_SESSION['lang'].'\')" href="#tab_info" data-toggle="tab">'.$_LANG['server_view']['info'].'</a></li>';
			  if( $comments_enable==1 and $Row['comments']==1){
					echo '<li><a onclick="load_comments('.$Row['id'].')" href="#tab_comments" data-toggle="tab">'.$_LANG['server_view']['comments'].'</a></li>';
				}
			echo '</ul>
		</div>
		<div class="tab-content">
		  <div class="tab-pane active" id="tab_desc">
				<p>'.$desc.'</p>
		  </div>
		  <div class="tab-pane" id="tab_motd">
				<div id="motd">
						<img src="img/preloader.gif">
				</div>
		  </div>';
		  
		  if( $add_image_enable==1){
			echo '<div class="tab-pane no_padding" id="tab_map">
					<div id="map">
						<img src="img/preloader.gif">
					</div>
					</div>';
		  }
		  echo '<div class="tab-pane no_padding" id="tab_info">
				<div id="more_info">
					<img src="img/preloader.gif">
				</div>
		  </div>';	
			if( $comments_enable==1 and $Row['comments']==1){
				echo '<div class="tab-pane no_padding" id="tab_comments">
						<div class="well-content no_padding">
							<div id="comments">
								<img src="img/preloader.gif">
							</div>
							<div class="type_message">';
								if(is_logged()){
									echo '<form method="POST" action="?page=view&id='.$ID.'">
											<input maxlength="200" type="text" class="span12" name="message" placeholder="'.$_LANG['server_view']['type_here'].'">
											<button type="submit" name="submit" class="btn input_button orange"><i class="icon-arrow-right"></i></button>
											</form>';
								}else{
									echo '<input maxlength="200" type="text" class="span12" id="message" name="message" placeholder="'.$_LANG['server_view']['type_here'].'">
											<button rel="tooltip" title="'.$_LANG['account']['for_users'].'" type="submit" class="btn input_button orange"><i class="icon-arrow-right"></i></button>';
								}										
							echo '</div>
						</div>				
					</div>';
			  }		  
		echo '</div>
	</div>
</div>
</div>';
}else{
	header("Location: ?page=list");
	exit;
}
?>