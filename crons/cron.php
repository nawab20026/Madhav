<?php
$cxrteamurl = $_SERVER["SERVER_NAME"];

file_get_contents("https://{$cxrteamurl}/crons/bharatpecron.php");
file_get_contents("https://{$cxrteamurl}/crons/hdfccron.php");
file_get_contents("https://{$cxrteamurl}/crons/hdfcupi.php");
file_get_contents("https://{$cxrteamurl}/crons/phonepecron.php");
?>
