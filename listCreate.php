<?php
try {
	include_once 'connect.php';
    
// set the PDO error mode to exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// prepare sql and bind parameters
    $stmt = $pdo->prepare("INSERT INTO lijsten (naam, kleur) 
VALUES (:naam, :kleur)");
    $stmt->bindParam(':naam', $naam);
    $stmt->bindParam(':kleur', $kleur);

// insert a row
    $naam = $_POST["naam"];
    $kleur = $_POST["kleur"];
    $stmt->execute();

    echo "New records created successfully";
}
catch(PDOException $e)
{
    echo "Error: " . $e->getMessage();
}
$conn = null;