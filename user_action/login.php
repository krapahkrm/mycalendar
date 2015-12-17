<?php
	header('Content-type: text/html; charset=utf-8');
?>
<html>
    <head>
    	<title>Login</title>
	<link rel="stylesheet" href="../assets/css/style.css">
    </head>
    <body>
	    <form class="login" action="../user_action/testreg.php" method="post">
	 	<p>
      <label for="login">Login:</label>
      <input type="text" name="login" id="login" value="">
    </p>

    <p>
      <label for="password">Password:</label>
      <input type="password" name="password" id="password" value="">
    </p>

    <p class="login-submit">
      <button type="submit" class="login-button">Login</button>
    </p>

    <p class="register"><a href="../user_action/registration.php">Register</a></p>
	    </form>
   	</body>
</html>