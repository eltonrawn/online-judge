<?php
	//echo $_REQUEST['probid'];
	require_once('../models/datamodel.php');
	if(!loggedin() || !mysubmitper())	{
		header("Location:home.php");
		die();
	}
	$topnav=get_top_nav();
	$lang = get_lang_table();
	
	require_once('../views/prob/view_submit.php');
	/**
	<option name="1" value="cpp">cpp</option>
	<option value="java">java</option>
	*/
?>