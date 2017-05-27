<?php
session_start();

$dbserver = "";
$dbusername = "";	
$dbpassword = "";
$dbname = "";

$db = new mysqli($dbserver, $dbusername, $dbpassword, $dbname);
if ($db->connect_error) {
	die("Nejde se připojit k databázi: " . $db->connect_error);
}
//echo "Úspěšně připojeno<br><br>";
?>
