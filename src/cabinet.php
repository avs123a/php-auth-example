<?php
require_once __DIR__ . '/../api/api.php';

checkAuth();
?>

<!DOCTYPE HTML>
<html>
	<head>
	    <title>My Cabinet</title>
	</head>
	<body>
		<h3>Welcome to your personal cabinet</h3>
		<?= showUser() ?>
		<form name="logout-form" action="/src/logout.php" method="post">
			<input type="submit" name="logout_btn" value="Logout" />
		</form>
	</body>
</html>
