<?php
try {
	include_once 'connect.php';

	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	$naam = $_POST["naam"];
    $duur = $_POST["duur"];
    $status = $_POST["status"];
    $beschrijving = $_POST["beschrijving"];
    $id = $_POST["id"];

	$sql = 'UPDATE taken SET naam = :naam, duur = :duur, status = :status, beschrijving = :beschrijving WHERE id = :id';
	$stmt = $pdo->prepare($sql);
	$stmt->execute(['naam' => $naam, 'duur' => $duur, 'status' => $status, 'beschrijving' => $beschrijving, 'id' => $id]);

    header("Location: index.php");
}
catch(PDOException $e)
{
    echo "Error: " . $e->getMessage();
}
$conn = null;