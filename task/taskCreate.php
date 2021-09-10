<?php
try {
	include_once '../connect.php';
    
// set the PDO error mode to exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// prepare sql and bind parameters
    $stmt = $pdo->prepare("INSERT INTO taken (naam, duur, status, lijstid, beschrijving) 
VALUES (:naam, :duur, :status, :lijstid, :beschrijving)");
    $stmt->bindParam(':naam', $naam);
    $stmt->bindParam(':duur', $duur);
    $stmt->bindParam(':status', $status);
    $stmt->bindParam(':lijstid', $lijstid);
    $stmt->bindParam(':beschrijving', $beschrijving);

// insert a row
    $naam = $_POST["naam"];
    $duur = $_POST["duur"];
    $status = $_POST["status"];
    $lijstid = $_POST["lijstid"];
    $beschrijving = $_POST["beschrijving"];
    $stmt->execute();


    header("Location: ../index.php");
}
catch(PDOException $e)
{
    echo "Error: " . $e->getMessage();
}
$conn = null;