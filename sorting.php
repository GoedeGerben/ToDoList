<?php
try {
	include_once 'connect.php';

	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	$stmt = $pdo->query('SELECT * FROM lijsten');

	while ($row = $stmt->fetch()) {
		$lijstid = $row->id;
		echo '<h3>' . $row->naam . '</h3>';

		//selecteert elke taak die bij de lijst hoort die momenteel door de loop gaat
		$sql = 'SELECT * FROM taken WHERE lijstid = ? ORDER BY status';
		$tstmt = $pdo->prepare($sql);
		$tstmt->execute([$lijstid]);
		$taken = $tstmt->fetchALL();

		foreach ($taken as $taken) {
			echo '<p class = status' . $taken->status .'>' . $taken->naam . '</p>';
		}
	echo "<br>";
	}
	header("Location: index.php")
}
catch(PDOException $e)
{
    echo "Error: " . $e->getMessage();
}
$conn = null;
