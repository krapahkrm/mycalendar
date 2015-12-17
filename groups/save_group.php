<?php
	session_start();
	require_once('../classes/group.php');
	header('Content-type: text/html; charset=utf-8');	
    if (isset($_POST['name'])) { 
        $name=$_POST['name']; 
        if ($name =='') { 
            unset($name);
        } 
    }

    if (empty($name)) 
    {
        exit ("You entered no all info!");
    }


    $name = stripslashes($name);
    $name = htmlspecialchars($name);
    $name = trim($name);


    if (Group::checkGroupByName($name))
    {
        exit ("Name is wrong.");
    }
    else {
	    	$id = Group::addNewGroup($name,$_SESSION['login_user']);
            header("Location: index.php?id_group=".$id);
            exit;
    }
?>