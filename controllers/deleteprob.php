<?php
	require_once('../models/datamodel.php');
	if(!loggedin())	{
		header("Location:home.php");
		die();
	}
	if(isset($_GET['probid']))	{
		$probid = $_REQUEST['probid'];
		if(!createprobpermission($_SESSION['handle'], $probid))	{
			header("Location:home.php");
			die();
		}
		
		deleteprob($probid);
		header("Location:prob.php");
		die();
		
		
	}
	else	{
		header("Location:home.php");
		die();
	}
	
?>