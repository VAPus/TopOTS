<?php 
ob_start();
session_start();
if(!isset($_SESSION['account']['status'])){
	$_SESSION['account']['status']=0;
	$_SESSION['account']['id']=-1;
	$_SESSION['account']['name']="";
	$_SESSION['account']['admin']=0;
}
/*$_SESSION['account']['status']=0;
$_SESSION['account']['id']=5;
$_SESSION['account']['name']="log";*/
include_once('mysql_config.php');
include_once('config.php');
date_default_timezone_set("Australia/Sydney");

if ( isset ( $_GET['lang'] ) )
{
	$lang = addslashes ( $_GET['lang'] );
	if ( is_file ( 'lang/' .$lang. '.php' ) )
	{
		$_SESSION['lang']=$lang;
	}
}
if(!isset($_SESSION['lang'])){
	$_SESSION['lang']=$default_lang;
}
include 'lang/'.$_SESSION['lang'].'.php';

include('includes/functions.php');
include_once('includes/captcha.php');

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <title><?php echo $web_title; ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="An Open-Tibia List">
    <meta name="author" content="">
    <!-- Le styles -->
    <link href="css/bootstrap.css" rel="stylesheet">
    <link href="css/bootstrap-responsive.css" rel="stylesheet">
    <link href="css/stylesheet.css" rel="stylesheet">
    <link href="icon/font-awesome.css" rel="stylesheet">
    <link href=\'http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700,800\' rel=\'stylesheet\' type=\'text/css\'>
    <meta name="keywords" content="tibia,private,server,list,tfs,emulator,map,custom,rl,rlmap,high,low,exp,evo,old,school,ot,ots" >
    <!-- Le fav and touch icons -->
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="img/apple-touch-icon-144-precomposed.html">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="img/apple-touch-icon-114-precomposed.html">
      <link rel="apple-touch-icon-precomposed" sizes="72x72" href="img/apple-touch-icon-72-precomposed.html">
                    <link rel="apple-touch-icon-precomposed" href="img/apple-touch-icon-57-precomposed.html">
                                   <link rel="shortcut icon" href="img/favicon.png">

    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="js/html5shiv.js"></script>
    <![endif]-->
	<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
  </head>

  <body>
	<div id="loader"><img src="img/preloader.gif"></div>
<?php
include('pages/last_5.php');
include('includes/userpanel.php');
include('includes/mailer.php');

$SearchQuery = $mysqli -> query ( 'SELECT SUM(`players`) AS players, count(*) AS online FROM `list_ots` WHERE `status`="1"' );
$count_data=$SearchQuery->fetch_assoc();

$SelectAll = $mysqli -> query ( 'SELECT count(*) FROM `list_ots`');
$AllCountArray = $SelectAll->fetch_assoc();
$count_all = $AllCountArray['count(*)'];

echo'
    <header class="'.$default_header_color.'"> 
      <a href="?page=list" class="logo_image hidden-480"><span class="hidden-480">'.$web_title.'</span></a>
        <ul class="header_actions pull-left hidden-480 hidden-768">
            <li rel="tooltip" data-placement="bottom" title="'.$_LANG['menu']['toggle_menu'].'" ><a href="#" class="hide_navigation"><i class="icon-chevron-left"></i></a></li>
            <li rel="tooltip" data-placement="right" title="'.$_LANG['menu']['color_menu'].'" class="color_pick navigation_color_pick"><a class="iconic" href="#"><i class="icon-th"></i></a>
                <ul>
                    <li><a class="blue" href="#"></a></li>
                    <li><a class="light_blue" href="#"></a></li>
                    <li><a class="grey" href="#"></a></li>
                    <li><a class="dark_grey" href="#"></a></li>
                    <li><a class="pink" href="#"></a></li>
                    <li><a class="red" href="#"></a></li>
                    <li><a class="orange" href="#"></a></li>
                    <li><a class="yellow" href="#"></a></li>
                    <li><a class="green" href="#"></a></li>
                    <li><a class="dark_green" href="#"></a></li>
                    <li><a class="turq" href="#"></a></li>
                    <li><a class="dark_turq" href="#"></a></li>
                    <li><a class="purple" href="#"></a></li>
                    <li><a class="violet" href="#"></a></li>
                    <li><a class="dark_blue" href="#"></a></li>
                    <li><a class="dark_red" href="#"></a></li>
                    <li><a class="brown" href="#"></a></li>
                    <li><a class="black" href="#"></a></li>
                    <a class="dark_navigation" href="#">'.$_LANG['menu']['dark_nav'].'</a>
                </ul>
            </li>
        </ul>
        <ul class="header_actions">
		<li><a href="#"><i class="icon-flag-alt"></i> <span>'.$_LANG['menu']['language'].'</span></a>
                <ul>';
				foreach($languages as $lang_key){
					echo  '<li><a href="?lang='.$lang_key['file'].'">'.$lang_key['name'].'</a></li>';
				}
                echo '</ul>
            </li>
            <li rel="tooltip" data-placement="left" title="'.$_LANG['menu']['color_header'].'" class="color_pick header_color_pick hidden-480"><a class="iconic" href="#"><i class="icon-th"></i></a>
                <ul>
                    <li><a class="blue set_color" href="#"></a></li>
                    <li><a class="light_blue set_color" href="#"></a></li>
                    <li><a class="grey set_color" href="#"></a></li>
                    <li><a class="dark_grey set_color" href="#"></a></li>
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
            <li rel="tooltip" data-placement="bottom" title="'.$_LANG['menu']['new_serv'].'" class="messages"><a class="iconic" href="#"><i class="icon-star-empty"></i></a>
                <ul class="dropdown-menu pull-right messages_dropdown">
						'.$last_5.';
                </ul>
            </li>
				'.$header_userpanel_string.'
            <li class="responsive_menu"><a class="iconic" href="#"><i class="icon-reorder"></i></a></li>
        </ul>
    </header>

    <div id="main_navigation" > <!-- Main navigation start -->
        <div class="inner_navigation">
            <ul class="main">
			<div class="search">
                <input name="quick_search_input" type="text" data-provide="typeahead" name="search" class="typehead span8" placeholder="'.$_LANG['menu']['search'].'...">
                <a href="#quick_search" onclick="quick_search_post(\''.$_SESSION['lang'].'\')" role="button" data-toggle="modal" class="square-button color-green"><i class="icon-screenshot pull-left"></i></a>
            </div>
			<li><a href="index.php?page=search"><i class="icon-search"></i>'.$_LANG['menu']['adv_search'].'</a></li>
                <li><a href="index.php?page=list"><i class="icon-reorder"></i>'.$_LANG['menu']['ots_list'].'</a></li>
                <li><a href="#"><i class="icon-user"></i> '.$_LANG['menu']['account'].'</a>
                    <ul class="sub_main">
                        '.$menu_userpanel_string.'
                    </ul>
                </li>
				
				<li><a id="current" href="index.php?page=faq"><i class="icon-book"></i>'.$_LANG['menu']['faq'].'</a></li>
				<li><a id="current" href="index.php?page=contact"><i class="icon-file-text-alt"></i>'.$_LANG['menu']['contact'].'</a></li>
          
            </ul>
        </div>
    </div>  

    <div id="content" class="sidebar"> <!-- Content start -->      
		<!-- tytul -->
        <div class="inner_content">
            <div class="statistic clearfix">
                <div class=" pull-left">
                    <span id="countdown"> &nbsp;';
					if($countdown_enable==1){
						include('pages/countdown.php');
					}
					echo '</span>
                </div>
            </div>
		<!-- tytul-komiec-->  ';
			if ( isset ( $_GET['page'] ) )
			{
				$Page = addslashes ( $_GET['page'] );
			} else {
				$Page = 'list';					
			}
			if ( is_file ( 'pages/' .$Page. '.php' ) )
			{
				include ( 'pages/' .$Page. '.php');
			} else {
				include ( 'pages/list.php' );					
			}
			
        echo '</div>
		
    </div>

    <div id="sidebar"> <!-- Sidebar start -->
        <div class="inner_sidebar">
			<div style="padding: 26px 0;">

            </div>
           <div class="row-fluid">
                    <div class="span12">
                        <div class="well light_blue">
                            <div class="well-header">
                                <h5>'.$_LANG['featured'].'</h5>
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

                            <div class="well-content no-search">
                                <table  class="table table-hover">
								<div id="clc">
								</div>
                                   <tbody id="feat_box">
									   <tr>
										<td>'.$_LANG['server_info']['name'].'</td>
										<td id="feat_name"><a href="#"></a></td>
										</tr>
										<tr>
											<td>'.$_LANG['server_info']['IP'].'</td>
											<td id="feat_ip"></td>
										</tr>
										<tr>
											<td>'.$_LANG['server_info']['port'].'</td>
											<td id="feat_port"></td>
										</tr>
										<tr>
											<td>'.$_LANG['server_info']['client'].'</td>
											<td id="feat_ver"></td>
										</tr>
										<tr>
											<td>'.$_LANG['server_info']['players'].'</td>
											<td id="feat_players"></td>
										</tr>
										<tr>
											<td>'.$_LANG['server_info']['country'].'</td>
											<td id="feat_country"></td>
										</tr>
                                   </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
					</div>
					<div class="row-fluid">
					<div class="span12">
                        <div class="well purple">
                            <div class="well-header">
                                <h5>'.$_LANG['quick_stat'].'</h5>
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
                                <div class="tab-content">
                                  <div class="tab-pane active">
								  <p>'.$_LANG['quick_stat_part1'].$count_data['players'].$_LANG['quick_stat_part2'].$count_data['online'].
								  $_LANG['quick_stat_part3'].$count_all.$_LANG['quick_stat_part4'].date('d-m-Y, H:i').'
									</p>
                                  </div>
                                </div>
                            </div>
                        </div>
                    </div>
					</div>
					<!-- ADS HERE -->
					</div>
        </div>
    </div>
	
	<div class="span12">
			<center><p>Copyright '. $web_link.' 2013</p></br>
			</center>	</br>
	</div>';
	
?>

    <!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="js/jquery-1.10.2.js"></script>
    <script src="js/jquery-ui-1.10.3.js"></script>
    <script src="js/bootstrap.js"></script>

    <script src="js/library/jquery.collapsible.min.js"></script>
    <script src="js/library/jquery.mCustomScrollbar.min.js"></script>
    <script src="js/library/jquery.mousewheel.min.js"></script>
    <script src="js/library/jquery.uniform.min.js"></script>

    <script src="http://maps.googleapis.com/maps/api/js?key=AIzaSyCL6XtCGot7S7cfxnO6tRfeZx9kLQQRMtA&amp;sensor=false"></script>
    <script src="js/library/jquery.sparkline.min.js"></script>
    <script src="js/library/chosen.jquery.min.js"></script>
    <script src="js/library/jquery.easytabs.js"></script>
    <script src="js/library/flot/excanvas.min.js"></script>
    <script src="js/library/flot/jquery.flot.js"></script>
    <script src="js/library/flot/jquery.flot.pie.js"></script>
    <script src="js/library/flot/jquery.flot.selection.js"></script>
    <script src="js/library/flot/jquery.flot.resize.js"></script>
    <script src="js/library/flot/jquery.flot.orderBars.js"></script>

    <script src="js/library/jquery.autosize-min.js"></script>
    <script src="js/library/charCount.js"></script>
    <script src="js/library/jquery.minicolors.js"></script>
    <script src="js/library/jquery.tagsinput.js"></script>

    <script src="js/library/footable/footable.js"></script>

    <script src="js/library/jquery.inputmask.bundle.js"></script>

    <script src="js/flatpoint_core.js"></script>

<script src="js/library/bootstrap-modal.js"></script>
    <script src="js/library/bootstrap-modalmanager.js"></script>

    <script src="js/forms.js"></script>
 <script src="js/library/footable/data-generator.js"></script>

    <script src="js/library/bootstrap-datetimepicker.js"></script>
    <script src="js/library/bootstrap-timepicker.js"></script>
    <script src="js/library/bootstrap-datepicker.js"></script>


    <script src="js/library/bootstrapSwitch.js"></script>
	
	
	


 
    <script src="js/library/bootstrap-fileupload.js"></script>


  


    <script src="js/library/editor/wysihtml5-0.3.0.js"></script>
    <script src="js/library/editor/bootstrap-wysihtml5.js"></script>



    <script src="js/forms_advanced.js"></script>
	<script>
        jQuery(document).ready(function($) {
            // pass in your custom templates on init
            $(\'.textarea\').wysihtml5();
            $(\'.uniform\').uniform();

            $(\'.chosen\').chosen();
        });
    </script>

  </body>
  <div id="quick_search" class="modal container hide fade" tabindex="-1">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="icon-remove"></i></button>
            <h3><?php echo $_LANG['search']['quick']; ?></h3>
        </div>
        <div class="modal-body">
           <div class="row-fluid">
			<div class="span12">
				<div id="quicksearch_result">
				
			   </div>
			</div>
		</div>
		</div>
    </div>
</html>
<?php
ob_end_flush();
?>
