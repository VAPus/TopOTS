 <?php
 if(is_logged()){
	$points=$mysqli->query('SELECT points FROM `list_acc` WHERE `id`="'.$_SESSION['account']['id'].'"')->fetch_assoc();
	$points=$points['points'];
	include('includes/promote_config.php');
	
	if(isset($_POST['server'])){
		if(isset($_POST['submit_feat'])){
			$option=$_POST['option'];
			if(isset($_FEATURED[$option])){
				$time=time();
				$time2=$time+($_FEATURED[$option]['days']*24*60*60);
				$new_points=$points-$_FEATURED[$option]['price'];
				if($new_points<0){
						echo $_LANG['promote']['nopoints'];
				}else{
					$points=$new_points;
					$mysqli->query('UPDATE `list_acc` SET `points`="'.$new_points.'" WHERE `id`="'.$_SESSION['account']['id'].'"');
					$mysqli->query('INSERT INTO `list_promote` (`id`, `owner`, `server`, `type`, `start`, `end`, `info`) VALUES (
						NULL, "'.$_SESSION['account']['id'].'", "'.intval($_POST['server']).'", "1", "'.$time.'", "'.$time2.'", "")');		
				}
			}else{
				header("Location: ?page=list");
				exit;
			}
		}elseif(isset($_POST['submit_golden_h'])){
			$option=$_POST['option'];
			if(isset($_GOLDEN_H[$option])){
				$time=time();
				$time2=$time+($_GOLDEN_H[$option]['days']*24*60*60);
				$new_points=$points-$_GOLDEN_H[$option]['price'];
				if($new_points<0){
						echo $_LANG['promote']['nopoints'];
				}else{
					$points=$new_points;
					$mysqli->query('UPDATE `list_acc` SET `points`="'.$new_points.'" WHERE `id`="'.$_SESSION['account']['id'].'"');
					$mysqli->query('INSERT INTO `list_promote` (`id`, `owner`, `server`, `type`, `start`, `end`, `info`) VALUES (
						NULL, "'.$_SESSION['account']['id'].'", "'.intval($_POST['server']).'", "2", "'.$time.'", "'.$time2.'", "")');		
				}
			}else{
				header("Location: ?page=list");
				exit;
			}
		}elseif(isset($_POST['submit_countdown'])){
			$time1=strtotime($_POST['date_start_cd']);
			$time2=strtotime($_POST['date_end_cd']);
			if($time1==0 or $time1==NULL or $time2==0 or $time2==NULL or ($time2-$time1)<=0){
				echo $_LANG['promote']['wrongtime'];
			}else{
				$check_exist=$mysqli->query('SELECT start, end FROM `list_promote` 
				WHERE ((`start`>="'.$time1.'" AND `start`<="'.$time2.'") OR (`end`>="'.$time1.'" AND `end`<="'.$time2.'")) AND `type`="3"');
				if($check_exist->num_rows()>0)
				{
					echo '<p style="padding-top:5px; padding-left:10px;" class="text-error">'.$_LANG['promote']['anotherplanned'].' </p>';
					while($planned=$check_exist->fetch_assoc()){
						echo '<p style="padding-top:5px; padding-left:10px;" class="text-error">'.date('d-m-Y, H:i',$planned['start']).'  -  '.date('d-m-Y, H:i',$planned['end']).'</p>';
					}
				}else{
					$new_points=$points-calc_points($time1,$time2, $_COUNTDOWN);
					if($new_points<0){
						echo $_LANG['promote']['nopoints'];
					}else{
						$points=$new_points;
						$mysqli->query('UPDATE `list_acc` SET `points`="'.$new_points.'" WHERE `id`="'.$_SESSION['account']['id'].'"');
						$mysqli->query('INSERT INTO `list_promote` (`id`, `owner`, `server`, `type`, `start`, `end`, `info`) VALUES (
							NULL, "'.$_SESSION['account']['id'].'", "'.intval($_POST['server']).'", "3", "'.$time1.'", "'.$time2.'", "")');	
					}
				}
			}
		}elseif(isset($_POST['submit_fit'])){
			$time1=strtotime($_POST['date_start_fit']);
			$time2=strtotime($_POST['date_end_fit']);
			if($time1==0 or $time1==NULL or $time2==0 or $time2==NULL or ($time2-$time1)<=0){
				echo $_LANG['promote']['wrongtime'];
			}else{
				$check_exist=$mysqli->query('SELECT start, end FROM `list_promote` 
				WHERE ((`start`>="'.$time1.'" AND `start`<="'.$time2.'") OR (`end`>="'.$time1.'" AND `end`<="'.$time2.'")) AND `type`="4"');
				if($check_exist->num_rows()>=$max_fit)
				{
					echo '<p style="padding-top:5px; padding-left:10px;" class="text-error">'.$_LANG['promote']['anotherplanned'].' </p>';
					while($planned=$check_exist->fetch_assoc()){
						echo '<p style="padding-top:5px; padding-left:10px;" class="text-error">'.date('d-m-Y, H:i',$planned['start']).'  -  '.date('d-m-Y, H:i',$planned['end']).'</p>';
					}
				}else{
					$new_points=$points-calc_points($time1,$time2, $_FIT);
					if($new_points<0){
						echo $_LANG['promote']['nopoints'];
					}else{
						$points=$new_points;
						$mysqli->query('UPDATE `list_acc` SET `points`="'.$new_points.'" WHERE `id`="'.$_SESSION['account']['id'].'"');
						$mysqli->query('INSERT INTO `list_promote` (`id`, `owner`, `server`, `type`, `start`, `end`, `info`) VALUES (
							NULL, "'.$_SESSION['account']['id'].'", "'.intval($_POST['server']).'", "4", "'.$time1.'", "'.$time2.'", "")');	
					}
				}
			}
		}	
	}
	
	$my_promotions_string="";
	$my_promotions_q=$mysqli->query('SELECT server,type,start,end FROM `list_promote` WHERE `owner`="'.$_SESSION['account']['id'].'"');
	if($my_promotions_q->num_rows()>0){
		while($my_promotions_info=$my_promotions_q->fetch_assoc()){
			$server_name=$mysqli->query('SELECT `name` FROM `list_ots` WHERE `id`="'.$my_promotions_info['server'].'"')->fetch_assoc();
			switch($my_promotions_info['type']){
				case 1:$my_promotions_info['type']=$_LANG['promote']['featuredbox'];break;
				case 2:$my_promotions_info['type']=$_LANG['promote']['goldenh'];break;
				case 3:$my_promotions_info['type']=$_LANG['promote']['countdown'];break;
				case 4:$my_promotions_info['type']=$_LANG['promote']['fit'];break;
			}
			$now_time=time();
			if($now_time<$my_promotions_info['end'] and $now_time>$my_promotions_info['start']){
				$style="color: green;";
			}else{
				$style="color: red;";
			}
			
			$my_promotions_string.='
				<tr>
					<td>'.$server_name['name'].'</td>
					<td>'.$my_promotions_info['type'].'</td>
					<td style="'.$style.'">'.date('d-m-Y, H:i',$my_promotions_info['start']).'</td>
					<td style="'.$style.'">'.date('d-m-Y, H:i',$my_promotions_info['end']).'</td>
				</tr>';
		}
	}		
	
	
	$servers_string="";
	
	$servers=$mysqli->query('SELECT id,name,status FROM `list_ots` WHERE `owner`="'.$_SESSION['account']['id'].'"');
	if($servers->num_rows()>0){
		while($server=$servers->fetch_assoc()){
			$servers_string.='<option value="'.$server['id'].'">'.$server['name'].'</option>';
		}
	}
	
	$feature_opt_string="";
	$i=0;
	foreach($_FEATURED as $value){
		$i++;
		$feature_opt_string.='<option value="'.$i.'">'.$value['days'].' '.$_LANG['promote']['daysfor'].' '.$value['price'].' '.$_LANG['promote']['points'].'</option>';
	}
	
	$golden_h_opt_string="";
	$i=0;
	foreach($_GOLDEN_H as $value){
		$i++;
		$golden_h_opt_string.='<option value="'.$i.'">'.$value['days'].' '.$_LANG['promote']['daysfor'].' '.$value['price'].' '.$_LANG['promote']['points'].'</option>';
	}
	
		
	echo'<div class="status-widgets">
			<div class="row-fluid">
				<div class="span12">
					 <div class="widget yellow clearfix">
						<div class="details">
							<div class="number">
								'.$points.'
							</div>
							<div class="description">
								'.$_LANG['promote']['points'].'
							</div>
						</div>
						<a href="?page=buypoints" class="more"><i class="icon-arrow-right"></i></a>
					</div>
				</div>
			</div>
			</div>
			
	<div class="row-fluid">
		<div class="span12">
			<div class="well red">
				<div class="well-header">
					<h5>'.$_LANG['promote']['mypromote'].'</h5>
					<ul>
					<li class="collapse_well"><a href="#"><i class="icon-plus"></i></a></li>
					</ul>
				</div>
				<div class="well-content clearfix" style="display:none;">
					 <table class="table table-striped table-hover">
					   <thead>
						  <tr>
							  <th>'.$_LANG['promote']['server'].'</th>
							  <th>'.$_LANG['promote']['type'].'</th>
							  <th>'.$_LANG['promote']['start'].'</th>									
							  <th>'.$_LANG['promote']['end'].'</th>									
						  </tr>
					   </thead>
					   <tbody>
							'.$my_promotions_string.'
					   </tbody>
					  </table>
				</div>
			</div> 
		</div>
	</div>
		
	<div class="row-fluid">
		<div class="span12">
			<div class="well blue">
				<div class="well-header">
					<h5>'.$_LANG['promote']['featuredbox'].'</h5>
					<ul>
					<li class="collapse_well"><a href="#"><i class="icon-plus"></i></a></li>
					</ul>
				</div>
				<div class="well-content clearfix" style="display:none;">
					<form action="?page=promote" method="POST">
						<div class="form_row">
							<label class="field_name align_right">'.$_LANG['promote']['server'].'</label>
							<div class="field">													 
								<select name="server" class="chosen">
									'.$servers_string.'
								</select>
							</div>
						</div>
						<div class="form_row">
							<label class="field_name align_right">'.$_LANG['promote']['option'].'</label>
							<div class="field">	
								<select name="option" class="chosen">
									'.$feature_opt_string.'
								</select>
							</div>
						</div>
						<div class="form_row">
							<div class="field">
								<button name="submit_feat" type="submit" class="btn btn-large blue">OK!<i class="icon-arrow-right"></i></button>
							</div>
						</div>
					</form>
				</div>
			</div> 
		</div>
	</div>
	
	<div class="row-fluid">
		<div class="span12">
			<div class="well blue">
				<div class="well-header">
					<h5>'.$_LANG['promote']['goldenh'].'</h5>
					<ul>
					<li class="collapse_well"><a href="#"><i class="icon-plus"></i></a></li>
					</ul>
				</div>
				<div class="well-content clearfix" style="display:none;">
					<form action="?page=promote" method="POST">
						<div class="form_row">
							<label class="field_name align_right">'.$_LANG['promote']['server'].'</label>
							<div class="field">													 
								<select name="server" class="chosen">
									'.$servers_string.'
								</select>
							</div>
						</div>
						<div class="form_row">
							<label class="field_name align_right">'.$_LANG['promote']['option'].'</label>
							<div class="field">	
								<select name="option" class="chosen">
									'.$golden_h_opt_string.'
								</select>
							</div>
						</div>
						<div class="form_row">
							<div class="field">
								<button name="submit_golden_h" type="submit" class="btn btn-large blue">OK!<i class="icon-arrow-right"></i></button>
							</div>
						</div>
					</form>
				</div>
			</div> 
		</div>
	</div>';
	
	if($countdown_enable==1){
		echo '
		<div class="row-fluid">
			<div class="span12">
				<div class="well blue">
					<div class="well-header">
						<h5>'.$_LANG['promote']['countdown'].'</h5>
						<ul>
						<li class="collapse_well"><a href="#"><i class="icon-plus"></i></a></li>
						</ul>
					</div>
					<div class="well-content clearfix" style="display:none;">
							<span id="cd_calc_result">0</span>
						<span> '.$_LANG['promote']['points'].'</span>
						<form action="?page=promote" method="POST">
						<div class="form_row">
							<label class="field_name align_right">'.$_LANG['promote']['server'].'</label>
							<div class="field">													 
								<select name="server" class="chosen">
									'.$servers_string.'
								</select>
							</div>
						</div>
						<div class="form_row">
							<label class="field_name align_right">'.$_LANG['promote']['ctime'].'</label>
							<div class="field">
								'.date('d-m-Y, H:i').'
							</div>
						</div>
						<div class="form_row">
							<label class="field_name align_right">'.$_LANG['promote']['start'].'</label>
							<div class="field">
								<input size="16" name="date_start_cd" type="text" readonly class="span6 form_datetime">
							</div>
						</div>
						<div class="form_row">
							<label class="field_name align_right">'.$_LANG['promote']['end'].'</label>
							<div class="field">
								<input size="16" name="date_end_cd" type="text" readonly class="span6 form_datetime">
							</div>
						</div>
						<div class="form_row">
							<div class="field">
								<button name="submit_countdown" type="submit" class="btn btn-large blue">OK!<i class="icon-arrow-right"></i></button>							
								<a type="button" onclick="calc_points(\'cd\')" class="btn btn-large blue">'.$_LANG['promote']['calc'].' <i class="icon-arrow-right"></i></a>
							</div>
						</div>
					</form>
					</div>
				</div> 
			</div>
		</div>';
	}
	
	if($first_in_table==1){
		echo '
		<div class="row-fluid">
			<div class="span12">
				<div class="well blue">
					<div class="well-header">
						<h5>'.$_LANG['promote']['fit'].'</h5>
						<ul>
						<li class="collapse_well"><a href="#"><i class="icon-plus"></i></a></li>
						</ul>
					</div>
					<div class="well-content clearfix" style="display:none;">
							<span id="fit_calc_result">0</span>
						<span> '.$_LANG['promote']['points'].'</span>
						<form action="?page=promote" method="POST">
						<div class="form_row">
							<label class="field_name align_right">'.$_LANG['promote']['server'].'</label>
							<div class="field">													 
								<select name="server" class="chosen">
									'.$servers_string.'
								</select>
							</div>
						</div>
						<div class="form_row">
							<label class="field_name align_right">'.$_LANG['promote']['ctime'].'</label>
							<div class="field">
								'.date('d-m-Y, H:i').'
							</div>
						</div>
						<div class="form_row">
							<label class="field_name align_right">'.$_LANG['promote']['start'].'</label>
							<div class="field">
								<input size="16" name="date_start_fit" type="text" readonly class="span6 form_datetime">
							</div>
						</div>
						<div class="form_row">
							<label class="field_name align_right">'.$_LANG['promote']['end'].'</label>
							<div class="field">
								<input size="16" name="date_end_fit" type="text" readonly class="span6 form_datetime">
							</div>
						</div>
						<div class="form_row">
							<div class="field">
								<button name="submit_fit" type="submit" class="btn btn-large blue">OK!<i class="icon-arrow-right"></i></button>							
								<a type="button" onclick="calc_points(\'fit\')" class="btn btn-large blue">'.$_LANG['promote']['calc'].' <i class="icon-arrow-right"></i></a>
							</div>
						</div>
					</form>
					</div>
				</div> 
			</div>
		</div>';
}
	
}else{
	header("Location: ?page=list");
	exit;
}
?>
