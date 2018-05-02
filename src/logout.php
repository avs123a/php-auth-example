<?php
require_once __DIR__ . '/../api/api.php';

if(isset($_POST['logout_btn']))
{
	logoutUser();
}