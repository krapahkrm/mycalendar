<?php
	require_once('../classes/session.php');
	require_once('../classes/user.php');
	header('Content-type: text/html; charset=utf-8');	

    if (isset($_POST['password'])) { 
        $password=$_POST['password']; 
        if ($password =='') { 
            unset($password);
        } 
    }
    if (isset($_POST['name'])) { 
        $name=$_POST['name']; 
        if ($name =='') { 
            unset($name);
        } 
    }

    if (empty($password) or empty($name)) 
    {
        exit ("You entered no all info!");
    }

    $name = stripslashes($name);
    $name = htmlspecialchars($name);
    $password = stripslashes($password);
    $password = htmlspecialchars($password);
    $name = trim($name);
    $password = trim($password);

    if (User::update_user($_SESSION['login_user'],$_SESSION['hash_user'],$name,$password))
    {
        $_SESSION['hash_user'] = User::getHash($login);
        header("Location: ../index.php");
    }
    else {
        exit("Saving failed.");
    }
?>