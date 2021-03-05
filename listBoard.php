<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="style.css">
	<title>ToDo List</title>
</head>
<body>
	<?php

	$list1 = "List one";
	$task1 = "task one";
	?>
	<header>ToDo list</header>

	<div class="list">
		<form>
			<input type="text" id="list1" name="list1" maxlength="25" value="<?php echo $list1 ?>">
			<input type="text" id="task1" name="task1" maxlength="25" value="<?php echo $task1 ?>">
		</form>

		<button>add button</button><!-- adds a task -->
		<button>remove button</button><!-- removes the list -->
	</div>

	
	<button>add button</button><!-- adds a list -->

</body>
</html>