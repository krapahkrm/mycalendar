<?php include("../assets/_header_in.php"); 
	require_once('../classes/user.php');
	$name = User::getName($_SESSION['login_user']);
?>
<link rel="stylesheet" href="../assets/css/style.css">
<h2>Edit user</h2>
<form action="../user_action/save_edit.php" method="post">
    <p>
        <label>New name:<br></label>
        <input name="name" type="text" size="100" maxlength="100" value=<?php echo $name;?>>
    </p>
    <p>
        <label>New password:<br></label>
        <input name="password" type="password" size="30" maxlength="30">
    </p>        
    <p>
        <input type="submit" name="submit" value="Save"> 
    </p>
</form>
<?php include("../assets/_footer.php"); ?>