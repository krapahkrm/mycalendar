<?php 
	session_start();

	unset($_SESSION["login_user"]); 
	unset($_SESSION["hash_user"]);
	header("Location: ../index.php");
?>