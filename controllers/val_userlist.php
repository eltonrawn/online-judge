<?php
	//echo $_REQUEST['probid'];
	require_once('../models/datamodel.php');
	if(!loggedin() || !myuserlistper())	{
		header("Location:home.php");
		die();
	}
	
	if($_SERVER['REQUEST_METHOD'] === 'POST') {
		echo $_POST['userid'] . ' ' . $_POST['nstatus'];
		update_statusbyuser($_POST['userid'], $_POST['nstatus']);
		header("Location:userlist.php");
		die();
	}
	else	{
		header("Location:home.php");
		die();
	}
	/**
	
	*/
?>