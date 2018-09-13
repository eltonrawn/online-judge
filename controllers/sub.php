<?php
	
	require_once('../models/datamodel.php');
	//echo $_SESSION['status'];
	$topnav=get_top_nav();
	///$probtab = get_prob_table();
	$probtab = get_sub_table();
	require_once('../views/prob/view_prob.php');
?>