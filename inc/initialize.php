<?php

	include('bmt/inc/core.php');

	$mode=returnConnectivityStat();
    require_once('bmt/inc/connect_'.$mode.'.php');
	foreach(scandir('bmt/classes/') as $file) {
		if($file!='.' && $file!='..' && $file!='.DS_Store'){
			if(strpos('class.', $file)!==-1){
				include('bmt/classes/'.$file);
			}
		}
	}
	include('inc/mobiledetect.php');
	include('inc/define.php');
	include('inc/routing.php');
?>
