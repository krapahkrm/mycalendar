<?php include("../assets/_header_in.php"); ?>
<?php include("../assets/_header_tasks.php"); ?>
<?php 
	require_once("../classes/group.php");
	$id_group = htmlspecialchars($_GET["id_group"]);
	$name_group = Group::getGroupById($id_group);
	$name_group = $name_group['g_name'];
?>
        <form action="save_task_for_me.php" method="post">
            <p>
                <label>Name:<br></label>
                <input name="name" type="text" size="50" maxlength="50">
            </p>
            <p>
                <label>Description:<br></label>
                <textarea name="desc" maxlength="500" type="text"></textarea>
            </p>
             <p>
                <label>Time start:<br></label>
                <input type="datetime-local" name="start"/>
            </p>
            <p>
                <label>Time end:<br></label>
                <input type="datetime-local" name="end"/>
            </p>
 
            <p>
                <input type="submit" name="submit" value="Create"> 
            </p>
        </form>
<?php include("../assets/_footer.php"); ?>