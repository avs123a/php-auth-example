<?php
require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../config/db.php';
require_once __DIR__ . '/../api/api.php';

$db = new \ova777\MYSQLi\Connection($host, $user, $password, $database);


if(isset($_POST['signin']))
{
	if($row = findUser($db, $_POST['user_passw'], $_POST['user_login_email']))
	{
		loginUser($row['email'], $row['real_name']);
	}
	else
	{
		echo 'This user not found in system!';
		exit;
	}
}