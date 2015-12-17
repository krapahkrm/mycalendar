<?php include("../assets/_header_in2.php"); ?>
<?php include("../assets/_header_tasks.php"); ?>
<?php 
	$id_task = htmlspecialchars($_GET["id_task"]);
	require_once("../classes/task.php");
	$mytask = Task:: getTaskById($id_task);
	$users_of_task = Task::getUsersById($id_task);
	echo("Name: ".$mytask["task_name"]);
	echo "<br>";
	echo("Description: ".$mytask["task_desc"]);
	echo "<br>";
	echo("Time start: ".$mytask["task_start"]);
	echo "<br>";
	echo("Time end: <span id='time_end'>".$mytask["task_end"]."</span>");
	echo "<br>";
	$status=null;
	if($mytask["task_start"]>date("Y-m-d H:i:s")){
		$status="<p class=red>Not begin</p>";
	}
	else if($mytask["task_end"]>date("Y-m-d H:i:s")){
		$status="<p class=green>In proccess</p>";}
		else{
			$status="<p class=yellow>Done</p>";
		}
	
	echo("Status: ".$status);
	echo "<br>";
	echo("Creator: ".$mytask["creator"]);
	echo "<br>";
	echo "<div id='countdown-3'></div>";
	echo "<br>";
	echo "<br>";
	echo "<br>";
	echo "<br>";
	echo("Count people who work on this task: ".count(users_of_task));
	echo "<br>";
	if(!Task::isMyTask($id_task, $_SESSION['login_user'])) {
		echo "<a href='add_task_to_me.php?id_task=".$id_task."'>Work on this task</a>";
		echo "<br>";
	}
	if(!Task::isCancel($id_task,$_SESSION['login_user'])){
		echo "<a href='cancel.php?id_task=".$id_task."'>Cancel?</a>";
	}

	echo "<table>";
	for($i=0;$i<count(users_of_task);$i++)
	{
		echo("<tr><td>".($i+1)."</td><td><a href='#'>".$users_of_task[$i]["name"]."</a></td></tr>");
	}
	echo "</table>";
?>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script>window.jQuery || document.write('<script src="jquery-1.9.1.min.js"><\/script>')</script>
<script src="../assets/css/jquery.time-to.js"></script>
<script>
window.onload = function () { 
	var value = new Date(document.getElementById("time_end").textContent);
	var today = new Date();

function integerDivision(x, y){
    return (x-x%y)/y
}
	var days = integerDivision(value.getTime()-today.getTime(), 100*60*60*24);
	var hours = integerDivision(value.getTime()-today.getTime()-days*100*60*60*24, 100*60*60);
	var minutes = integerDivision(value.getTime()-today.getTime()-days*100*60*60*24 - hours*100*60*60, 100*60);

	var date = getRelativeDate(days,hours,minutes);

$('#countdown-3').timeTo({
            timeTo: date,
            displayDays: 2,
            theme: "black",
            displayCaptions: true,
            fontSize: 48,
            captionSize: 14
        });

function getRelativeDate(days, hours, minutes){
            var date = new Date((new Date()).getTime() + 60000 /* milisec */ * 60 /* minutes */ * 24 /* hours */ * days /* days */);

            date.setHours(hours || 0);
            date.setMinutes(minutes || 0);
            date.setSeconds(0);

            return date;
        }
}


</script>
<?php include("../assets/_footer.php"); ?>

