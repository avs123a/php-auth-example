<?php
require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../config/db.php';
require_once __DIR__ . '/../api/api.php';

call_session();
showRegisterErrors();

$db = new \ova777\MYSQLi\Connection($host, $user, $password, $database);

$countries = $db->command('SELECT * FROM country')->queryAll();
?>

<!DOCTYPE HTML>
<html>
	<head>
		<title>Register</title>
	</head>
	<body>
		<h2>Register</h2>
		<form name="register-form" action="/src/signup_procedure.php" method="post">
			<label for="email-field">Email: </label>
			<input type="text" id="email-field" name="user_email" required /><br>
			<label for="login-field">Login: </label>
			<input type="text" id="login-field" name="user_login" required/><br>
			<label for="rname-field">Real name: </label>
			<input type="text" id="rname-field" name="user_rname" required/><br>
			<label for="passw-field">Password: </label>
			<input type="password" id="passw-field" name="user_password" required/><br>
			<label for="bdate-field">Birth date : </label>
			<input type="date" id="bdate-field" name="user_bdate" required/><br>
			<label for="country-field">Country : </label>
			<select name="user_country" id="country-field" required>
				<option value="prompt" disabled selected>Choose country</option>
				
				<?php foreach($countries as $country): ?>
				
				<option value="<?= $country['id'] ?>"><?= $country['name'] ?></option>
		    		
				<?php endforeach; ?>
			</select>
			<br>
			<p>
				<input type="checkbox" name="user_agreed" required> I agree with terms and conditions.
			</p>
			<br>
			<input type="submit" name="user_register" value="Sign UP" />
		</form>
	</body>
</html>
