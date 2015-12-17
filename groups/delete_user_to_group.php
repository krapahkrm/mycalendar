<?php require_once("../classes/session.php"); 
	$id_group = htmlspecialchars($_GET["id_group"]);
	include("../classes/group.php");
	Group::deleteUser($id_group, $_SESSION['login_user']);
	header("Location: ../groups/view.php");
	exit();
?>