<?php
	
	require_once('../models/datamodel.php');
	if(!loggedin())	{
		header("Location:home.php");
		die();
	}
	//echo $_SESSION['status'];
	$topnav=get_top_nav();
	///$probtab = get_prob_table();
	$probtab = get_my_sub_table();
	require_once('../views/prob/view_prob.php');
?>