<?php include("../classes/session.php"); ?>
<?php 
	$id_task = htmlspecialchars($_GET["id_task"]);
	require_once("../classes/task.php");
	Task::addTaskToMe($id_task, $_SESSION['login_user']);
	header("Location: index.php?id_task=".$id_task);
?>