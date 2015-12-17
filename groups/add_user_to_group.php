<?php require_once("../classes/session.php"); 
	$id_group = htmlspecialchars($_GET["id_group"]);
	include("../classes/group.php");
	Group::addNewUser($id_group, $_SESSION['login_user']);
	header("Location: ../groups/view.php");
	exit();
?>