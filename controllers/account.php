<?php
	require_once('../models/datamodel.php');
	require_once('../models/dbaccount.php');
	$res="";
	/**
	if(!loggedin())	{
		header("Location: home.php");
	}
	*/
	$topnav=get_top_nav();
	
	if($_SERVER['REQUEST_METHOD'] === 'POST') {
		$res = validate_account(trim($_POST['handle']), trim($_POST['email']), trim($_POST['fname']), trim($_POST['lname']), trim($_POST['pass']), trim($_POST['cpass']), trim($_POST['opass']));
		
		if($res == "1")	{
			/**
			complete_register(trim($_POST['handle']), trim($_POST['email']), trim($_POST['fname']), trim($_POST['lname']), trim($_POST['pass']), trim($_POST['cpass']));
			complete_login(trim($_POST['handle']));
			*/
			complete_account_change(trim($_POST['handle']), trim($_POST['fname']), trim($_POST['lname']), trim($_POST['pass']), trim($_POST['cpass']));
			header("Location: home.php");
		}
		
	}
	$handle=$_SESSION['handle'];	
	$email=get_email($handle);
	$fname=get_fname($handle);
	$lname=get_lname($handle);
	$pass=get_pass($handle);
	$cpass=$pass;
	require_once('../views/account/view_account.php');
	
?>