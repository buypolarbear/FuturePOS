<?php
	if(is_file('inc/utility/hashes.bmt')){
		$hashes=json_decode(file_get_contents('inc/utility/hashes.bmt'),1);
		foreach($hashes as $file){
			$check=sha1_file($file['file']);
			if($check!=$file['hash']){
				include('tools/minifier/minifySystem.php');
				break;
			}
		}
	}else{
		include('tools/minifier/minifySystem.php');
	}
?>