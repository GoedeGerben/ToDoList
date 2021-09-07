<?php
try {
	include_once 'connect.php';

	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	

}
catch(PDOException $e)
{
    echo "Error: " . $e->getMessage();
}
$conn = null;
