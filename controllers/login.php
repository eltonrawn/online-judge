<?php
	require_once('../models/datamodel.php');
	
	$res="";
	if(loggedin())	{
		header("Location: home.php");
	}
	else if($_SERVER['REQUEST_METHOD'] === 'POST') {
		$res = validate_login(trim($_POST['handle']), trim($_POST['pass']));
		if($res == "1")	{
			complete_login(trim($_POST['handle']));
			header("Location: home.php");
		}
		else	{
			require_once('../views/login/view_login.php');
		}
	}
	else	{
		require_once('../views/login/view_login.php');
	}
?>