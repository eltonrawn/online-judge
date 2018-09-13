<?php
	require_once('../models/datamodel.php');
	function format_str($text)	{
		$text=str_replace("\r", "", $text);
		$text=str_replace("\n", "@_n_@", $text);
		return $text;
	}
	
	/**
	echo $_POST['probid'] . "<br/>";
	echo $_POST['code'] . "<br/>";
	echo $_POST['language'] . "<br/>";
	echo "time : " . get_cpubyproid($_POST['probid']) . '<br/>';
	*/
	
	
	if(!($_SERVER['REQUEST_METHOD'] === 'POST'))	{
		header("Location: home.php");
		die();
	}
	header("Location: sub.php");
	
	$langid = get_langidbyname($_POST['language']);
	$subid = insert_sub(get_userid($_SESSION['handle']), $_POST['probid'], $langid, 0, $_POST['code'], "hi");
	//insert_sub($userid, $probid, $langid, $verdict, $soln, $fname);
	$socket = fsockopen("localhost", 3029);
	if($socket) {
		///filename
		fwrite($socket, get_filename($subid)."\n");
		///time
		$time = get_cpubyproid($_POST['probid']);
		fwrite($socket, $time."\n");
		///solution code
		$soln = format_str($_POST['code']);
		fwrite($socket, $soln."\n");
		///input
		$input = format_str(get_probio($_POST['probid'], 1));
		fwrite($socket, $input."\n");
		///language
		
		fwrite($socket, $_POST['language'] . "\n");
		
		
		$status = fgets($socket);
		//echo "status = " . $status . "<br/>";
		$contents = "";
		while(!feof($socket))	{
			$contents = $contents.fgets($socket);
		}
		
		if($status == 1)	{
			if(trim($contents) == trim(format_str(get_probio($_POST['probid'], 2)))) {
				//echo "AC";
				insert_solve(get_userid($_SESSION['handle']), $_POST['probid']);
				if(check_solve(get_userid($_SESSION['handle']), $_POST['probid']) == 0)	{
					
				}				
			} else {
				$status = 5;
			}
		}
		set_verdict($subid, $status);
		
		/**
		if($status == 2) {
			echo "compilation error";
		}
		else if($status == 3) {
			echo "Time Limit Exceed";
		}
		else if($status == 4)	{
			echo "Runtime Error";
		}
		else	{
			echo trim($contents) . " " . trim(get_probio($_POST['probid'], 2)) . " " . "<br/>";
			if(trim($contents) == trim(format_str(get_probio($_POST['probid'], 2)))) {
				echo "AC";
			} else {
				echo "WA";
			}
		}
		*/
	}
	else	{
		//header("Location: submit.php?probid".$_POST['probid']);
	}
	
?>