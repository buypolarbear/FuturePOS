<?php

	if(!isset($_GET['page'])){
		if(isset($splash['id'])){
			$route='splash';
			$datatype='splash';
		}else{
			$route='homepage';
			$datatype='homepage';
		}
	}else{
		$datatype='';
		$result = returnDBObject("SHOW TABLES FROM ".$database_connect,array());
		foreach($result as $res){
			$ch=explode('_',$res[0]);
			if(isset($ch[1])){
				if($ch[1]==$_GET['page']){
					$datatype=$_GET['page'];
					$route=$_GET['page']	;
				}
			}
		}
		if(!isset($route) && $datatype==''){
			$route=$purifier->purify($_GET['page']);
		}
	}
?>