<?php include("../assets/_header_in.php"); ?>
<?php include("../assets/_header_groups.php"); ?>
<h2>Creating a group</h2>
        <form action="save_group.php" method="post">
            <p>
                <label>Name of group<br></label>
                <input name="name" type="text" size="100" maxlength="100">
            </p>
            <p>
                <input type="submit" name="submit" value="Create"> 
            </p>
        </form>
<?php include("../assets/_footer.php"); ?>