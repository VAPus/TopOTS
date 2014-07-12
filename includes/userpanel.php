<?php
if(is_logged()){
	$header_userpanel_string='
	<li class="dropdown hidden-480"><a href="#"> '.$_SESSION['account']['name'].' <i class="icon-angle-down"></i></a>
		<ul>
			<li><a href="?page=add"><i class="icon-plus"></i> '.$_LANG['menu']['account_add'].'</a></li>
			<li><a href="?page=myservers"><i class="icon-tasks"></i> '.$_LANG['menu']['account_servers'].'</a></li>
			<li><a href="?page=favorites"><i class="icon-user"></i> '.$_LANG['menu']['account_favorite'].'</a></li>
			<li><a href="?page=promote"><i class="icon-usd"></i> '.$_LANG['menu']['account_promote'].'</a></li>
			<li><a href="?page=profile"><i class="icon-cog"></i> '.$_LANG['menu']['account_settings'].'</a></li>';
			if(is_admin()){
				$header_userpanel_string.= '<li><a href="?page=admin"><i class="icon-adn"></i> Admin</a></li>';
			}
			$header_userpanel_string.= '
			<li><a href="?page=logout"><i class="icon-signout"></i> '.$_LANG['menu']['account_logout'].'</a></li>		
		</ul>
	</li>';
	$menu_userpanel_string='
		<li><a href="?page=add"><i class="icon-plus"></i> '.$_LANG['menu']['account_add'].'</a></li>
		<li><a href="?page=myservers"><i class="icon-tasks"></i> '.$_LANG['menu']['account_servers'].'</a></li>
		<li><a href="?page=favorites"><i class="icon-heart"></i> '.$_LANG['menu']['account_favorite'].'</a></li>
		<li><a href="?page=promote"><i class="icon-usd"></i> '.$_LANG['menu']['account_promote'].'</a></li>
		<li><a href="?page=profile"><i class="icon-cog"></i> '.$_LANG['menu']['account_settings'].'</a></li>';
			if(is_admin()){
				$menu_userpanel_string.= '<li><a href="?page=admin"><i class="icon-adn"></i> Admin</a></li>';
			}
			$menu_userpanel_string.= '
		<li><a href="?page=logout"><i class="icon-signout "></i> '.$_LANG['menu']['account_logout'].'</a></li>';
}else{
	$header_userpanel_string='
	<li class="dropdown hidden-480"><a href="#"> '.$_LANG['menu']['account_anonymous'].' <i class="icon-angle-down"></i></a>
		<ul>
			<li><a href="?page=login"><i class="icon-signin"></i> '.$_LANG['menu']['account_login'].'</a></li>
			<li><a href="?page=register"><i class="icon-terminal"></i> '.$_LANG['menu']['account_register'].'</a></li>
			<li><a href="?page=recover"><i class="icon-undo"></i> '.$_LANG['menu']['account_recover'].'</a></li>
		</ul>
	</li>';
	$menu_userpanel_string='
		<li><a href="?page=login"><i class="icon-signin"></i> '.$_LANG['menu']['account_login'].'</a></li>
		<li><a href="?page=register"><i class="icon-terminal"></i> '.$_LANG['menu']['account_register'].'</a></li>
		<li><a href="?page=recover"><i class="icon-undo"></i> '.$_LANG['menu']['account_recover'].'</a></li>';
}
?>