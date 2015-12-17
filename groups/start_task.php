<?php include("../assets/_header_in.php"); ?>
<?php include("../assets/_header_groups.php"); ?>
<?php 
	$id_group = htmlspecialchars($_GET["id_group"]);
	require_once("../classes/group.php");
	$mygroup = Group:: getGroupById($id_group);
	$users_of_group = Group::getUsersByIdGroup($id_group);
	echo("<a href='index.php?id_group=".$id_group."'>".$mygroup["g_name"]."</a>");
	echo "<br>";
	echo("Count of starting tasks:".Group::getCountStartTaskByIdGroup($id_group));
	echo "<br>";
	
	echo "<table>";
	$start_tasks = Group::getStartTasksByIdGroup($id_group);
	for($i=0;$i<count($start_tasks);$i++)
	{
		echo "<tr><td>".($i+1)."</td><td><a href='../tasks/index.php?id_task=".$start_tasks[$i]["id_task"]."'>".$start_tasks[$i]["task_name"]."</a></td></tr>";
	}
	echo "</table>";
?>
<?php include("../assets/_footer.php"); ?>