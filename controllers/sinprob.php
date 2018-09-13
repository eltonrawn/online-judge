<?php
	//echo $_REQUEST['probid'];
	require_once('../models/datamodel.php');
	//echo $_SESSION['status'];
	$topnav=get_top_nav();
	$title=get_probinfo($_REQUEST['probid'], 2);
	$body = get_probdescinfo($_REQUEST['probid'], 1);
	$inp = get_probdescinfo($_REQUEST['probid'], 2);
	$outp = get_probdescinfo($_REQUEST['probid'], 3);
	$note = get_probdescinfo($_REQUEST['probid'], 3);
	
	$sinp=get_probio($_REQUEST['probid'], 1);
	$soutp=get_probio($_REQUEST['probid'], 2);
	
	$cpu=get_problimit($_REQUEST['probid'], 1);;
	$memory=get_problimit($_REQUEST['probid'], 2);;
	$source=get_problimit($_REQUEST['probid'], 3);;
	
	///single problem edit permission
	
	$sinprobeditper = get_sinprobeditper($_REQUEST['probid']);
	require_once('../views/prob/view_sinprob.php');
?>