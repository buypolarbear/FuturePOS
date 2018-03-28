<?php
	//error_reporting(E_ALL); ini_set('display_errors', 'On');
	include('phpqrcode/qrlib.php');
	QRcode::png($_GET['qr']);
