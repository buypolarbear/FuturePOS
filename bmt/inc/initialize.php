<?php
	error_reporting(E_ALL); ini_set('display_errors', 'On');
	if (!isset($_SESSION)) {
	  session_start();
	}
   	include('core.php');

   	$mode=returnConnectivityStat();

    require_once('connect_'.$mode.'.php');


	include('write_htaccess.php');
	include('write_sitemap.php');

?>
