<?php
	//echo $_REQUEST['probid'];
	require_once('../models/datamodel.php');
	if(!loggedin())	{
		header("Location:home.php");
		die();
	}
	$preerror = "**title and prob limits should not be empty<br/>";
	$error="";
	
	if($_SERVER['REQUEST_METHOD'] === 'POST') {
		
		$error = validate_createprob(trim($_POST['title']), $_POST['cpu'], $_POST['memory'], $_POST['source']);
		
		if($error != "1")	{
			//echo "ekhane ashe?";
			/**************************************************/
			if($_POST['probid'] < 1)	{
				header("Location: createprob.php");
			}
			else	{
				header("Location: createprob.php?probid=".$_POST['probid']);
			}
			
			die();
		}
		else	{
			
			if($_POST['probid'] < 1)	{
				$preerror .= "ekhane ashe?";
				///notun prob
				//insert_whole_prob($probid, $userid, $title, $solved, $body, $input, $output, $note, $cpu, $inp, $outp, $chk)
				$probid = insert_whole_prob(0, get_userid($_SESSION['handle']), $_POST['title'], 0, $_POST['body'], $_POST['input'], $_POST['output'], "", $_POST['cpu'], $_POST['sinp'], $_POST['sout'], 1);
				/**************************************************/
				header("Location: sinprob.php?probid=".$probid);
				die();
				//redirect("Location:sinprob.php?probid=".$probid);
			}
			else	{
				if(!createprobpermission($_SESSION['handle'], $_POST['probid']))	{
					$preerror .= "bal";
					/**************************************************/
					header("Location: home.php");
					die();
				}
				///update
				//insert_whole_prob($probid, $userid, $title, $solved, $body, $input, $output, $note, $cpu, $inp, $outp, $chk)
				$probid = insert_whole_prob($_POST['probid'], 0, $_POST['title'], 0, $_POST['body'], $_POST['input'], $_POST['output'], "", $_POST['cpu'], $_POST['sinp'], $_POST['sout'], 0);
				
				/**************************************************/
				header("Location: sinprob.php?probid=".$probid);
				die();
				
			}	
		}
		
		
		///echo "etotuku asche;";
		
	}
	
	
	$probid = -1;
	
	$topnav=get_top_nav();
	
	$title = "title";
	$body = "This should contain body";
	$inp = "This should contain input specification";
	$outp = "This should contain output specification";
	$note = "";
	
	$sinp = "This should contain sample input";
	$soutp = "This should contain sample output";
	
	$cpu = "1";
	$memory = "512";
	$source = "32";
	if(isset($_GET['probid']))	{
		$probid = $_REQUEST['probid'];
		if(!createprobpermission($_SESSION['handle'], $probid))	{
			//$preerror .= "bal";
			//$preerror .= "ki bal " . $probid . " " . get_userid($_SESSION['handle']) . " " . get_useridfromprob($probid) . " " . (createprobpermission($_SESSION['handle'], $probid));
			/**************************************************/
			header("Location:home.php");
			die();
			//redirect("Location:prob.php");
		}
		
		///existing kono prob
		//echo $_SESSION['status'];
		
		//echo  $_REQUEST['probid']. "update er jonno asche";
		
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
		require_once('../views/prob/view_createprob.php');
	}
	else	{
		///new prob;
		require_once('../views/prob/view_createprob.php');
	}
	
	
?>