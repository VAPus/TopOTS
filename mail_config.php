 <?php 
 function recover_msg($domain,$key,$id){
	return 'To reset your password visit this website: '.$domain.'/?page=reset&id='.$id.'&key='.$key.' </br>
	OTSlist team';
 }
 
  function accept_msg($domain,$key,$id){
	return 'To accept your account visit this website: '.$domain.'/?page=accept_acc&id='.$id.'&key='.$key.' </br>
	OTSlist team';
 }
 ?>