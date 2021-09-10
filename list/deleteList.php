<?php
try {
	include_once '../connect.php';

	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $id = $_POST["id"];

	$sql = 'DELETE FROM lijsten WHERE id = :id';
	$stmt = $pdo->prepare($sql);
	$stmt->execute(['id' => $id]);

    header("Location: ../index.php");
}
catch(PDOException $e)
{
    echo "Error: " . $e->getMessage();
}
$conn = null;