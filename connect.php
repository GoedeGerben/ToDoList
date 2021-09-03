<?php
$host = 'localhost';
$user = 'Gerard';
$password = 'GerardGerard';
$dbname = 'todolist';

$dsn = 'mysql:host='. $host .';dbname='. $dbname;

$pdo = new PDO($dsn, $user, $password);
$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);//zorgt ervoor dat je niks in de fetch() moet zetten