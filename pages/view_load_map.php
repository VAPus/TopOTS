<?php
include('../mysql_config.php');
include('../config.php');
if(isset($_GET['id']) and $add_image_enable==1){
	$ID=intval($_GET['id']);
	$serv_info=$mysqli->query('SELECT count(*) FROM `list_ots` WHERE `id`="'.$ID.'"')->fetch_assoc();
	if($serv_info['count(*)']==1){
		$img=NULL;
		$i_pliki=0;
		if ($dir = @opendir('../server_img')) {
			while($file = readdir($dir)){
				if($file=='.' || $file=='..')
					continue;
				$file_name = explode(".", $file);
				if($file_name[0]==$ID){
					$img.='<img src="server_img/'.$file.'">';
					$i_pliki++;
				}
			}
			closedir($dir);
			if($i_pliki==0){
				$img='<img src="server_img/no-image.png">';
			}
		}else{
			$img='<img src="server_img/no-image.png">';
		}
		echo '<div class="map_img">'.$img.'</div>';
	}
}
?>