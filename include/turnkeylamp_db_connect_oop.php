<?php
$mysqli = new mysqli("localhost", "adminer", "P@ssw0rd", "taskTwoDB");
if($mysqli === false) {
	die("ERROR: Could not connect. " . $mysqli->connect_error);
}

$sql = "USE taskTwoDB";
$mysqli->query($sql); 
?>