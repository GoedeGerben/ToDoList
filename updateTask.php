<?php
try {
	include_once 'connect.php';

	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	$naam = $_POST["naam"];
    $belangrijk = $_POST["belangrijk"];
    $beschrijving = $_POST["beschrijving"];
    $id = $_POST["id"];

	$sql = 'UPDATE taken SET naam = :naam, belangrijk = :belangrijk, beschrijving = :beschrijving WHERE id = :id';
	$stmt = $pdo->prepare($sql);
	$stmt->execute(['naam' => $naam, 'belangrijk' => $belangrijk,'beschrijving' => $beschrijving, 'id' => $id]);

    echo "New records created successfully";
}
catch(PDOException $e)
{
    echo "Error: " . $e->getMessage();
}
$conn = null;