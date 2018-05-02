<?php

//WORKING WITH SESSIONS

/*
* function call session
* if session is not active, this function creates it
*/
function call_session()
{
	if(session_status() != PHP_SESSION_ACTIVE )
		session_start();
}

/*
* function showRegisterErrors
* show sign up errors
*/
function showRegisterErrors()
{
	call_session();
	if(isset($_SESSION['signup_errors1']))
		print_r($_SESSION['signup_errors1']);
	if(isset($_SESSION['signup_errors2']))
		echo $_SESSION['signup_errors2'];
}

/*
* function Login
* set email and username to session
*/
function loginUser($email, $real_name)
{
	call_session();
	$_SESSION['user_email'] = $email;
	$_SESSION['user_real_name'] = $real_name;
	header("Location: cabinet.php");
	exit;
}

/*
* function showUser
* set email and username to session
*/
function showUser()
{
	call_session();
	$info = '<p>Your email: ' . $_SESSION['user_email'] . '</p><p>Your name:  ' . $_SESSION['user_real_name'] . '</p>';
	return $info;
}

/*
* function Login
* set email and username to session
*/
function logoutUser()
{
	call_session();
	unset($_SESSION['user_email']);
	unset($_SESSION['user_real_name']);
	header("Location: login.html");
	exit;
}

/*
* function checkAuth
* redirect to login page if user is not authenticated
*/
function checkAuth()
{
	call_session();
	if(!isset($_SESSION['user_email']))
	{
		header("Location: login.html");
		exit;
	}
	
}



//WORKING WITH DATABASE

/**
* checking unicque email and login
* $db1 - ova777\MYSQLi\Connection object
**/
function checkUnique($db1, $email, $login)
{	
    call_session();
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




/*
* signup function
* $db1 - ova777\MYSQLi\Connection object
*/
function saveUser($db1, $email, $login, $real_name, $password2, $birth_date, $country_id)
{
	$query = $db1->command('INSERT INTO user SET email=?, login=?, real_name=?, password=?, bdate=?, country_id=?, agreed=?, registered=?')
		->bind('sssssiii', array(
			$email,
			$login,
			$real_name,
			$password2,
			$birth_date,
			$country_id,
			1, time()
			)
		)->execute();
	
	if($query == 1)
		return true;
	else
		return false;
}





/**
* find user by login or email and passord
* $db1 - ova777\MYSQLi\Connection object
**/
function findUser($db1, $password2, $login_or_email)
{
	$row = $db1->command('SELECT * FROM user WHERE password=? AND email=? OR login=?')
	->bind('sss', array($password2, $login_or_email, $login_or_email))
	->queryRow();
	
	if($row)
		return $row;
	else
		return false;
}