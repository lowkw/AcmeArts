<?php
try{
	$pdo = new PDO ("mysql:host=localhost;dbname=acmeartsdb","root","");
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	
} catch (PDOException $e) {
	die("ERROR: Could not connect. " . $e->getMessage());	
}

try{
	$sql = "USE acmeartsdb";
	$result = $pdo->query($sql);	
} catch (PDOException $e) {
	die("ERROR: Could not able to execute $sql. " . $e->getMessage());
}
?>