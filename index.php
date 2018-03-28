<?php

  	//error_reporting(E_ALL); ini_set('display_errors', 'On');
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

  	if(isset($_SESSION['error_message']) && $_SESSION['error_message']!=''){
  		$error=$_SESSION['error_message'];
  		unset($_SESSION['success_message']);
  		$_SESSION['error_message']='';
  	}
  	if(isset($_SESSION['success_message']) && $_SESSION['success_message']!=''){
  		$success=$_SESSION['success_message'];
  		$_SESSION['success_message']='';
  	}

   include('scripts/users/validate.php');

   if(!isset($_GET['page'])){
    if(!isset($user)){
      include('pages/home.php');
    }else{
      if($user['xpub']!=''){
        include('pages/pos.php');
      }else{
        include('pages/inizializzazione.php');
      }
    }
   }else{
    include('pages/'.$_GET['page'].'.php');
   }
?>
