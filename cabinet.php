<?php
if(session_status() != PHP_SESSION_ACTIVE )
	session_start();
if(!isset($_SESSION['user_email']))
{
	header("Location: login.html");
	exit;
}
?>

<!DOCTYPE HTML>
<html>
    <head>
	    <title>My Cabinet</title>
	</head>
	<body>
	    <h3>Welcome to your personal cabinet</h3>
		<p>Your email: <?=$_SESSION['user_email'] ?> </p>
		<p>Your name:  <?=$_SESSION['user_real_name'] ?></p>
		<form name="logout-form" action="/logout.php" method="post">
		    <input type="submit" name="logout_btn" value="Logout" />
		</form>
	</body>
</html>