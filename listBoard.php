<?php
	include_once 'header.php';
	
	
	$host = 'localhost';
	$user = 'Gerard';
	$password = 'GerardGerard';
	$dbname = 'todolist';

	$dsn = 'mysql:host='. $host .';dbname='. $dbname;

	$pdo = new PDO($dsn, $user, $password);

	$stmt = $pdo->query('SELECT * FROM lijsten');

	while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
	echo $row['naam'] . '<br>';
}

	$list1 = "lijsten (naam)";
	$task1 = "taken (naam, beschrijving, belangrijk)";

	$newListName = "testList"
	?>
	<header>ToDo list</header>

	<div class="list">
		<form>
			<input type="text" id="list1" name="list1" maxlength="25" value="<?php echo $list1 ?>">
			<input type="text" id="task1" name="task1" maxlength="25" value="<?php echo $task1 ?>">
		</form>

		<button onclick="<?php include_once 'listCreate.php'; ?>">add button</button><!-- adds a task -->
		<button>remove button</button><!-- removes the list -->
	</div>

	
	<button>add button</button><!-- adds a list -->

</body>
</html>