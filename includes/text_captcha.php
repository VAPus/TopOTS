<?php
function RandomText ()
{
	$chars="1234567890";
	$minchars=4;
	$maxchars=6;
	$escapecharplus=0;
	$repeat=mt_rand($minchars,$maxchars);
	$id='';
	while ($escapecharplus<$repeat)
		{
		$id.=$chars[mt_rand(1, strlen($chars)-1)];
		$escapecharplus+=1;
		}
	return $id;
}
?>
