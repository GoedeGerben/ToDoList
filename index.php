<?php
include_once 'header.php';
include_once 'connect.php';

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

//begin van alle lijsten + taken op de pagina zetten
//selecteert alles uit 'lijsten' en zet het op de pagina
$stmt = $pdo->query('SELECT * FROM lijsten');
echo '<div class="w3-row">';
while ($row = $stmt->fetch()) {
	$lijstid = $row->id;
	echo '<div style="border:3px solid" class="w3-col s2 w3-border-black">' . $row->naam;

	//selecteert elke taak die bij de lijst hoort die momenteel door de loop gaat
	$sql = 'SELECT * FROM taken WHERE lijstid = ? ORDER BY ' . $orderType . ' ' . $order;
	$tstmt = $pdo->prepare($sql);
	$tstmt->execute([$lijstid]);
	$taken = $tstmt->fetchALL();

	foreach ($taken as $taken) {
		echo '<div class="status' . $taken->status .'">' . $taken->naam . '</div>';
	}
	echo "</div>";
}
echo '</div';
//eind van alle lijsten + taken op de pagina zetten
?>
	<body>
		<a href="index.php?order=<?php
		echo $orderButton . '&orderType=' . $orderType;
		?>">sorteer op <?php
		echo $orderButton;
		?></a>
		<br>
		<a href="index.php?orderType=<?php
		echo $orderTypeButton . '&order=' . $order;
		?>">sorteer op <?php
		echo $orderTypeButton;
		?></a>

		<div class="w3-row">
			<form action="list/listCreate.php" method="post" class="w3-col s3">
				<h2>voeg een lijst toe</h2>
				naam: <input type="text" name="naam"><br>
				kleur: <input type="text" name="kleur"><br>
				<input type="submit">
			</form>

			<form action="list/updateList.php" method="post" class="w3-col s3">
				<h2>Update een lijst</h2>
				naam: <input type="text" name="naam"><br>
				id: <input type="number" min="1" name="id"><br>
				<input type="submit">
			</form>

			<form action="list/deleteList.php" method="post" class="w3-col s3">
				<h2>verwijder een lijst</h2>
				id: <input type="number" min="1" name="id"><br>
				<input type="submit">
			</form>
		</div>
		<div class="w3-row">
			<form action="task/taskCreate.php" method="post" class="w3-col s3">
				<h2>voeg een taak toe</h2>
				naam: <input type="text" name="naam"><br>
				duur: <input type="number" min="1" name="duur"><br>
				status: <input type="number" min="1" max="5" name="status"><br>
				lijst id: <input type="number" name="lijstid"><br>
				beschrijving: <input type="text" name="beschrijving"><br>
				<input type="submit">
			</form>

			<form action="task/updateTask.php" method="post" class="w3-col s3">
				<h2>update een taak</h2>
				naam: <input type="text" name="naam"><br>
				duur: <input type="number" min="1" name="duur"><br>
				status: <input type="number" min="1" max="5" name="status"><br>
				beschrijving: <input type="text" name="beschrijving"><br>
				id: <input type="number" name="id"><br>
				<input type="submit">
			</form>

			<form action="task/deleteTask.php" method="post" class="w3-col s3">
				<h2>verwijder een taak</h2>
				id: <input type="number" name="id"><br>
				<input type="submit">
			</form>
		</div>
	</body>
</html>

<!--
met een druk op een knop naast elke taak / lijst komt een form tevoorschijn.

taken van lijst verwijderen

op taak / lijst klikken om aan te passen.
 -->