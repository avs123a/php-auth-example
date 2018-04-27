<?php
require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/config/db.php';

if(session_status() != PHP_SESSION_ACTIVE )
	session_start();

$_SESSION['signup_errors1'] = null;
$_SESSION['signup_errors2'] = null;

$db = new \ova777\MYSQLi\Connection($host, $user, $password, $database);

/**
* checking unicque email and login
* $db1 - ova777\MYSQLi\Connection object
**/
function check_unique($email, $login, $db1)
{
	$row = $db1->command('SELECT * FROM user WHERE email=? OR login=?')
	->bind('ss', array($email, $login))
	->queryRow();
	if($row)
	{
		$_SESSION['signup_errors2'] = 'Login or email is using. Please , enter other login or email';
		return false;
	}
	else
		return true;
}


//processing registration form
if(isset($_POST['user_register']))
{
	$v = new Valitron\Validator($_POST);
	
	$rules = [
		'required' => [
			'user_email',
			'user_login',
			'user_rname',
			'user_password',
			'user_bdate',
			'user_country',
			'user_agreed'
		],
		'email' => 'user_email',
		'date' => 'user_bdate',
		'accepted' => 'user_agreed',
		'integer' => 'user_country',
		'lengthMax' => [
			['user_email', 50],
			['user_rname', 50],
		],
		'lengthBetween' => [
			['user_login', 6, 30],
			['user_password', 6, 50],
		],
	];
	
	$v->rules($rules);
	
	if($v->validate() && check_unique($_POST['user_email'], $_POST['user_login'], $db))
	{
		//insert row in user table
		$db->command('INSERT INTO user SET email=?, login=?, password=?, bdate=?, country_id=?, agreed=?, registered=?')
		->bind('ssssiii', array(
			$_POST['user_email'],
			$_POST['user_login'],
			$_POST['user_password'],
			$_POST['user_bdate'],
			$_POST['user_country'],
			1, time())
		)
		->execute();
		
		//auto login
		$_SESSION['user_email'] = $row['email'];
		$_SESSION['user_real_name'] = $row['real_name'];
		
		//redirect to cabinet page
		header("Location: cabinet.php");
		exit;
	} 
	else
	{
		$_SESSION['signup_errors1'] = $v->errors();
		header("Location: signup.php");
		exit;
	}
	
	
}
