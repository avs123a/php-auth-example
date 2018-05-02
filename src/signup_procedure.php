<?php
require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../config/db.php';
require_once __DIR__ . '/../api/api.php';

call_session();

$db = new \ova777\MYSQLi\Connection($host, $user, $password, $database);

//processing registration form
if(isset($_POST['user_register']))
{
	$v = new Valitron\Validator($_POST);
	
	//validation rules
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
	
	if($v->validate() && checkUnique($db, $_POST['user_email'], $_POST['user_login']) === true)
	{
		//insert row in user table
		$result = saveUser(
			$db,
			$_POST['user_email'],
			$_POST['user_login'],
			$_POST['user_rname'],
			$_POST['user_password'],
			$_POST['user_bdate'],
			$_POST['user_country']
		);
		
		if($result === true)
		{
			//auto login
			loginUser($row['email'], $row['real_name']);
		}
	} 
	else
	{
		$_SESSION['signup_errors1'] = $v->errors();
		header("Location: signup.php");
		exit;
	}
}