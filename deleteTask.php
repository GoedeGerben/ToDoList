<?php
try {
	include_once 'connect.php';

	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $id = $_POST["id"];

	$sql = 'DELETE FROM taken WHERE id = :id';
	$stmt = $pdo->prepare($sql);
	$stmt->execute(['id' => $id]);

    echo "taak verwijderd";
}
catch(PDOException $e)
{
    echo "Error: " . $e->getMessage();
}
$conn = null;