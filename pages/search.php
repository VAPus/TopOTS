<?php
include('includes/type.php');
include('includes/countries.php');
include('includes/maps.php');
include('includes/clients.php');

$type_string=NULL;
$country_string=NULL;
$exptype_string=NULL;
$map_string=NULL;
$client_string=NULL;

foreach($type as $value){
	$type_string.='<option>'.$value.'</option>';
}

foreach($countries as $value){
	$country_string.='<option>'.$value.'</option>';
}

foreach($maps as $value){
	$map_string.='<option>'.$value.'</option>';
}

foreach($Clients as $value){
	if($value=='-1'){
		$client_string.='<option>'. $_LANG['server_info']['na'].'</option>';
	}else{
		$client_string.='<option>'.$value.'</option>';
	}
}

$exptype_string.='<option>'.$_LANG['server_info']['stages'].'</option>';
$exptype_string.='<option>'.$_LANG['server_info']['const'].'</option>';

?>
<div class="tab-pane no_padding" id="user_search">
	<div class="row-fluid">
		<div class="span12">
			<div class="well blue">
				<div class="well-header">
					<h5><?php echo $_LANG['search']['s_options']; ?></h5>
					<ul>
					<li id="search_options_header" class="collapse_well"><a href="#"><i class="icon-minus"></i></a></li>
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
				<div id="search_options" class="well-content clearfix">
					<form>
						<div class="form_row">
							<label class="field_name"><?php echo $_LANG['server_info']['name']; ?></label>
							<div class="switch" rel="tooltip" <?php echo 'title="'.$_LANG['search']['enable_disable'].'"'; ?> data-animated="false"  data-on-label="<i class='icon-ok icon-white'></i>" data-off-label="<i class='icon-remove'></i>">
								<input name="name_mode" type="checkbox">
							</div>	
							   <input name="name" type="text" class="span4" placeholder="<?php echo $_LANG['server_info']['name']; ?>...">
						</div>
						<div class="form_row">
							<label class="field_name"><?php echo $_LANG['server_info']['status']; ?></label>
							<div class="filed">
								<div class="switch" rel="tooltip" <?php echo 'title="'.$_LANG['search']['enable_disable'].'"'; ?> data-animated="false"  data-on-label="<i class='icon-ok icon-white'></i>" data-off-label="<i class='icon-remove'></i>">
									<input name="status_mode" type="checkbox">
								</div>
								<div class="switch"data-animated="false" data-on-label="Online" data-on="success" data-off="danger" data-off-label="Offline">
									<input name="status" type="checkbox" checked>
								</div>
							</div>
						</div>
						<div class="form_row">
							<label class="field_name"><?php echo $_LANG['server_info']['type']; ?></label>
							<div class="filed">
								<div class="switch" rel="tooltip" <?php echo 'title="'.$_LANG['search']['enable_disable'].'"'; ?> data-animated="false"  data-on-label="<i class='icon-ok icon-white'></i>" data-off-label="<i class='icon-remove'></i>">
									<input name="type_mode" type="checkbox">
								</div>														 
								<select name="type" class="chosen">
									<?php echo $type_string; ?>
								</select>                                      
							</div>
						</div>
						<div class="form_row">
							<label class="field_name"><?php echo $_LANG['server_info']['country']; ?></label>
							<div class="filed">
								<div class="switch" rel="tooltip" <?php echo 'title="'.$_LANG['search']['enable_disable'].'"'; ?> data-animated="false"  data-on-label="<i class='icon-ok icon-white'></i>" data-off-label="<i class='icon-remove'></i>">
									<input name="country_mode" type="checkbox">
								</div>														 
								<select name="country" class="chosen">
									<?php echo $country_string; ?>
								</select>                                      
							</div>
						</div>
						<div class="form_row">
							<label class="field_name"><?php echo $_LANG['server_view']['exp_type']; ?></label>
							<div class="filed">
								<div class="switch" rel="tooltip" <?php echo 'title="'.$_LANG['search']['enable_disable'].'"'; ?> data-animated="false"  data-on-label="<i class='icon-ok icon-white'></i>" data-off-label="<i class='icon-remove'></i>">
									<input name="exptype_mode" type="checkbox">
								</div>														 
								<select name="exptype"class="chosen">
									<?php echo $exptype_string; ?>
								</select>                                      
							</div>
						</div>
						<div class="form_row">
							<label class="field_name"><?php echo $_LANG['server_view']['map']; ?></label>
							<div class="filed">
								<div class="switch" rel="tooltip" <?php echo 'title="'.$_LANG['search']['enable_disable'].'"'; ?> data-animated="false"  data-on-label="<i class='icon-ok icon-white'></i>" data-off-label="<i class='icon-remove'></i>">
									<input name="map_mode" type="checkbox">
								</div>														 
								<select name="map" class="chosen">
									<?php echo $map_string; ?>
								</select>                                      
							</div>
						</div>
						<div class="form_row">
							<label class="field_name"><?php echo $_LANG['server_info']['client']; ?></label>
							<div class="filed">
								<div class="switch" rel="tooltip" <?php echo 'title="'.$_LANG['search']['enable_disable'].'"'; ?> data-animated="false"  data-on-label="<i class='icon-ok icon-white'></i>" data-off-label="<i class='icon-remove'></i>">
									<input name="client_mode" type="checkbox">
								</div>														 
								<select name="client" class="chosen">
									<?php echo $client_string; ?>
								</select>                                      
							</div>
						</div>
						<div class="form_row">
							<label class="field_name">Exp</label>
							<div class="filed">
								<div class="switch" rel="tooltip" <?php echo 'title="'.$_LANG['search']['enable_disable'].'"'; ?> data-animated="false"  data-on-label="<i class='icon-ok icon-white'></i>" data-off-label="<i class='icon-remove'></i>">
									<input name="exp_mode" type="checkbox">
								</div>
								<div class="switch" rel="tooltip" <?php echo 'title="'.$_LANG['search']['more_less'].'"'; ?> data-on="info" data-off="info" data-animated="false"  data-on-label="<i class='icon-chevron-right icon-red'></i>" data-off-label="<i class='icon-chevron-left'></i>">
									<input name="exp1" type="checkbox">
								</div>
									<input name="exp2" type="text" class="input-small" name="small" placeholder="100">
							</div>
						</div>
						<div class="form_row">
							<label class="field_name"><?php echo $_LANG['server_info']['players']; ?></label>
							<div class="filed">
								<div class="switch" rel="tooltip" <?php echo 'title="'.$_LANG['search']['enable_disable'].'"'; ?> data-animated="false"  data-on-label="<i class='icon-ok icon-white'></i>" data-off-label="<i class='icon-remove'></i>">
									<input name="players_mode" type="checkbox">
								</div>
								<div class="switch" rel="tooltip" <?php echo 'title="'.$_LANG['search']['more_less'].'"'; ?> data-on="info" data-off="info" data-animated="false"  data-on-label="<i class='icon-chevron-right icon-red'></i>" data-off-label="<i class='icon-chevron-left'></i>">
									<input name="players1" type="checkbox">
								</div>
									<input name="players2" type="text" class="input-small" name="small" placeholder="100">
							</div>
						</div>
						<div class="form_row">
							<label class="field_name"><?php echo $_LANG['server_info']['uptime']; ?></label>
							<div class="filed">
								<div class="switch" rel="tooltip" <?php echo 'title="'.$_LANG['search']['enable_disable'].'"'; ?> data-animated="false"  data-on-label="<i class='icon-ok icon-white'></i>" data-off-label="<i class='icon-remove'></i>">
									<input name="uptime_mode" type="checkbox">
								</div>
								<div class="switch" rel="tooltip" <?php echo 'title="'.$_LANG['search']['more_less'].'"'; ?> data-on="info" data-off="info" data-animated="false"  data-on-label="<i class='icon-chevron-right icon-red'></i>" data-off-label="<i class='icon-chevron-left'></i>">
									<input name="uptime1" type="checkbox">
								</div>
									<input name="uptime2" type="text" class="input-small" name="small" placeholder="100"> %
							</div>
						</div>
						
						<div class="form_row element_row">
							<div class="row-fluid">
								<div class="span2">
									<input type="button" name="submit" class="btn blue btn-block" value="<?php echo $_LANG['button']['submit']; ?>" onclick="search_post('<?php echo $_SESSION['lang']; ?>')"></input>
								</div>
							</div>
						</div>
					</form>
				</div>
			</div> 
		</div>
	</div>

	<div class="tab-pane no_padding">
	   <div class="row-fluid">
			<div class="span12">
				<div id="search_result">
				
			   </div>
			</div>
		</div>
	</div>
</div>

<script>
function search_post(lang){
		status_mode=$("[name=status_mode]")[0].checked;
		type_mode=$("[name=type_mode]")[0].checked;
		country_mode=$("[name=country_mode]")[0].checked;
		exptype_mode=$("[name=exptype_mode]")[0].checked;
		map_mode=$("[name=map_mode]")[0].checked;
		client_mode=$("[name=client_mode]")[0].checked;
		exp_mode=$("[name=exp_mode]")[0].checked;
		players_mode=$("[name=players_mode]")[0].checked;
		uptime_mode=$("[name=uptime_mode]")[0].checked;
		exp2=$("[name=exp2]").val();
		players2=$("[name=players2]").val();
		uptime2=$("[name=uptime2]").val();
		name=$("[name=name]").val();
		exp1=$("[name=exp1]")[0].checked;
		players1=$("[name=players1]")[0].checked;
		uptime1=$("[name=uptime1]")[0].checked;
		type=$("[name=type]").val();
		country=$("[name=country]").val();
		exptype=$("[name=exptype]").val();
		map=$("[name=map]").val();
		client=$("[name=client]").val();
		status=$("[name=status]")[0].checked;
		name_mode=$("[name=name_mode]")[0].checked;
		submit=$("[name=submit]").val();
	
	$("#search_options").slideUp();
    $("#search_options_header").find('i').removeClass('icon-minus').addClass('icon-plus')
	window.scrollTo(0,0);
	$("#search_result").html('<div class="preloader_tab"><img src="img/preloader.gif"></div>');
	
    $.post("pages/search_result.php?lang="+lang,{submit:submit,status_mode:status_mode,name_mode:name_mode,status:status,client:client,map:map,exptype:exptype,country:country,type:type,uptime1:uptime1,players1:players1,exp1:exp1,name:name,uptime2:uptime2,players2:players2,exp2:exp2,uptime_mode:uptime_mode,players_mode:players_mode,exp_mode:exp_mode,client_mode:client_mode,map_mode:map_mode,country_mode:country_mode,type_mode:type_mode,country_mode:country_mode,exptype_mode:exptype_mode},function(result){
      $("#search_result").html(result);
    });
}
</script>