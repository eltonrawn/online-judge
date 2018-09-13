<?php
	require_once('../models/datamodel.php');
	
	$res="";
	if(loggedin())	{
		header("Location: home.php");
	}
	else if($_SERVER['REQUEST_METHOD'] === 'POST') {
		$res = validate_register(trim($_POST['handle']), trim($_POST['email']), trim($_POST['fname']), trim($_POST['lname']), trim($_POST['pass']), trim($_POST['cpass']));
		if($res == "1")	{
			complete_register(trim($_POST['handle']), trim($_POST['email']), trim($_POST['fname']), trim($_POST['lname']), trim($_POST['pass']), trim($_POST['cpass']));
			complete_login(trim($_POST['handle']));
			header("Location: home.php");
		}
		else	{
			require_once('../views/register/view_register.php');
		}
	}
	else	{
		require_once('../views/register/view_register.php');
	}
	
?>