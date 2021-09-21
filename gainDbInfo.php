<?php
include_once 'connect.php';

if ($_GET['order'] == 'DESC') {
	$order = 'DESC';
	$orderButton = 'ASC';
} else {
	$order = 'ASC';
	$orderButton = 'DESC';
}
	
if ($_GET['orderType'] == 'duur') {
	$orderType = 'duur';
	$orderTypeButton = 'status';
} else {
	$orderType = 'status';
	$orderTypeButton = 'duur';
}

//begin van alle lijsten + taken op de pagina zetten
//selecteert alles uit 'lijsten' en zet het op de pagina
$stmt = $pdo->query('SELECT * FROM lijsten');
echo '<div class="w3-row">';
while ($row = $stmt->fetch()) {
	$lijstid = $row->id;
	echo '<div style="border:3px solid" class="w3-col s2 w3-border-black"><div id="lijst' . $row->id . '" onclick=show(' . $row->id . ')>' . $row->naam . '</div>';

	//selecteert elke taak die bij de lijst hoort die momenteel door de loop gaat
	$sql = 'SELECT * FROM taken WHERE lijstid = ? ORDER BY ' . $orderType . ' ' . $order;
	$tstmt = $pdo->prepare($sql);
	$tstmt->execute([$lijstid]);
	$taken = $tstmt->fetchALL();

	if ($_GET['status'] >= 1) {
		foreach ($taken as $taken) if ($_GET['status'] == $taken->status) {
			echo '<div onclick=showTask(' . $taken->id . ') id="' . $taken->id . '" class="tasks status' . $taken->status .'">' . $taken->naam . '</div><div class="description">Deze taak duurt ' . $taken->duur . ' minuten. ' . $taken->beschrijving . '</div>';
		}
	}else {
		foreach ($taken as $taken) {
			echo '<div onclick=showTask(' . $taken->id . ') id="' . $taken->id . '" class="tasks status' . $taken->status .'">' . $taken->naam . '</div><div class="description">Deze taak duurt ' . $taken->duur . ' minuten. ' . $taken->beschrijving . '</div>';
		}
	}
	echo '<div onclick=createTask(' . $row->id . ')>Voeg een taak toe</div></div>';
}
echo '<div onclick=createList()>Voeg een lijst toe</div></div>';