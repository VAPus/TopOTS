/* Dont delete this code!!! This file has to be included in template or template will lose his main functionality */
/* This is main core javascript for properly functioning template - DO NOT DELETE OR EXCLUDE THIS FILE */

jQuery.noConflict();

/** Debounced resize - resizing screen update width and height of some elements **/
(function($,sr){
  var debounce = function (func, threshold, execAsap) {
    var timeout;

    return function debounced () {
        var obj = this, args = arguments;
        function delayed () {
            if (!execAsap)
                func.apply(obj, args);
            timeout = null; 
        };

        if (timeout)
            clearTimeout(timeout);
        else if (execAsap)
            func.apply(obj, args);

        timeout = setTimeout(delayed, threshold || 100); 
    };
  }
  // smartresize 
  jQuery.fn[sr] = function(fn){  return fn ? this.bind('resize', debounce(fn)) : this.trigger(sr); };
})(jQuery,'smartresize');

/** Functions start here **/

jQuery(function($) {

  /* Responsive menu show/hide */
  $('.responsive_menu a').click(function() {
    if($('#main_navigation > div').length > 0) {
      if($('#main_navigation > div').is(":hidden")) {
        $('#main_navigation > div').slideDown();
      } else {
        $('#main_navigation > div').slideUp();
      }
      return false;
    }

    if($('#top_navigation').length > 0) {
      if($('#top_navigation').is(':hidden')) {
        $('#top_navigation').slideDown();
      } else {
        $('#top_navigation').slideUp();
      }
      return false;
    }
  });

  /** Popovers **/
  $('a[rel="popover"]').popover();
  
  $('a[rel="popover"]').click(function() {
    return false;
  });

  /** Tooltips **/
  $("[rel='tooltip']").tooltip();

  //* If main navigation doesn't exist eet content margin-left to 0 *//
  function mainNav() {
    if($('#main_navigation').length === 0) {
      $('#content').css('margin-left', '0px')
    }
  }
  mainNav();

  //* Main menu functions *//
  $('ul.main > li').each(function() {
    var sub_main = $(this).find('ul');
    if (sub_main.length > 0) {
      $(this).children('a').addClass('expand');
      $(this).children('a').append('<span class="count"><i class="icon-chevron-down"></i></span>');
    }
  });

  $('.expand').collapsible({
    defaultOpen: 'current,third',
    cookieName: 'navAct',
    cssOpen: 'subOpened',
    cssClose: 'subClosed',
    speed: 200
  });

  //* Inner navigation height - margin from top *//
  function nav_positions() {
    if($(window).width() > 768) {
      var windowHeight = $(window).height();
      if($('header').css('position') === 'fixed') {
        $('.inner_navigation').css('height', windowHeight - 45 + 'px');
        $('#content').css('padding-top', '45px')
      } else {
        $('#main_navigation').css('position', 'absolute');
        if ($('body').scrollTop() > 46) {
          $('#main_navigation').css({
            'position': 'fixed'
          });
          $('.inner_navigation').css({
            'margin-top': '0',
            'height': windowHeight - 1 + 'px'
          });
          $(".inner_navigation").mCustomScrollbar('update');
        } else {
          $('#main_navigation').css({
            'position': 'absolute'
          });
          $('.inner_navigation').css({
            'margin-top': '44px',
            'height': windowHeight - 45 + 'px'
          });
          $(".inner_navigation").mCustomScrollbar('update');
        }
      }
    } else {
      $('.inner_navigation').css('height', 'inherit');
    }
  }
  nav_positions();

  $(window).scroll(function(){
    nav_positions();
  });

  //* Inner navigation scrolling if go over height *//
  function customScrollMainNavigation() {
    if($(window).width() > 767) {
      if($(".inner_navigation").hasClass('mCustomScrollbar')) {
        return false
      } else {
        $(".inner_navigation").mCustomScrollbar({
          advanced:{
            updateOnContentResize: true,
            updateOnBrowserResize: true
          }
        });
      }
    } else {
      $(".inner_navigation").mCustomScrollbar("destroy");
    }
  }
  customScrollMainNavigation();

  function updateScrollbar() {
    $('.inner_navigation').mCustomScrollbar("update");
  }

  $(window).smartresize(function(){
    customScrollMainNavigation();
    nav_positions();
    updateScrollbar();
  });

  //* Message system min height *//
  function messageheight() {
    var minHeight = $('.message_center .tab-list').height() -1;
    $('.message_center .message_list').css('min-height', minHeight + 'px')
  }
  messageheight();

  //* Footer width calculation based on main navigation *//
  function footermargin() {
    if($('#main_navigation').is(":hidden")) {
      $('footer').css('margin-left', '0px')
    } else {
      $('footer').css('margin-left', '220px')
    }
  }
  footermargin();

  $(window).smartresize(function(){
    footermargin();
  });

  //* Images hover effects *//
  $('.view').hover(function() {
    if($(this).hasClass('view-options')) {
      $(this).find('img').animate({
        'margin-left': '-50%'
      });
      $(this).find('.overlay').animate({
        'width': '50%',
        'opacity': '0.5'
      });
    } else {
      $(this).find('.overlay').animate({
        'opacity': '0.5'
      });
    }
  }, function() {
    if($(this).hasClass('view-options')) {
      $(this).find('img').animate({
        'margin-left': '0'
      });
      $(this).find('.overlay').animate({
        'width': '100%',
        'opacity': '0'
      });
    } else {
      $(this).find('.overlay').animate({
        'opacity': '0'
      });
    }   
  });

  //* Header menu dropdown *//
  $('.header_actions > li > a').click(function() {
    $('.header_actions > li > ul').fadeOut(50);
    var sub = $(this).parent().find('ul');
    if(sub.length > 0) {
      if(sub.is(":hidden")) {
        sub.fadeIn(50);
      } else {
        sub.fadeOut(50);
      }
      return false;
    }
  });

  $('.header_actions > li').click(function(event) {
    event.stopPropagation();
  });

  $(document).click(function() {
    $('.header_actions > li > ul').fadeOut(50);
  });

  //* Show hide main navigation *//
  function mainNavHidden() {
    if($('#main_navigation').is(":hidden")) {
      $('#content').css('margin-left', '0px');
    } else {
      $('#content').css('margin-left', '219px');
    }
  }

  $('.header_actions li a.hide_navigation').click(function() {
    var main_navigation = $('#main_navigation');
    if(main_navigation.is(":hidden")) {
      main_navigation.css('display','block');
      mainNavHidden();
      $(this).find('i').removeClass('icon-chevron-right');
      $(this).find('i').addClass('icon-chevron-left');
    } else {
      main_navigation.css('display','none');
      mainNavHidden();
      $(this).find('i').removeClass('icon-chevron-left');
      $(this).find('i').addClass('icon-chevron-right');
    }
    footermargin();
    return false;
  });

  //* Draggable boxes UI *//
  $("#sortable_boxes").sortable({
    connectWith: ".well",
    items: ".well",
    opacity: 0.8,
    coneHelperSize: true,
    placeholder: 'sortable-box-placeholder round-all',
    forcePlaceholderSize: true,
    tolerance: "pointer"
  });

  $(".column").disableSelection();

  //* Collapsible wells
  $('li.collapse_well a').click(function() {
    var container = $(this).parents('.well').find('.well-content');
    if(container.is(":hidden")) {
      container.slideDown();
      $(this).find('i').removeClass('icon-plus').addClass('icon-minus');
    } else {
      container.slideUp();
      $(this).find('i').removeClass('icon-minus').addClass('icon-plus')
    }
    return false;
  });

  //* Spark lines on dashboard *//
  $("#sparkline").sparkline([5,6,7,5,1,5,2,5,2,3,7,1,2,4,7], {
      type: 'bar',
      height: '30',
      barSpacing: 2,
      barColor: '#0072c6',
      negBarColor: '#ac193d'
  });

  $("#sparkline2").sparkline([3,5,7,2,4,6,7,1,3,6,2,4,6,5,2], {
      type: 'bar',
      height: '30',
      barSpacing: 2,
      barColor: '#ac193d',
      negBarColor: '#ac193d'
  });







  //* You can remove code below if you want to pick colors manually and after you set your template
  //* This is junk code - used for live preview setting/changing live colors on wells, header, main navigation...

  /* Well color schemes */
  $('.well-header > ul > li > a').click(function() {
    var dropdown = $(this).parent('li').children('ul');
    $('.well-header > ul > li > ul').fadeOut(50);
    if(dropdown.is(":hidden")) {
      dropdown.show();
    } else {
      dropdown.hide();
    }
    return false;
  });

  $('a.set_color').click(function() {
    var element = $(this).attr('class').split(' ')[0]
    $(this).parents('.well').removeClass().addClass('well ' + element)
    return false;
  });

  $('.header_actions a.set_color').click(function() {
    var element = $(this).attr('class').split(' ')[0]
    $(this).parents('header').removeClass().addClass(element)
    return false;
  });

  $('li.navigation_color_pick > ul > li > a').click(function() {
    var element = $(this).attr('class').split(' ')[0]
    $('#main_navigation').removeClass().addClass(element)
    return false;
  });

  $('a.dark_navigation').click(function() {
    var element = $(this).attr('class').split(' ')[0]
    $('#main_navigation').removeClass().addClass(element)
    return false;
  });

});

var pre_img='<div class="preloader"><img class="preloader-img" src="img/preloader4.gif"></div>';
var pre_img2='<div class="preloader_tab"><img src="img/preloader.gif"></div>';

$('#feat_name').html(pre_img);
$('#feat_ip').html(pre_img);
$('#feat_port').html(pre_img);
$('#feat_ver').html(pre_img);
$('#feat_players').html(pre_img);
$('#feat_country').html(pre_img);

$('#clc').load('includes/featured_box.php');
	

$(window).load(function() {
  $('#loader').remove();
});

var comments_loaded=0;
var more_info_loaded=0;
var map_loaded=0;
var motd_loaded=0;

function load_comments(id)
{
	if(comments_loaded==0){
		$('#comments').html(pre_img2);	
		$('#comments').load('pages/view_load_comments.php?id='+id);
		comments_loaded=1;
	}
}

function load_more_info(id, lang)
{
	if(more_info_loaded==0){
		$('#more_info').html(pre_img2);		
		$('#more_info').load('pages/view_load_info.php?id='+id+'&lang='+lang);
		more_info_loaded=1;
	}
}

function load_motd(id)
{
	if(motd_loaded==0){
		$('#motd').html(pre_img2);		
		$('#motd').load('pages/view_load_motd.php?id='+id);
		motd_loaded=1;
	}
}

function load_map(id)
{
	if(map_loaded==0){
		$('#map').html(pre_img2);	
		$('#map').load('pages/view_load_map.php?id='+id);
		map_loaded=1;
	}
}

function quick_search_post(lang){
		status_mode="false";
		type_mode="false";
		country_mode="false";
		exptype_mode="false";
		map_mode="false";
		client_mode="false";
		exp_mode="false";
		players_mode="false";
		uptime_mode="false";
		/*exp2=$("[name=exp2]").val();
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
		submit=$("[name=submit]").val();*/
		
		name=$("[name=quick_search_input]").val();
		name_mode="true";
		submit="true";
	
	$("#quicksearch_result").html('<div class="preloader_tab"><img src="img/preloader.gif"></div>');
	
     //$.post("pages/search_result.php?lang="+lang,{submit:submit,status_mode:status_mode,name_mode:name_mode,status:status,client:client,map:map,exptype:exptype,country:country,type:type,uptime1:uptime1,players1:players1,exp1:exp1,name:name,uptime2:uptime2,players2:players2,exp2:exp2,uptime_mode:uptime_mode,players_mode:players_mode,exp_mode:exp_mode,client_mode:client_mode,map_mode:map_mode,country_mode:country_mode,type_mode:type_mode,country_mode:country_mode,exptype_mode:exptype_mode},function(result){
     $.post("pages/search_result.php?lang="+lang,{submit:submit,status_mode:status_mode,name_mode:name_mode,name:name,uptime_mode:uptime_mode,players_mode:players_mode,exp_mode:exp_mode,client_mode:client_mode,map_mode:map_mode,country_mode:country_mode,type_mode:type_mode,country_mode:country_mode,exptype_mode:exptype_mode},function(result){
     $("#quicksearch_result").html(result);
    });
}

function quick_view(lang,id){
	$("#quick_viewtab").html('<div class="preloader_tab"><img src="img/preloader.gif"></div>');
	$("#quick_viewtab").load('pages/view.php?postlang='+lang+'&id='+id);
}

function more_info(id){
	var id2=$("[name=servers_server]").val();
	$("#more_infotab").html('<div class="preloader_tab"><img src="img/preloader.gif"></div>');
	$("#more_infotab").load('pages/moreinfo.php?id='+id+'&id2='+id2);
}

function more_info_acc(id){
	var id2=$("[name=accs_acc]").val();
	$("#more_infotab").html('<div class="preloader_tab"><img src="img/preloader.gif"></div>');
	$("#more_infotab").load('pages/moreinfoacc.php?id='+id+'&id2='+id2);
}

function admin_eots(){
	var id=$("[name=servers_server]").val();
	window.location='?page=admin_eots&id='+id;
}

function admin_eacc(){
	var id=$("[name=accs_acc]").val();
	window.location='?page=admin_eacc&id='+id;
}

function calc_points(type){
	var start=$("[name=date_start_"+type+"]").val();
	var end=$("[name=date_end_"+type+"]").val();
	start=start.replace(' ','+');
	start=start.replace(':','_');
	end=end.replace(' ','+');
	end=end.replace(':','_');
	$("#"+type+"_calc_result").load('pages/calc_points.php?start='+start+'&end='+end+'&type='+type);
}
