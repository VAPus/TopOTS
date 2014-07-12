<?php
function check_img($ID){
	if ($dir = @opendir('server_img')) {
		while($file = readdir($dir)){
			if($file=='.' || $file=='..')
				continue;
			$file_name = explode(".", $file);
			if($file_name[0]==$ID){
				return $file_name[0].'.'.$file_name[1];
			}
		}
		closedir($dir);
	}else{
		return false;
	}
	return false;
}

function check_string($string)
{
	if(preg_match('/^[a-zA-Z0-9№жкісуњџї]+$/', $string)){
		return true;
	}else{
		return false;
	}
}

function check_string2($string)
{
	if(preg_match('/^[a-zA-Z0-9]+$/', $string)){
		return true;
	}else{
		return false;
	}
}

function check_string3($string)
{
	if(preg_match('/^[a-zA-Z0-9 ]+$/', $string)){
		return true;
	}else{
		return false;
	}
}
function check_nr($string)
{
	if(preg_match('/^[0-9]+$/', $string)){
		return true;
	}else{
		return false;
	}
}

function check_mail($string)
{
	if(preg_match('/^[a-zA-Z0-9\.\-\_]+\@[a-zA-Z0-9\.\-\_]+\.[a-z]{2,4}$/D', $string)){
		return true;
	}else{
		return false;
	}
}

function is_admin()
{
	if(isset($_SESSION['account']['admin']) && $_SESSION['account']['admin']==1){
		return true;
	}else{
		return false;
	}
}

function is_logged()
{
	if(isset($_SESSION['account']['status']) && $_SESSION['account']['status']==1){
		return true;
	}else{
		return false;
	}
}
?>