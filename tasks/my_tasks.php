<?php include("../assets/_header_in.php"); ?>
<?php include("../assets/_header_tasks.php"); ?>
<ul>
<?php
	require_once("../classes/task.php");
	$all_tasks = Task::getMyTasks($_SESSION['login_user']);
	echo "<table>";
	for($i=0;$i<count($all_tasks);$i++)
	{
		echo("<tr><td>".($i+1)."</td><td><a href='index.php?id_task=".$all_tasks[$i]["id"]."'>".$all_tasks[$i]["name"]."</a></td></tr>");
	} 
	echo "</table>";
?>
</ul>
<a href="create_task.php">Create a task</a>
<?php include("../assets/_footer.php"); ?>