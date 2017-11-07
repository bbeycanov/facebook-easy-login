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
	
	// CHOOSE LOGIN TYPE
	$helper = $fb->getRedirectLoginHelper();
	
	// SET HANDLER KEY
	if (isset($_GET['state'])) {$helper->getPersistentDataHandler()->set('state', $_GET['state']);}
	
	try {
		//  ACCESS TOKEN SUCCESS
		$accessToken = $helper->getAccessToken();
	}
	catch(Facebook\Exceptions\FacebookResponseException $e) {
		// ACCESS TOKEN ERROR
		echo $e->getMessage(); exit;
	} 
	catch(Facebook\Exceptions\FacebookSDKException $e){
		// ACCESS TOKEN ERROR
		echo $e->getMessage();  exit;
	}
	
	// ACCSESS TOKEN ISSET
	if (isset($accessToken)){
		// SESSION WRITE ACCESS TOKEN
		$_SESSION['facebook_access_token'] = (string) $accessToken;
		
		// AUTH INDEX FILE
		header('Location:'.URL);
	}
	// ACCESS TOKEN UNSET
	elseif($helper->getError()){
		exit;
	}
?>