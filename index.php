<?php
include_once 'connect.php';
//begin van alle lijsten + taken op de pagina zetten
//selecteert alles uit 'lijsten' en zet het op de pagina
$stmt = $pdo->query('SELECT * FROM lijsten');

	if ($_GET['order'] == 'DESC') {
		$order = 'DESC';
		$orderButton = 'ASC';
	} else {
		$order = 'ASC';
		$orderButton = 'DESC';
	}
	
	if ($_GET['orderType'] == 'duur') {
		$orderType = 'duur';
		$orderTypeButton = 'status';
	} else {
		$orderType = 'status';
		$orderTypeButton = 'duur';
	}

while ($row = $stmt->fetch()) {
	$lijstid = $row->id;
	echo '<h3>' . $row->naam . '</h3>';

	//selecteert elke taak die bij de lijst hoort die momenteel door de loop gaat

	$sql = 'SELECT * FROM taken WHERE lijstid = ? ORDER BY ' . $orderType . ' ' . $order;
	$tstmt = $pdo->prepare($sql);
	$tstmt->execute([$lijstid]);
	$taken = $tstmt->fetchALL();

	foreach ($taken as $taken) {
		echo '<p class = status' . $taken->status .'>' . $taken->naam . '</p>';
	}
	echo '<br>';
}
//eind van alle lijsten + taken op de pagina zetten
?>

<html>
	<head>
	    <title>Todo list</title>
	    <link rel="stylesheet" type="text/css" href="style/style.css">
	<!--title werkt niet en voor styling moet w3.css gebruikt worden-->
</head>
	<body>
		<a href="index.php?order=<?php
		echo $orderButton;
		?>">sorteer op <?php
		echo $orderButton;
		?></a>
		<br>
		<a href="index.php?orderType=<?php
		echo $orderTypeButton;
		?>">sorteer op <?php
		echo $orderTypeButton;
		?></a>

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

		<form action="deleteList.php" method="post">
			<h2>verwijder een lijst</h2>
			id: <input type="number" name="id"><br>
			<input type="submit">
		</form>

		<form action="taskCreate.php" method="post">
			<h2>voeg een taak toe</h2>
			naam: <input type="text" name="naam"><br>
			duur: <input type="text" name="duur"><br>
			status: <input type="text" name="status"><br>
			lijst id: <input type="number" name="lijstid"><br>
			beschrijving: <input type="text" name="beschrijving"><br>
			<input type="submit">
		</form>

		<form action="updateTask.php" method="post">
			<h2>update een taak</h2>
			naam: <input type="text" name="naam"><br>
			duur: <input type="text" name="duur"><br>
			status: <input type="text" name="status"><br>
			beschrijving: <input type="text" name="beschrijving"><br>
			id: <input type="number" name="id"><br>
			<input type="submit">
		</form>

		<form action="deleteTask.php" method="post">
			<h2>verwijder een taak</h2>
			id: <input type="number" name="id"><br>
			<input type="submit">
		</form>


	</body>
</html>

<!--
alle lijsten naast elkaar zetten met de taken er onder. 2 sorteer knoppen bij de lijst. 1 met 'sorteer op status' en een ander met 'sorteer op duur'

met een druk op een knop naast elke taak / lijst komt een form tevoorschijn.

code bestanden beter verdelen in verschillende mapjes.

//status - knop in de forms waar men tussen 1 en 5 kan kiezen
1 moet beginnen
2 begonnen
3 halverwegen
4 bijna klaar
5 klaar

duur is tijd in minuten



 -->