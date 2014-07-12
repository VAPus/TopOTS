<?php
function mailer($typ,$odbiorca,$tresc='',$id=0,$domain='')
{	
	include('mail_config.php');
	switch($typ){
		case 'contact':
			echo mail($odbiorca, 'Contact form',$tresc);
			break;
		case 'recover':
			$wiadomosc=recover_msg($domain,$tresc,$id);
			mail($odbiorca,'Account recover',$wiadomosc);
			break;	
		case 'register':
			$wiadomosc=accept_msg($domain,$tresc,$id);
			mail($odbiorca,'Account accept',$wiadomosc);
			break;	
	}		
}
?>