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
	echo '<div style="border:3px solid" class="w3-col s2 w3-border-black"><div onclick=show(' . $row->id . ')>' . $row->naam . '</div>';

	//selecteert elke taak die bij de lijst hoort die momenteel door de loop gaat
	$sql = 'SELECT * FROM taken WHERE lijstid = ? ORDER BY ' . $orderType . ' ' . $order;
	$tstmt = $pdo->prepare($sql);
	$tstmt->execute([$lijstid]);
	$taken = $tstmt->fetchALL();

	foreach ($taken as $taken) {
		echo '<div onclick=showTask(' . $taken->id . ') class="status' . $taken->status .'">' . $taken->naam . '</div>';
	}
	echo '<div onclick=createTask(' . $row->id . ')>Voeg een taak toe</div>';
	echo "</div>";
}
echo '<div onclick=createList()>Voeg een lijst toe</div>';
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

		<div id="id01" class="w3-modal">
		 <div class="w3-modal-content w3-card-4 w3-animate-zoom">
		  <header class="w3-container w3-blue"> 
		   <span onclick="document.getElementById('id01').style.display='none'" 
		   class="w3-button w3-blue w3-xlarge w3-display-topright">&times;</span>
		   <h2>Header</h2>
		  </header>

		  <div class="w3-bar w3-border-bottom">
		   <button id="addListButton" class="tablink w3-bar-item w3-button" onclick="openList(event, 'Add')">Add the list</button>
		   <button id="updateListButton" class="tablink w3-bar-item w3-button" onclick="openList(event, 'update')">update the list</button>
		   <button id="deleteListButton" class="tablink w3-bar-item w3-button" onclick="openList(event, 'delete')">delete the list</button>
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
				<input id="updateList" type="hidden" name = "id" />
				<input type="submit">
			</form>
		  </div>

		  <div id="delete" class="w3-container city">
		   <h1>verwijder de lijst</h1>
		   <form action="list/deleteList.php" method="post" class="w3-col s3">
				<input id="deleteList" type="hidden" name = "id" /><br>
				<input type="submit">
			</form>
		  </div>

		  <div class="w3-container w3-light-grey w3-padding">
		   <button class="w3-button w3-right w3-white w3-border" 
		   onclick="document.getElementById('id01').style.display='none'">Close</button>
		  </div>
		 </div>
		</div>

		<div id="id02" class="w3-modal">
		 <div class="w3-modal-content w3-card-4 w3-animate-zoom">
		  <header class="w3-container w3-blue"> 
		   <span onclick="document.getElementById('id02').style.display='none'" 
		   class="w3-button w3-blue w3-xlarge w3-display-topright">&times;</span>
		   <h2>Header</h2>
		  </header>

		  <div class="w3-bar w3-border-bottom">
		   <button id="addTaskButton" class="tablink w3-bar-item w3-button" onclick="openTask(event, 'addTask')">Voeg een taak toe</button>
		   <button id="updateTaskButton" class="tablink w3-bar-item w3-button" onclick="openTask(event, 'updateTask')">update een taak</button>
		   <button id="deleteTaskButton" class="tablink w3-bar-item w3-button" onclick="openTask(event, 'deleteTask')">Verwijder een taak</button>
		  </div>

		  <div id="addTask" class="w3-container city">
		   <h1>voeg een taak toe</h1>
		  <form action="task/taskCreate.php" method="post" class="w3-col s3">
				naam: <input type="text" name="naam"><br>
				duur: <input type="number" min="1" name="duur"><br>
				status: <input type="number" min="1" max="5" name="status"><br>
				<input id="addTaskInput" type="hidden" name = "lijstid" />
				beschrijving: <input type="text" name="beschrijving"><br>
				<input type="submit">
			</form>
		  </div>

		  <div id="updateTask" class="w3-container city">
		   <h1>Update de taak</h1>
		   <form action="task/updateTask.php" method="post" class="w3-col s3">
				naam: <input type="text" name="naam"><br>
				duur: <input type="number" min="1" name="duur"><br>
				status: <input type="number" min="1" max="5" name="status"><br>
				beschrijving: <input type="text" name="beschrijving"><br>
				<input id="updateTaskInput" type="hidden" name = "id" /><br>
				<input type="submit">
			</form>
		  </div>

		  <div id="deleteTask" class="w3-container city">
		   <h1>verwijder de taak</h1>
		   <form action="task/deleteTask.php" method="post" class="w3-col s3">
				<input id="deleteTaskInput" type="hidden" name = "id" />
				<input type="submit">
			</form>
		  </div>

		  <div class="w3-container w3-light-grey w3-padding">
		   <button class="w3-button w3-right w3-white w3-border" 
		   onclick="document.getElementById('id02').style.display='none'">Close</button>
		  </div>
		 </div>
		</div>
		<script>
		document.getElementsByClassName("tablink")[0].click();

		function openList(evt, cityName) {
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

		function openTask(evt, cityName) {
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

		function show(id) {
			document.getElementById("id01").style.display="block";
			document.getElementById("updateList").value=id;
			document.getElementById("deleteList").value=id;
			noDisplay4u();
			document.getElementById("updateListButton").style.display="block";
			document.getElementById("deleteListButton").style.display="block";
		}

		function showTask(id) {
			document.getElementById("id02").style.display="block";
			document.getElementById("updateTaskInput").value=id;
			document.getElementById("deleteTaskInput").value=id;
			noDisplay4u();
			document.getElementById("updateTaskButton").style.display="block";
			document.getElementById("deleteTaskButton").style.display="block";
		}

		function createTask(lijstid) {
			document.getElementById("id02").style.display="block";
			noDisplay4u();
			document.getElementById("addTaskInput").value=lijstid;
			document.getElementById("addTaskButton").style.display="block";
		}

		function createList(id) {
			document.getElementById("id01").style.display="block";
			noDisplay4u();
			document.getElementById("addListButton").style.display="block";
		}

		function noDisplay4u() {
			document.getElementById("addListButton").style.display="none";
			document.getElementById("updateListButton").style.display="none";
			document.getElementById("deleteListButton").style.display="none";

			document.getElementById("addTaskButton").style.display="none";
			document.getElementById("updateTaskButton").style.display="none";
			document.getElementById("deleteTaskButton").style.display="none";
		}
		</script>
	</body>
</html>

<!--
met een druk op een knop naast elke taak / lijst komt een form tevoorschijn.

op taak / lijst klikken om aan te passen.
 -->