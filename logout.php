<?php
session_start();
if(isset($_POST['logout_btn']))
{
	//unset($_COOKIE['AVS']);
	unset($_SESSION['user_email']);
	unset($_SESSION['user_real_name']);
	session_unset();
	//unset($_COOKIE['PHPSESSID']); //delete session coockies
	header("Location: login.html");
	exit;
}