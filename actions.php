<?php
	if(!isset($_SESSION)){
		ini_set('session.cookie_httponly', 1);
		ini_set('session.use_only_cookies', 1);
		ini_set('session.cookie_secure', 1);
		session_start();
		session_regenerate_id();
	}

	header("strict-transport-security: max-age=10");
	require_once 'inc/purify/HTMLPurifier.auto.php';

	if( !isset($_SERVER['HTTPS'] ) ) {
		die();
	}

	$actual_link = "http://$_SERVER[HTTP_HOST]";
	$full_link = $_SERVER['REQUEST_URI'];
	preg_match('#%3Cscript(.*?)%3E(.*?)%3C/script%3E#is',$full_link, $matches, PREG_OFFSET_CAPTURE);

	$config = HTMLPurifier_Config::createDefault();
	$purifier = new HTMLPurifier($config);
	include('inc/initialize.php');

	$purified=$purifier->purify($_SERVER['REQUEST_URI']);
	if($purified!=$_SERVER['REQUEST_URI']){
		header('location: /');
	}

	$config = HTMLPurifier_Config::createDefault();
	$purifier = new HTMLPurifier($config);

 include('scripts/users/validate.php');
	require($purifier->purify($_GET['require']));

?>
