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
	
	// CHANGE CUSTOM PERMISSION FACEBOOK. THIS DEFAULT PERMISSIONS
	$permissions = ['public_profile','email','user_friends'];
	
	// REDIRECT LOGIN AND GET ACCESS TOKEN URL
	$loginUrl = $helper->getLoginUrl(URL.'fb-callback.php', $permissions);
	
	// AUTH LOGIN URL
	header('Location:'.$loginUrl);
?> 