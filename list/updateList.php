<?php
try {
	include_once '../connect.php';

	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	$naam = $_POST["naam"];
    $id = $_POST["id"];

	$sql = 'UPDATE lijsten SET naam = :naam WHERE id = :id';
	$stmt = $pdo->prepare($sql);
	$stmt->execute(['naam' => $naam, 'id' => $id]);

    header("Location: ../index.php");
}
catch(PDOException $e)
{
    echo "Error: " . $e->getMessage();
}
$conn = null;