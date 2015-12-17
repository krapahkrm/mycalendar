<?php
	session_start();
	require_once('../classes/user.php');
	header('Content-type: text/html; charset=utf-8');	
	if (isset($_POST['login'])) { 
        $login = $_POST['login']; 
        if ($login == '') { 
            unset($login);
        } 
    } 
    if (isset($_POST['password'])) { 
        $password=$_POST['password']; 
        if ($password =='') { 
            unset($password);
        } 
    }
    if (isset($_POST['email'])) { 
        $email=$_POST['email']; 
        if ($email =='') { 
            unset($email);
        } 
    }
    if (isset($_POST['name'])) { 
        $name=$_POST['name']; 
        if ($name =='') { 
            unset($name);
        } 
    }

    if (empty($login) or empty($password) or empty($email) or empty($name)) 
    {
        exit ("You entered no all info!");
    }

    $login = stripslashes($login);
    $login = htmlspecialchars($login);
    $name = stripslashes($name);
    $name = htmlspecialchars($name);
    $email = stripslashes($email);
    $email = htmlspecialchars($email);
    $password = stripslashes($password);
    $password = htmlspecialchars($password);
    $login = trim($login);
    $email= trim($email);
    $name = trim($name);
    $password = trim($password);

    if (User::check_user_by_login($login))
    {
        exit ("Login is used somebody.");
    }
    else {
        if (User::check_user_by_email($email))
	    {
	        exit ("Email is used somebody.");
	    }
	    else{
	    	User::add_new_user($login, $password, $name, $email);
	    	$_SESSION['login_user']=$login;
            $_SESSION['hash_user'] = User::getHash($login);
            header("Location: ../index.php");
            exit;
	    }
    }
?>