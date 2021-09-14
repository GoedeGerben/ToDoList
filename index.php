<?php
include_once 'header.php';
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
	echo '<div onclick=document.getElementById("id01").style.display="block" style="border:3px solid" class="w3-col s2 w3-border-black">' . $row->naam;

	//selecteert elke taak die bij de lijst hoort die momenteel door de loop gaat
	$sql = 'SELECT * FROM taken WHERE lijstid = ? ORDER BY ' . $orderType . ' ' . $order;
	$tstmt = $pdo->prepare($sql);
	$tstmt->execute([$lijstid]);
	$taken = $tstmt->fetchALL();

	foreach ($taken as $taken) {
		echo '<div class="status' . $taken->status .'">' . $taken->naam . '</div>';
	}
	echo "</div>";
}
echo '</div';
//eind van alle lijsten + taken op de pagina zetten
?>
	<body>
		<a href="index.php?order=<?php
		echo $orderButton . '&orderType=' . $orderType;
		?>">sorteer op <?php
		echo $orderButton;
		?></a>
		<br>
		<a href="index.php?orderType=<?php
		echo $orderTypeButton . '&order=' . $order;
		?>">sorteer op <?php
		echo $orderTypeButton;
		?></a>

		<div class="w3-row">
			<form action="task/taskCreate.php" method="post" class="w3-col s3">
				<h2>voeg een taak toe</h2>
				naam: <input type="text" name="naam"><br>
				duur: <input type="number" min="1" name="duur"><br>
				status: <input type="number" min="1" max="5" name="status"><br>
				lijst id: <input type="number" name="lijstid"><br>
				beschrijving: <input type="text" name="beschrijving"><br>
				<input type="submit">
			</form>

			<form action="task/updateTask.php" method="post" class="w3-col s3">
				<h2>update een taak</h2>
				naam: <input type="text" name="naam"><br>
				duur: <input type="number" min="1" name="duur"><br>
				status: <input type="number" min="1" max="5" name="status"><br>
				beschrijving: <input type="text" name="beschrijving"><br>
				id: <input type="number" name="id"><br>
				<input type="submit">
			</form>

			<form action="task/deleteTask.php" method="post" class="w3-col s3">
				<h2>verwijder een taak</h2>
				id: <input type="number" name="id"><br>
				<input type="submit">
			</form>
		</div>

		<div id="id01" class="w3-modal">
		 <div class="w3-modal-content w3-card-4 w3-animate-zoom">
		  <header class="w3-container w3-blue"> 
		   <span onclick="document.getElementById('id01').style.display='none'" 
		   class="w3-button w3-blue w3-xlarge w3-display-topright">&times;</span>
		   <h2>Header</h2>
		  </header>

		  <div class="w3-bar w3-border-bottom">
		   <button class="tablink w3-bar-item w3-button" onclick="openCity(event, 'Add')">Add the list</button>
		   <button class="tablink w3-bar-item w3-button" onclick="openCity(event, 'update')">update the list</button>
		   <button class="tablink w3-bar-item w3-button" onclick="openCity(event, 'delete')">delete the list</button>
		  </div>

		  <div id="Add" class="w3-container city">
		   <h1>voeg een lijst toe</h1>
		  <form action="list/listCreate.php" method="post" class="w3-col s3">
				naam: <input type="text" name="naam"><br>
				kleur: <input type="text" name="kleur"><br>
				<input type="submit">
			</form>
		  </div>

		  <div id="update" class="w3-container city">
		   <h1>Update de lijst</h1>
		   <form action="list/updateList.php" method="post" class="w3-col s3">
				naam: <input type="text" name="naam"><br>
				id: <input type="number" min="1" name="id"><br>
				<input type="submit">
			</form>
		  </div>

		  <div id="delete" class="w3-container city">
		   <h1>verwijder de lijst</h1>
		   <form action="list/deleteList.php" method="post" class="w3-col s3">
				id: <input type="number" min="1" name="id"><br>
				<input type="submit">
			</form>
		  </div>

		  <div class="w3-container w3-light-grey w3-padding">
		   <button class="w3-button w3-right w3-white w3-border" 
		   onclick="document.getElementById('id01').style.display='none'">Close</button>
		  </div>
		 </div>
		</div>
		<script>
		document.getElementsByClassName("tablink")[0].click();

		function openCity(evt, cityName) {
		  var i, x, tablinks;
		  x = document.getElementsByClassName("city");
		  for (i = 0; i < x.length; i++) {
		    x[i].style.display = "none";
		  }
		  tablinks = document.getElementsByClassName("tablink");
		  for (i = 0; i < x.length; i++) {
		    tablinks[i].classList.remove("w3-light-grey");
		  }
		  document.getElementById(cityName).style.display = "block";
		  evt.currentTarget.classList.add("w3-light-grey");
		}
		</script>
	</body>
</html>

<!--
met een druk op een knop naast elke taak / lijst komt een form tevoorschijn.

taken van lijst verwijderen

op taak / lijst klikken om aan te passen.
 -->