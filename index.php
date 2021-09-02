<?php
$host = 'localhost';
$user = 'Gerard';
$password = 'GerardGerard';
$dbname = 'todolist';

$dsn = 'mysql:host='. $host .';dbname='. $dbname;

$pdo = new PDO($dsn, $user, $password);
$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);//zorgt ervoor dat je niks in de fetch() moet zetten


//begin van alles op de pagina zetten
//selecteert alles uit 'lijsten' en zet het op de pagina
$stmt = $pdo->query('SELECT * FROM lijsten');

while ($row = $stmt->fetch()) {
	$lijstid = $row->id;
	echo $row->naam . '<br>';

	//selecteert elke taak die bij de lijst hoort die momenteel door de loop gaat
	$sql = 'SELECT * FROM taken WHERE lijstid = ?';
	$stmt = $pdo->prepare($sql);
	$stmt->execute([$lijstid]);
	$taken = $stmt->fetchALL();

	foreach ($taken as $taken) {
		echo $taken->naam . '<br>';
	}
	echo '<br>';
}
?>