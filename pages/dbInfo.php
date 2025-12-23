<?php
error_reporting(0);
date_default_timezone_set('Asia/Kolkata');

function connect_database() {
	$fetchType = "array";
	$dbHost    = "localhost";
	$dbLogin   = "u453274677_5upiGAME";
	$dbPwd     = "U453274677_5upiGAME";
	$dbName    = "u453274677_5upiGAME";
	$con       = mysqli_connect($dbHost, $dbLogin, $dbPwd, $dbName);
	if (!$con) {
		die("Database Connection failes" . mysqli_connect_errno());
	}
	return ($con);
}

// Database configuration
define('DB_HOST', 'localhost');
define('DB_USERNAME', 'u453274677_5upiGAME');
define('DB_PASSWORD', 'U453274677_5upiGAME');
define('DB_NAME', 'u453274677_5upiGAME');
?>