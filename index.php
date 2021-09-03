<?php
/*$host = 'localhost';
$user = 'Gerard';
$password = 'GerardGerard';
$dbname = 'todolist';

$dsn = 'mysql:host='. $host .';dbname='. $dbname;

$pdo = new PDO($dsn, $user, $password);
$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);//zorgt ervoor dat je niks in de fetch() moet zetten*/

include_once 'connect.php';
//begin van alle lijsten + taken op de pagina zetten
//selecteert alles uit 'lijsten' en zet het op de pagina
$stmt = $pdo->query('SELECT * FROM lijsten');

while ($row = $stmt->fetch()) {
	$lijstid = $row->id;
	echo $row->naam . '<br>';

	//selecteert elke taak die bij de lijst hoort die momenteel door de loop gaat
	$sql = 'SELECT * FROM taken WHERE lijstid = ?';
	$tstmt = $pdo->prepare($sql);
	$tstmt->execute([$lijstid]);
	$taken = $tstmt->fetchALL();

	foreach ($taken as $taken) {
		echo $taken->naam . '<br>';
	}
	echo '<br>';
}
//eind van alle lijsten + taken op de pagina zetten

//lijst toevoegen
//lijst weizigen
//lijst verwijderen

//taak toevoegen
//taak weizigen
//taak verwijderen



//include "dbconnection.php"; file aanmaken waar de db connectie in staat. 
?>

<html>
<body>

<form action="taskCreate.php" method="post">
naam: <input type="text" name="naam"><br>
belangtijk: <input type="text" name="belangrijk"><br>
lijst id: <input type="number" name="lijstid"><br>
beschrijving: <input type="text" name="beschrijving"><br>
<input type="submit">
</form>

</body>
</html>