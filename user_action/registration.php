<?php
    header('Content-type: text/html; charset=utf-8');
?>
<html>
    <head>
        <title>Registration</title>
	<link rel="stylesheet" href="../assets/css/style.css">
    </head>
    <body>
        <form class="login" action="../user_action/save_user.php" method="post">
		<label for="name">Name:</label>
      <input type="text" name="name" id="name" value="">
    </p>
	<label for="email">Email:</label>
      <input type="text" name="email" id="email" value="">
    </p>
            <label for="login">Login:</label>
      <input type="text" name="login" id="login" value="">
    </p>

    <p>
      <label for="password">Password:</label>
      <input type="password" name="password" id="password" value="">
    </p>

    <p class="login-submit">
      <button type="submit" class="login-button">Register</button>
    </p>
        </form>
    </body>
</html>