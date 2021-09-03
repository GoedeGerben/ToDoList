<?php
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

<form action="listCreate.php" method="post">
<h2>voeg een lijst toe</h2>
naam: <input type="text" name="naam"><br>
kleur: <input type="text" name="kleur"><br>
<input type="submit">
</form>

<form action="updateList.php" method="post">
<h2>Update een lijst</h2>
naam: <input type="text" name="naam"><br>
id: <input type="number" name="id"><br>
<input type="submit">
</form>

<form action="taskCreate.php" method="post">
<h2>voeg een taak toe</h2>
naam: <input type="text" name="naam"><br>
belangtijk: <input type="text" name="belangrijk"><br>
lijst id: <input type="number" name="lijstid"><br>
beschrijving: <input type="text" name="beschrijving"><br>
<input type="submit">
</form>

</body>
</html>