 <?php
 /*
	numers must be given in order (1, 2, 3, 4....)
*/
 $_FEATURED[1]['days']=7;
 $_FEATURED[1]['price']=100;
 $_FEATURED[2]['days']=30;
 $_FEATURED[2]['price']=400;
 
 $_GOLDEN_H[1]['days']=7;
 $_GOLDEN_H[1]['price']=200;
 $_GOLDEN_H[2]['days']=30;
 $_GOLDEN_H[2]['price']=800;
 
 $_COUNTDOWN=10; // countdown cost per 5 mins. (1hour=12*5mins) =====> 1h = (10)*12=120, 24h=(10)*12*24=2880
 $_FIT=20; // first in table cost per 5 mins. (1hour=12*5mins) =====> 1h = (20)*12=240, 24h=(10)*12*24=5760
 
 function calc_points($start,$end, $multiplier){
	$time=($end-$start)/(5*60);
	if($time>0){
		return $time*$multiplier;
	}else{
		return 0;
	}
 }
 
 ?>