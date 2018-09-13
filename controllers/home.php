<?php
	
	require_once('../models/datamodel.php');
	//echo $_SESSION['status'];
	$topnav=get_top_nav();
	$usertab = get_top_user_table();
	require_once('../views/home/view_home.php');
?>