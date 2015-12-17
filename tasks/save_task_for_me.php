<?php
	session_start();
	require_once('../classes/task.php');
	header('Content-type: text/html; charset=utf-8');	
    if (isset($_POST['name'])) { 
        $name=$_POST['name']; 
        if ($name =='') { 
            unset($name);
        } 
    }
    if (isset($_POST['desc'])) { 
        $desc=$_POST['desc']; 
        if ($desc =='') { 
            unset($desc);
        } 
    }
    if (isset($_POST['start'])) { 
        $start=$_POST['start']; 
        if ($start=='') { 
            unset($start);
        } 
    }
    if (isset($_POST['end'])) { 
        $end=$_POST['end']; 
        if ($end =='') { 
            unset($end);
        } 
    }
    if (empty($name) or empty($desc) or empty($end) or empty($start)) 
    {
        exit ("You entered no all info!");
    }

    $name = stripslashes($name);
    $name = htmlspecialchars($name);
    $name = trim($name);
    $desc = stripslashes($desc);
    $desc = htmlspecialchars($desc);
    $desc = trim($desc);
    $end = stripslashes($end);
    $end = htmlspecialchars($end);
    $end = trim($end);
    $start = stripslashes($start);
    $start = htmlspecialchars($start);
    $start = trim($start);
    
    $id_task = Task::addNewTaskForMe($name, $desc, $start, $end, $_SESSION['login_user']);

    header("Location: index.php?id_task=".$id_task);
    exit();
?>