<?php
$dsn = "mysql:host=localhost;dbname=todolist";
$dbname = "todolist";
$servername = "localhost";
$username = "Gerard";
$password = "GerardGerard";

try{
	header("location: listboard.php");
}catch(PDOException $e){
	$error_message = $e->getMessage();
	echo $error_message;
	exit();
}
?>