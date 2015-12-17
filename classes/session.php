<?php
	session_start();

	if(isset($_SESSION['login_user']) && isset($_SESSION['hash_user'])){
		require_once('user.php');
    	if(!User::check_user($_SESSION['login_user'], $_SESSION['hash_user'])){
			header("Location: ../user_action/login.php");
			exit;
		}
		else {

		}
	} 
	else {
		header("Location: ../user_action/login.php");
		exit;
	}
?>