<?php
	include_once 'header.php';
	
	$dbname = "todolist";
	$servername = "localhost";
	$username = "Gerard";
	$password = "GerardGerard";

	$list1 = "lists (name)";
	$task1 = "tasks (name, description)";

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