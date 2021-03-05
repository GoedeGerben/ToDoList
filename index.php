<?php
$dsn = "mysql:host=localhost;dbname=todolist";
$username = "Gerard";
$password = "GerardGerard";

try{
	$db = new PDO($dsn, $username, $password);
	header("location: listboard.php");
	
}catch(PDOException $e){
	$error_message = $e->getMessage();
	echo $error_message;
	exit();
}
?>