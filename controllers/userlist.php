<?php
	//echo $_REQUEST['probid'];
	require_once('../models/datamodel.php');
	if(!loggedin() || !myuserlistper())	{
		header("Location:home.php");
		die();
	}
	//echo $_SESSION['status'];
	$topnav=get_top_nav();
	$probtab = get_user_table();
	require_once('../views/prob/view_prob.php');
?>