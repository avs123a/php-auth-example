<?php
require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/config/db.php';

if(session_status() != PHP_SESSION_ACTIVE )
	session_start();
if(isset($_SESSION['user_email']))
{
	header("Location: cabinet.php");
	exit;
}


$db = new \ova777\MYSQLi\Connection($host, $user, $password, $database);


if(isset($_POST['signin']))
{
	$login_or_email = $_POST['user_login_email'];
	$password = $_POST['user_passw'];
	
	$row = $db->command('SELECT * FROM user WHERE password=? AND email=? OR login=?')
	->bind('sss', array($password, $login_or_email, $login_or_email))
	//->bind('i', $password)
	//->bind('i', $login_or_email)
	//->bind('i', $login_or_email)
	->queryRow();
	
	if($row)
	{
		//setcookie('AVS', md5(trim($password . $row['email'])));
		$_SESSION['user_email'] = $row['email'];
		$_SESSION['user_real_name'] = $row['real_name'];
		header("Location: cabinet.php");
		exit;
	}
	else
	{
		header('Location: ' . $_SERVER['']);
		echo 'This user not found in system!';
		exit;
	}
	
	
}