<?php
$servername = "localhost";
$username = "Gerard";
$password = "GerardGerard";
$dbname = "todolist";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username,
        $password);
// set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// prepare sql and bind parameters
    $stmt = $conn->prepare("INSERT INTO taken (naam, belangrijk, lijstid, beschrijving) 
VALUES (:naam, :belangrijk, :lijstid, :beschrijving)");
    $stmt->bindParam(':naam', $firstname);
    $stmt->bindParam(':belangrijk', $lastname);
    $stmt->bindParam(':lijstid', $email);
    $stmt->bindParam(':beschrijving', $bemail);

// insert a row
    $firstname = $_POST["naam"];
    $lastname = $_POST["belangrijk"];
    $email = $_POST["lijstid"];
    $bemail = $_POST["beschrijving"];
    $stmt->execute();


    echo "New records created successfully";
}
catch(PDOException $e)
{
    echo "Error: " . $e->getMessage();
}
$conn = null;