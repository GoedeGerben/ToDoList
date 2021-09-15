<?php
include_once 'header.php';
include_once 'gainDbInfo.php'
?>
<body>
	<script src="scripts.js"></script>
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
	<br>

	<form action="index.php" method="get" class="w3-col s3">
		filter op status: <input type="number" min="0" max="5" name="status"><br>
		<input type="submit">
	</form>

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
			naam: <input type="text" min="1" max="25" name="naam"><br>
			kleur: <input type="text" min="1" max="25" name="kleur"><br>
			<input type="submit">
		</form>
	  </div>

	  <div id="update" class="w3-container city">
	   <h1>Update de lijst</h1>
	   <form action="list/updateList.php" method="post" class="w3-col s3">
			naam: <input type="text" min="1" max="25" name="naam"><br>
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
	   <button id="addTaskButton" class="tablink w3-bar-item w3-button" onclick="openList(event, 'addTask')">Voeg een taak toe</button>
	   <button id="updateTaskButton" class="tablink w3-bar-item w3-button" onclick="openList(event, 'updateTask')">update een taak</button>
	   <button id="deleteTaskButton" class="tablink w3-bar-item w3-button" onclick="openList(event, 'deleteTask')">Verwijder een taak</button>
	  </div>

	  <div id="addTask" class="w3-container city">
	   <h1>voeg een taak toe</h1>
	  <form action="task/taskCreate.php" method="post" class="w3-col s3">
			naam: <input type="text" min="1" maxLength="25" name="naam"><br>
			duur: <input type="number" min="1" maxLength="25" name="duur"><br>
			status: <input type="number" min="1" max="5" name="status"><br>
			<input id="addTaskInput" type="hidden" name = "lijstid" />
			beschrijving: <input type="text" min="1" name="beschrijving"><br>
			<input type="submit">
		</form>
	  </div>

	  <div id="updateTask" class="w3-container city">
	   <h1>Update de taak</h1>
	   <form action="task/updateTask.php" method="post" class="w3-col s3">
			naam: <input type="text" min="1" maxLength="25" name="naam"><br>
			duur: <input type="number" min="1" maxLength="25" name="duur"><br>
			status: <input type="number" min="1" max="5" name="status"><br>
			beschrijving: <input type="text" min="1" name="beschrijving"><br>
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
	</body>
	</html>

	<!--
	php functions gebruiken
	laat testen
	filteren
	-->