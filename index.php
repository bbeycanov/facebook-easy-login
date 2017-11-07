<?php 
	// SESSION START
	session_start();
	
	// INCLUDE CUSTOM CONFIGRATION FILE
	require_once('config.php');
	
	// INCLUDE FACEBOOK API PROJECT
	require_once('Facebook/autoload.php');
	
	// SET DEFAULT TIME ZONE IMPORTANT
	date_default_timezone_set('Europe/Istanbul');
	
	// SET FACEBOOK CONFIGRATION 
	$fb = new Facebook\Facebook(['app_id' => APP_ID ,'app_secret' => SECRET_KEY ,'default_graph_version' => GRAPH_VERSIONS]);
	
	/*
		CHOOSE YOUR DATA. 
		
		Example :
		
			https://graph.facebook.com/me/?fields=id,
			name,
			picture,
			friends,
			........,
			&access_token='your-access-token'
	*/
	
	/* --> */ $url = 'https://graph.facebook.com/me/?fields=id,name,picture,friends&access_token='.$_SESSION['facebook_access_token'];
	$curl = curl_init($url);
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
	$result = curl_exec($curl);
	curl_close($curl);
	$arr = json_decode($result,true);
	
	echo"<pre>";
	print_r($arr);
?>

