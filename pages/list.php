<?php
include('includes/countries.php');

function DESC_ASC(){
	if($_SESSION['lista']['order2']=="DESC"){
		return "ASC";
	}else{
		return "DESC";
	}
}

// ==== PODZIA£ NA STRONY
if ( isset ( $_GET['start'] ) )
{
	$page = intval ( $_GET['start'] );
}else
{
	$page=1;
}

if(isset($_GET['country'])){
	foreach($countries as $country){
		if($_GET['country']==$country){
			$country_query=" AND `country`=\"".$country."\" ";
			$country_page="&country=".$country;
			break;
		}else{
			$country_query="";
			$country_page="";
		}
	}
}else{
	$country_query="";
	$country_page="";
}
	

$SelectAll = $mysqli -> query ( 'SELECT count(*) FROM `list_ots` WHERE `status` = "1" '.$country_query );
$AllCountArray = $SelectAll->fetch_assoc();
$AllCountInt = $AllCountArray['count(*)'];

$AllPages = intval($AllCountInt/$max_visible);
if( $AllCountInt % $max_visible!=0)
{
        $AllPages++;
}
if($page<1){
	$page=1;
}elseif($page>$AllPages){
	$page=$AllPages;
}

$LimitPage = ($page-1)*$max_visible;

$PagesString = NuLL;

for ( $i = 1; $i <= $AllPages; $i++ )
{
	if($i==$page){
		$PagesString.="<li class=\"active\"><a class=\"btn\" href=\"?page=list&start=".$i.$country_page."\">".$i."</a></li>";
	}else{
		$PagesString.="<li><a class=\"btn\" href=\"?page=list&start=".$i.$country_page."\">".$i."</a></li>";
	}
}
//<a href="#" class="btn">1</a>
// ==== KONIEC PODZIA£U NA STRONY

if ( isset ( $_GET['sort'] ) )
{
	$sort_types=array("name", "ip", "players", "exp", "client", "type", "map", "country");
	reset($sort_types);
	foreach($sort_types as $s_type){
		if($_GET['sort']==$s_type){
			if($_SESSION['lista']['order']==$s_type){
				$_SESSION['lista']['order2']=DESC_ASC();
			}else{
				$_SESSION['lista']['order']=$s_type;
				$_SESSION['lista']['order2']="DESC";
			}
			break;
		}
	}
}

if(!isset ( $_SESSION['lista']['order'] ) or !isset ( $_SESSION['lista']['order2'] ))
{
	$_SESSION['lista']['order']="players";
	$_SESSION['lista']['order2']="DESC";
}


$SearchQuery = $mysqli -> query ( 'SELECT id,name,ip,players,rec,maxplayers,uptime,uptimepc,exp,client,type,map,country,add_time,lastcheck FROM `list_ots` WHERE `status` = "1" '.$country_query. ' ORDER BY `'.$_SESSION['lista']['order'].'` '.$_SESSION['lista']['order2'].' LIMIT ' . $LimitPage. ', 20' );
?> 
<div class="row-fluid">
<div class="span12">
                        <div class="well red">
                            <div class="well-header">
                                <h5><?php echo $_LIST['list']['title'];?></h5>
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
                                <table class="table  table-hover">
                                   <thead>
                                      <tr style="background-color:White;">
									  <?php
										echo '<th><a href="?page=list&sort=name'.$country_page.'"> '.$_LANG['server_info']['name'].' </a></th>
										<th class="hidden-480"><a href="?page=list&sort=ip'.$country_page.'">' .$_LANG['server_info']['IP'].' </a></th>
										<th><a href="?page=list&sort=players'.$country_page.'"> '.$_LANG['server_info']['players'].' </a></th>
										<th class="hidden-480"><a href="?page=list&sort=uptime'.$country_page.'"> '.$_LANG['server_info']['uptime'].' </a></th>
										<th ><a href="?page=list&sort=exp'.$country_page.'"> ' .$_LANG['server_info']['EXP'].' </a></th>
										<th><a href="?page=list&sort=client'.$country_page.'"> '.$_LANG['server_info']['client'].' </a></th>
										<th><a href="?page=list&sort=type'.$country_page.'"> '.$_LANG['server_info']['type'].' </th>
										<th class="hidden-480"><a href="?page=list&sort=map'.$country_page.'"> '.$_LANG['server_view']['map'].' </a></th>
										<th><a href="?page=list&sort=country'.$country_page.'"> '.$_LANG['server_info']['country'].' </a></th>';
										?>
                                      </tr>
                                   </thead>
                                   <tbody>
                                       <?php
										$time_now=time();
									   $fit_q=$mysqli->query('SELECT server FROM `list_promote` 
												WHERE `start`<"'.$time_now.'" AND `end`>"'.$time_now.'" AND `type`="4"');
										if($fit_q->num_rows()>0){
											$fit_q=$fit_q->fetch_assoc();
											$fit_serv_c=$mysqli->query('SELECT id,name,ip,players,rec,maxplayers,uptime,map,exp,client,type,country,add_time,lastcheck 
												FROM `list_ots` WHERE `id`="'.$fit_q['server'].'"');
											if($fit_serv_c->num_rows()>0){
												while($fit_serv=$fit_serv_c->fetch_assoc()){
													$uptime_temp=explode('.',number_format($fit_serv['uptimepc'],2));
													$uptime=$uptime_temp[0];
													if($uptime_temp[1]!="00") $uptime.='.'.$uptime_temp[1];
													if($fit_serv['client']==-1){
														$fit_serv['client']=$_LANG['server_info']['na'];
													}
													echo '<b><tr>
													  <td><a href="?page=view&id='.$fit_serv['id'].'"> '.$fit_serv['name'].'</a></td>
													  <td class="hidden-480"> '.$fit_serv['ip'].' </td>
													  <td> '.$fit_serv['players'].'('.$fit_serv['rec'].') / '.$fit_serv['maxplayers'].' </td>
													  <td class="hidden-480"> '.$uptime.' % </td>
													  <td> '.$fit_serv['exp'].' </td>
													  <td> '.$fit_serv['client'].' </td>
													  <td> '.$fit_serv['type'].' </td>
													  <td class="hidden-480"> '.$fit_serv['map'].' </td>
													  <td><a href="?page=list&country='.$fit_serv['country'].'"> '.$fit_serv['country'].'</a> </td>
													</tr></b>';
												}
												echo '<tr><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr>';
											}
										}
										
										if ( $AllCountInt < 1 )
										{
											echo $_LIST['list']['no_servers'];
										} else {
											while ( $Row = $SearchQuery -> fetch_assoc () )
											{
												$time_now=time();
												$check_ban=$mysqli->query('SELECT count(*) FROM `list_bans` WHERE `server`="'.$Row['id'].'"')->fetch_assoc();
												if($check_ban['count(*)']!=0){
													continue;
												}
												
												$bgcolor='bgcolor=""';
												$check_promote=$mysqli->query('SELECT type FROM `list_promote` 
												WHERE `server`="'.$Row['id'].'" AND `start`<"'.$time_now.'" AND `end`>"'.$time_now.'"');
												if($check_promote->num_rows()>0){
													$check_promote2=$check_promote->fetch_assoc();
													if($check_promote2['type']==2){
														$bgcolor='bgcolor="#FFFF99"';
													}elseif($check_promote2['type']==4){
														continue;
													}
												}
												$uptime_temp=explode('.',number_format($Row['uptimepc'],2));
												$uptime=$uptime_temp[0];
												if($uptime_temp[1]!="00") $uptime.='.'.$uptime_temp[1];
												if($Row['client']==-1){
													$Row['client']=$_LANG['server_info']['na'];
												}
												echo '<tr>
												  <td><a href="?page=view&id='.$Row['id'].'"> '.$Row['name'].'</a></td>
												  <td class="hidden-480"> '.$Row['ip'].' </td>
												  <td> '.$Row['players'].'('.$Row['rec'].') / '.$Row['maxplayers'].' </td>
												  <td class="hidden-480"> '.$uptime.' % </td>
												  <td> '.$Row['exp'].' </td>
												  <td> '.$Row['client'].' </td>
												  <td> '.$Row['type'].' </td>
												  <td class="hidden-480"> '.$Row['map'].' </td>
												  <td><a href="?page=list&country='.$Row['country'].'"> '.$Row['country'].'</a> </td>
												</tr>';
											}
										}
										?>
                                   </tbody>
                                </table>
								<div class="table_options bottom_options">
                                    <div class="pull-right">
                                        <div class="btn-group dataTables_paginate paging_bootstrap pagination">
										<ul>
                                            <?php echo $PagesString; ?>
										</ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
				</div>