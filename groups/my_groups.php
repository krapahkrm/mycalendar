<?php include("../assets/_header_in.php"); ?>
<?php include("../assets/_header_groups.php"); ?>
<ul>
<?php
	require_once("../classes/group.php");
	$all_groups = Group::getGroupsByUserLogin($_SESSION['login_user']);
	for($i=0;$i<count($all_groups);$i++)
	{
		echo("<li><a href='index.php?id_group=".$all_groups[$i]["id"]."'>".$all_groups[$i]["name"]."</a></li>");
	} 
?>
</ul>
<a href="create_group.php">Create a group</a>
<?php include("../assets/_footer.php"); ?>