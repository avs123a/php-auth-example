<?php
session_start();
if(isset($_POST['logout_btn']))
{
	unset($_SESSION['user_email']);
	unset($_SESSION['user_real_name']);
	session_unset();
	header("Location: login.html");
	exit;
}
