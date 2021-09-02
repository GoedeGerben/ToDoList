<?php
$host = 'localhost';
$user = 'Gerard';
$password = 'GerardGerard';
$dbname = 'todolist';

$dsn = 'mysql:host='. $host .';dbname='. $dbname;

$pdo = new PDO($dsn, $user, $password);
$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);

$stmt = $pdo->query('SELECT * FROM lijsten');

while ($row = $stmt->fetch()) {
echo $row->naam . '<br>';
}

//pakt alleen degene met de kleur geel op een veilige manier
$kleur = 'geel';

$sql = 'SELECT * FROM lijsten WHERE kleur = ?';
$stmt = $pdo->prepare($sql);
$stmt->execute([$kleur]);
$lijsten = $stmt->fetchALL();

foreach ($lijsten as $lijsten) {
	echo $lijsten->naam . '<br>';
}
//einde van de data oproep en zetten op de pagina









?>