<?php
	$hostname_connect = "localhost";
	$database_connect = "futurepos";
	$username_connect = "futurepos";
	$password_connect = "@#Future_POSDB01!@#";


	define("salt",str_replace("www.","",$_SERVER["SERVER_NAME"]));
	define("hostname_connect", $hostname_connect);
	define("database_connect", $database_connect);
	define("username_connect", $username_connect);
	define("password_connect", $password_connect);
?>
