<?php
	require_once('dbmodel.php');
	session_start();
	// checks if any user is logged in
	function loggedin() {
	  return isset($_SESSION['handle']);
	}
	function myprobper()	{
		$status = get_status($_SESSION['handle']);
		if($status >= 2)	{
			return 1;
		}
		return 0;
	}
	function myuserlistper()	{
		$status = get_status($_SESSION['handle']);
		if($status >= 3)	{
			return 1;
		}
		return 0;
	}
	function mysubmitper()	{
		$status = get_status($_SESSION['handle']);
		if($status == 0)	{
			return 0;
		}
		return 1;
	}
	function validate_login($handle, $pass)	{
		if($handle == "" || $pass == "")	{
			return "Please fill every field";
		}
		return check_pass($handle, $pass);
	}
	function validate_createprob($title, $cpu, $memory, $source)	{
		if($title=="" || $cpu=="" || $memory == "" || $source =="")	{
			return "above specified field should not be empty. Please check again";
		}
		return "1";
	}
	function validate_register($handle, $email, $fname, $lname, $pass, $cpass)	{
		if($handle == "" || $email == "" || $fname == "" || $lname == "" || $pass == "")	{
			return "Please fill every field";
		}
		if(handle_exists($handle))	{
			return "this handle is already used by another user";
		}
		if(email_exists($email))	{
			return "this email is already used by another user";
		}
		if($pass != $cpass)	{
			return "Passwords don't match";
		}
		return "1";
	}
	function validate_account($handle, $email, $fname, $lname, $pass, $cpass, $opass)	{
		if($fname == "" || $lname == "" || $pass == "")	{
			return "Please fill every field";
		}
		if($pass != $cpass)	{
			return "New Passwords don't match";
		}
		return check_pass($handle, $opass);
	}
	function createprobpermission($handle, $probid)	{
		$status = get_status($handle);
		if($status <= 1)	{
			return 0;
		}
		if($status >= 3)	{
			return 1;
		}
		///eikhane jhamela hoitese
		if(get_useridfromprob($probid) == get_userid($handle))	{
			return 1;
		}
		return 0;
	}
	function get_sinprobeditper($probid)	{
		/**
		<a href="submit.php?probid=<?php echo $_REQUEST['probid'];?>">Submit</a>
		<br/>
		<a href="<?php echo "createprob.php?probid=" . $_REQUEST['probid']; ?>">Edit</a>

		<br/>
		<a href="#">Delete</a>
		*/
		$str = '';
		if(!loggedin())	{
			return $str;
		}
		$handle = $_SESSION['handle'];
		$status = get_status($handle);
		
		
		
		if($status == 0)	{
			return $str;
		}
		$str .= '<a href="submit.php?probid=' . $probid . '">Submit</a><br/>';
		
		//$str .= '<a href="submit.php?probid=' . $probid . '" onclick="return confirm(\'Are you sure you want to delete this item?\');">Submit</a><br/>';
		
		if($status == 1)	{
			return $str;			
		}
		if($status == 2)	{
			if(get_useridfromprob($probid) != get_userid($handle))	{
				return $str;
			}			
		}
		$str .= '<a href="createprob.php?probid=' . $probid . '">Edit</a><br/>';
		$str .= '<a href="deleteprob.php?probid=' . $probid . '" onclick="return myFunction();">Delete</a><br/>';
		return $str;
	}
	function complete_login($handle)	{
		$_SESSION['handle'] = $handle;
		///$_SESSION['status'] = get_status($handle);
	}
	function complete_register($handle, $email, $fname, $lname, $pass, $cpass)	{
		insert_user($handle, $fname, $lname, create_hash($pass), $email, 1);
	}
	
	
	function clear_session()	{
		// remove all session variables
		session_unset(); 

		// destroy the session 
		session_destroy(); 
	}
	
	function get_top_nav()	{
		$topnav = "";
		if(!loggedin())	{
			///no one is logged in
			$topnav .= 
			'
			<li class="navlist" style="float:right"><a href="login.php">Login</a></li>
			<li class="navlist" style="float:right"><a href="register.php">Register</a></li>
			';
			//$topnav .= '<li class="navlist" style="float:right"><a href="#">Sign In</a></li>';
			
		}
		else	{
			///user is signed in
			$status = get_status($_SESSION["handle"]);
			if($status <= 1)	{
				$topnav .= 
				'
				<li class="dropdown" style="float:right">
					<a style="min-width:160px" href="#" class="dropbtn">My Account</a>
					<div class="dropdown-content">
						<a href="mysub.php">My Submission</a>
						<a href="account.php">Account</a>
						<a href="logout.php">Logout</a>
					</div>
				</li>
				';
			}
			else if($status == 2)	{
				$topnav .= 
				'
				<li class="dropdown" style="float:right">
					<a style="min-width:160px" href="#" class="dropbtn">My Account</a>
					<div class="dropdown-content">
						<a href="createprob.php">Create Prob</a>
						<a href="myprob.php">My Prob</a>
						<a href="mysub.php">My Submission</a>
						<a href="account.php">Account</a>
						<a href="logout.php">Logout</a>
					</div>
				</li>
				';
			}
			else	{
				$topnav .= 
				'
				<li class="dropdown" style="float:right">
					<a style="min-width:160px" href="#" class="dropbtn">My Account</a>
					<div class="dropdown-content">
						<a href="createprob.php">Create Prob</a>
						<a href="myprob.php">My Prob</a>
						<a href="mysub.php">My Submission</a>
						<a href="userlist.php">User List</a>
						<a href="account.php">Account</a>
						<a href="logout.php">Logout</a>
					</div>
				</li>
				';				
			}
		}
		return $topnav;
	}
	
	function get_lang_table()	{
		$langtab = "";
		/**
		if(!loggedin() || (get_status($_SESSION["handle"]) <= 3))	{
			
		}
		*/
		$langtab .= '<tr><th>Problem</th><th>User</th><th>Language</th><th>Verdict</th></tr>';
		$res = get_lang_all();
		if(mysqli_num_rows($res) > 0)	{
			while($row = mysqli_fetch_assoc($res))	{
				//$row["id"];
				$langtab .= '<option value="' . $row['lname'] . '">' . $row['lname'] . '</option>';
			}
		}
		return $langtab;
	}
	
	function get_sub_table()	{
		$probtab = "";
		/**
		if(!loggedin() || (get_status($_SESSION["handle"]) <= 3))	{
			
		}
		*/
		$probtab .= '<tr><th>Problem</th><th>User</th><th>Language</th><th>Verdict</th></tr>';
		$res = get_sub_all();
		if(mysqli_num_rows($res) > 0)	{
			while($row = mysqli_fetch_assoc($res))	{
				//$row["id"];
				$probtab .= 
				'
				<tr>
				<td>' .'<a href="sinprob.php?probid='.$row["probid"].'">'. get_probtitle($row["probid"]).'</a>'.'</td>
				<td>' .get_handlebyid($row["userid"]).'</td>
				<td>' .get_langnamebyid($row["langid"]). '</td>
				<td>' .get_verdict($row["verdict"]). '</td>
				</tr>'
				;
			}
		}
		return $probtab;
	}
	function get_my_sub_table()	{
		$probtab = "";
		/**
		if(!loggedin() || (get_status($_SESSION["handle"]) <= 3))	{
			
		}
		*/
		$probtab .= '<tr><th>Problem</th><th>User</th><th>Language</th><th>Verdict</th></tr>';
		$res = get_my_sub_all($_SESSION["handle"]);
		if(mysqli_num_rows($res) > 0)	{
			while($row = mysqli_fetch_assoc($res))	{
				//$row["id"];
				$probtab .= 
				'
				<tr>
				<td>' .'<a href="sinprob.php?probid='.$row["probid"].'">'. get_probtitle($row["probid"]).'</a>'.'</td>
				<td>' .get_handlebyid($row["userid"]).'</td>
				<td>' .get_langnamebyid($row["langid"]). '</td>
				<td>' .get_verdict($row["verdict"]). '</td>
				</tr>'
				;
			}
		}
		return $probtab;
	}
	function get_prob_table()	{
		$probtab = "";
		$probtab .= '<tr><th>Problem Title</th><th>User Solved</th></tr>';
		$res = get_prob_all();
		if(mysqli_num_rows($res) > 0)	{
			while($row = mysqli_fetch_assoc($res))	{
				//$row["id"];
				$probtab .= 
				'
				<tr>
				<td>'.
				'<a href="sinprob.php?probid='.$row["probid"].'">'.$row["title"].'</a>'.
				'</td>
				<td>'.
				$row["solved"].
				'</td>
				</tr>
				';
			}
		}
		return $probtab;
	}
	function get_userstatusname($status)	{
		if($status == 0)return "banned";
		if($status == 1)return "Contestant";
		if($status == 2)return "Setter";
		if($status == 3)return "Admin";
		if($status == 4)return "Administrator";
	}
	function get_user_table()	{
		$probtab = "";
		$probtab .= '<tr><th>Handle</th><th>Status</th><th>Change</th></tr>';
		$res = get_user_all();
		if(mysqli_num_rows($res) > 0)	{
			while($row = mysqli_fetch_assoc($res))	{
				if($row['status'] == 4)	{
					$probtab .= 
					'
					<tr>
					<td>'.
					$row["handle"].
					'</td>
					<td>'.
					get_userstatusname($row["status"]).
					'</td>
					<td>No Change</td>
					</tr>
					';
				}
				else	{
					//$row["id"];
					$probtab .= 
					'
					<tr>
					<td>'.
					$row["handle"].
					'</td>
					<td>'.
					get_userstatusname($row["status"]).
					'</td>
					<td>
					<form method="POST" action="val_userlist.php">
						<input type="hidden" name="userid" value=' .$row["userid"].'>
						<select name="nstatus">
							<option value=0>ban</option>
							<option value=1>Contestant</option>
							<option value=2>Setter</option>
							<option value=3>Admin</option>
						</select>
						<input type="submit" value="Make Changes">
					</form></td>
					</tr>
					';
				}
				
			}
		}
		return $probtab;
	}
	
	
	
	function get_top_user_table()	{
		$probtab = "";
		$probtab .= '<tr><th>Handle</th><th>Solved</th></tr>';
		$res = get_user_allbysolve();
		$cnt = 0;
		if(mysqli_num_rows($res) > 0)	{
			while($row = mysqli_fetch_assoc($res))	{
				//$row["id"];
				$probtab .= 
				'
				<tr>
				<td>'.
				$row["handle"].
				'</td>
				<td>'.
				$row["solved"].
				'</td>
				</tr>
				';
				$cnt++;
				if($cnt == 10)	{
					break;
				}
			}
		}
		return $probtab;
	}
	function get_my_prob_table()	{
		$probtab = "";
		$probtab .= '<tr><th>Problem Title</th><th>User Solved</th></tr>';
		$res = get_my_prob_all($_SESSION["handle"]);
		if(mysqli_num_rows($res) > 0)	{
			while($row = mysqli_fetch_assoc($res))	{
				//$row["id"];
				$probtab .= 
				'
				<tr>
				<td>'.
				'<a href="sinprob.php?probid='.$row["probid"].'">'.$row["title"].'</a>'.
				'</td>
				<td>'.
				$row["solved"].
				'</td>
				</tr>
				';
			}
		}
		return $probtab;
	}
	function get_verdict($ver)	{
		///return "queue";
		/*
		$vv = ("queue", "Accepted", "Compilation Error", "Time Limit Exceeded", "Runtime Error", "Wrong Answer");
		return vv[$ver];
		*/
		if($ver == 0)return "queue";
		if($ver == 1)return "Accepted";
		if($ver == 2)return "Compilation Error";
		if($ver == 3)return "Time Limit Exceeded";
		if($ver == 4)return "Runtime Error";
		if($ver == 5)return "Wrong Answer";
	}
	//<a href="home.php">Home</a>
?>