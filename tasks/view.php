<?php include("../assets/_header_in.php"); ?>
<?php include("../assets/_header_tasks.php"); ?>
<?php
	require_once('../classes/task.php');
	$inProcess = Task::getInProcessTasks($_SESSION['login_user']);
	$cancelled= Task::getcancelledTasks($_SESSION['login_user']);
	$finished = Task::getfinishedTasks($_SESSION['login_user']);

	echo "<div>";
	echo "<a href=''>Free tasks</a>";
	echo "<br>";
	echo "<br>";
	echo "My tasks";
	echo "<br>";
	echo "<br>";
	echo "In process";
	echo "<br>";
	echo "<br>";
	echo "<table>";
	for($i=0;$i<count($inProcess);$i++)
	{
		echo ("<tr><td>".($i+1)."</td><td><a href='index.php?id_task=".$inProcess[$i]['id_task']."'>".$inProcess[$i]['name_task']."</a></td><tr/>");
	}
	echo "</table>";
	echo "<br>";
	echo "Cancelled";
	echo "<br>";
	echo "<table>";
	for($i=0;$i<count($cancelled);$i++)
	{
		echo ("<tr><td>".($i+1)."</td><td><a href='index.php?id_task=".$cancelled[$i]['id_task']."'>".$cancelled[$i]['name_task']."</a></td><tr/>");
	}
	echo "</table>";
	echo "Finished:";
	echo "<table>";
	for($i=0;$i<count($finished);$i++)
	{
		echo ("<tr><td>".($i+1)."</td><td><a href='index.php?id_task=".$finished[$i]['id_task']."'>".$finished[$i]['name_task']."</a></td><tr/>");
	}
	echo "</table>";
	echo "<br>";
	echo "</div>";




	$inProcess = Task::getInProcessTasksForGroup($_SESSION['login_user']);
	$cancelled= Task::getcancelledTasksForGroup($_SESSION['login_user']);
	$finished = Task::getfinishedTasks($_SESSION['login_user']);
	echo "<div>";
	echo "<a href=''>Free tasks (group)</a>";
	echo "<br>";
	echo "My tasks (for group)";
	echo "<br>";

	echo "In process";
	echo "<br>";
	echo "<table>";
	for($i=0;$i<count($inProcess);$i++)
	{
		echo ("<tr><td>".($i+1)."</td><td><a href='index.php?id_task=".$inProcess[$i]['id_task']."'>".$inProcess[$i]['name_task']."</a></td><tr/>");
	}
	echo "</table>";
	echo "Cancelled";
	echo "<br>";
	echo "<table>";
	for($i=0;$i<count($cancelled);$i++)
	{
		echo ("<tr><td>".($i+1)."</td><td><a href='index.php?id_task=".$cancelled[$i]['id_task']."'>".$cancelled[$i]['name_task']."</a></td><tr/>");
	}
	echo "</table>";
	echo "Finished:";
	echo "<table>";
	for($i=0;$i<count($finished);$i++)
	{
		echo ("<tr><td>".($i+1)."</td><td><a href='index.php?id_task=".$finished[$i]['id_task']."'>".$finished[$i]['name_task']."</a></td><tr/>");
	}
	echo "</table>";
	echo "<br>";
	echo "</div>";
?>
<?php include("../assets/_footer.php"); ?>