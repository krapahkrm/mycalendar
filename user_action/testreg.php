<?php
    //require_once('classes/session.php');
    session_start();
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

    if (empty($login) or empty($password)) 
    {
        exit ("You entered no all info!");
    }

    $login = stripslashes($login);
    $login = htmlspecialchars($login);
    $password = stripslashes($password);
    $password = htmlspecialchars($password);
    $login = trim($login);
    $password = trim($password);

    require_once('../classes/user.php');
    if (User::check_user_by_login($login))
    {
        if (User::check_user_by_password($login, $password))
        {
            $_SESSION['login_user']=$login;
            $_SESSION['hash_user'] = User::getHash($login);
            header("Location: ../index.php");
            exit;
        }
        else
        {
            exit ("Password wrong.");
        }
    
    }
    else {
        exit ("Неверный логин.");
    }
?>