<?php include("../assets/_header_in.php"); ?>
<?php include("../assets/_header_groups.php"); ?>
<?php 
	$id_group = htmlspecialchars($_GET["id_group"]);
	require_once("../classes/group.php");
	$mygroup = Group:: getGroupById($id_group);
	$users_of_group = Group::getUsersByIdGroup($id_group);
	echo("Name: ".$mygroup["g_name"]);
	echo "<br>";
	echo("Creator: ".$mygroup["u_name"]);
	echo "<br>";
	echo("Count of users: ".count($users_of_group));
	echo "<br>";
	echo "<table>";
	for($i=0;$i<count($users_of_group);$i++)
	{
		echo("<tr><td>".$i."</td><td>".$users_of_group[$i]["name"]."</td></tr>");
	}
	echo "</table>";
	echo("Count of all tasks: ".Group::getCountTaskByIdGroup($id_group));
	echo "<br>";
	echo("<a href='end_task.php?id_group=".$id_group."'>Finished tasks: </a>".Group::getCountEndTaskByIdGroup($id_group));
	echo "<br>";
	echo("<a href='start_task.php?id_group=".$id_group."'>Started tasks: </a>".Group::getCountStartTaskByIdGroup($id_group));

	if(Group::checkCreator($id_group, $_SESSION['login_user'])){
		echo "<br>";
		echo("<a href='../tasks/create_task_for_group.php?id_group=".$id_group."'>Create a task</a>");
	}
	else if(!Group::checkGroupForUser($id_group, $_SESSION['login_user'])){
		echo "<br>";
		echo("<a href='add_user_to_group.php?id_group=".$id_group."'>Sign up in this group</a>");
	}
	else {
		echo "<br>";
		echo("<a href='delete_user_to_group.php?id_group=".$id_group."'>Sign out group</a>");
	}
?>
<?php include("../assets/_footer.php"); ?>