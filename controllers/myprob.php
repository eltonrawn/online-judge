<?php
	require_once('../models/datamodel.php');
	if(!loggedin() || !myprobper())	{
		header("Location:home.php");
		die();
	}
	//echo $_SESSION['status'];
	$topnav=get_top_nav();
	$probtab = get_my_prob_table();
	require_once('../views/prob/view_prob.php');
?>