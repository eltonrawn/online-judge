<?php
	
	// connects to the database
	function connectdb() {
	  include('dbinfo.php');
	  $conn = mysqli_connect($host,$user,$password, $database);
	  return $conn;
	}
	function check_pass($handle, $pass)	{
		$conn = connectdb();
		if(!$conn)	{
			return "can't connect to database";
		}
		$query = "SELECT hash FROM users WHERE handle" . "='" . $handle . "'";
		$result = mysqli_query($conn, $query);
		if(mysqli_num_rows($result) == 1)	{
			$row = mysqli_fetch_assoc($result);
			return pass_check($pass, $row['hash']);
		}
		else	{
			return "Handle Doesn't Exist";
		}
	}
	function get_status($handle)	{
		$conn = connectdb();
		$query = "SELECT status FROM users WHERE handle" . "='" . $handle . "'";
		$result = mysqli_query($conn, $query);
		if(mysqli_num_rows($result) == 1)	{
			$row = mysqli_fetch_assoc($result);
			return $row['status'];
		}
		return 0;
	}
	function get_userid($handle)	{
		$conn = connectdb();
		$query = "SELECT userid FROM users WHERE handle" . "='" . $handle . "'";
		$result = mysqli_query($conn, $query);
		if(mysqli_num_rows($result) == 1)	{
			$row = mysqli_fetch_assoc($result);
			return $row['userid'];
		}
		//return 0;
	}
	
	function get_filename($subid)	{
		$conn = connectdb();
		$query = "SELECT fname FROM submission WHERE subid" . "='" . $subid . "'";
		$result = mysqli_query($conn, $query);
		if(mysqli_num_rows($result) == 1)	{
			$row = mysqli_fetch_assoc($result);
			return $row['fname'];
		}
		//return 0;
	}
	
	function get_handlebyid($userid)	{
		$conn = connectdb();
		$query = "SELECT handle FROM users WHERE userid" . "='" . $userid . "'";
		$result = mysqli_query($conn, $query);
		if(mysqli_num_rows($result) == 1)	{
			$row = mysqli_fetch_assoc($result);
			return $row['handle'];
		}
		//return 0;
	}
	function get_probtitle($probid)	{
		$conn = connectdb();
		$query = "SELECT title FROM problems WHERE probid" . "='" . $probid . "'";
		$result = mysqli_query($conn, $query);
		if(mysqli_num_rows($result) == 1)	{
			$row = mysqli_fetch_assoc($result);
			return $row['title'];
		}
		//return 0;
	}
	function get_langnamebyid($langid)	{
		$conn = connectdb();
		$query = "SELECT lname FROM language WHERE langid" . "='" . $langid . "'";
		$result = mysqli_query($conn, $query);
		if(mysqli_num_rows($result) == 1)	{
			$row = mysqli_fetch_assoc($result);
			return $row['lname'];
		}
		//return 0;
	}
	
	function get_cpubyproid($probid)	{
		$conn = connectdb();
		$query = "SELECT cpu FROM problimit WHERE probid" . "='" . $probid . "'";
		$result = mysqli_query($conn, $query);
		if(mysqli_num_rows($result) == 1)	{
			$row = mysqli_fetch_assoc($result);
			return $row['cpu'];
		}
	}
	function get_langidbyname($lname)	{
		$conn = connectdb();
		$query = "SELECT langid FROM language WHERE lname" . "='" . $lname . "'";
		$result = mysqli_query($conn, $query);
		if(mysqli_num_rows($result) == 1)	{
			$row = mysqli_fetch_assoc($result);
			return $row['langid'];
		}
		//return 0;
	}
	
	function get_useridfromprob($probid)	{
		$conn = connectdb();
		$query = "SELECT userid FROM problems WHERE probid" . "='" . $probid . "'";
		$result = mysqli_query($conn, $query);
		if(mysqli_num_rows($result) == 1)	{
			$row = mysqli_fetch_assoc($result);
			return $row['userid'];
		}
		//return 0;
	}
	
	
	function handle_exists($handle)	{
		
		$conn = connectdb();
		$query = "SELECT * FROM users WHERE handle" . "='" . $handle . "'";
		$result = mysqli_query($conn, $query);
		if(mysqli_num_rows($result) == 1)	{
			$row = mysqli_fetch_assoc($result);
			return 1;
		}
		return 0;
	}
	function email_exists($email)	{
		
		$conn = connectdb();
		$query = "SELECT * FROM users WHERE email" . "='" . $email . "'";
		$result = mysqli_query($conn, $query);
		if(mysqli_num_rows($result) == 1)	{
			$row = mysqli_fetch_assoc($result);
			return 1;
		}
		return 0;
	}
	
	function pass_check($pass, $hash_db)	{
		if(password_verify($pass, $hash_db))	{
			return "1";
		}
		return "Password Doesn't Match";
	}
	function create_hash($pass)	{
		return password_hash($pass, PASSWORD_DEFAULT);
	}
	function hash_function_verify()	{
		if(pass_check("rawn", create_hash("rawn")))	{
			//echo "thik ache 1<br/>";
		}
		if(!pass_check("RawN", create_hash("rawn")))	{
			//echo "thik ache 2<br/>";
		}
	}
	//hash_function_verify();
	function insert_user($handle, $fname, $lname, $hash, $email, $status)	{
		$conn = connectdb();
		if (!$conn) {
			die("Connection failed: " . mysqli_connect_error());
			return 0;
		}
		$sql = "INSERT INTO users (handle, fname, lname, hash, email, status)
		VALUES ('" . $handle . "', '" . $fname . "', '" . $lname . "', '" . $hash . "', '" . $email . "', '" . $status . "')";
		if (mysqli_query($conn, $sql)) {
			//echo "New record created successfully";
		} else {
			//echo "Error: " . $sql . "<br>" . mysqli_error($conn);
		}
		mysqli_close($conn);
		return 1;
	}
	function set_verdict($subid, $verdict)	{
		$conn = connectdb();
		if (!$conn) {
			die("Connection failed: " . mysqli_connect_error());
			return 0;
		}
		$sql = "UPDATE submission
			SET verdict='".$verdict."'
			WHERE subid=".$subid;
		if (mysqli_query($conn, $sql)) {
			//echo "New record created successfully";
		} else {
			//echo "Error: " . $sql . "<br>" . mysqli_error($conn);
		}
		mysqli_close($conn);
		return 1;
	}
	function get_prob_all()	{
		$conn = connectdb();
		if (!$conn) {
			die("Connection failed: " . mysqli_connect_error());
			return 0;
		}
		
		$sql = "SELECT * FROM problems ORDER BY probid DESC";
		//$sql = "SELECT * FROM problems";
		
		$res = mysqli_query($conn, $sql);
		
		if ($res) {
			//echo "New record created successfully";
		} else {
			//echo "Error: " . $sql . "<br>" . mysqli_error($conn);
		}
		return $res;
	}
	function get_sub_all()	{
		$conn = connectdb();
		if (!$conn) {
			die("Connection failed: " . mysqli_connect_error());
			return 0;
		}
		
		$sql = "SELECT * FROM submission ORDER BY subid DESC";
		
		$res = mysqli_query($conn, $sql);
		
		if ($res) {
			//echo "New record created successfully";
		} else {
			//echo "Error: " . $sql . "<br>" . mysqli_error($conn);
		}
		return $res;
	}
	function get_lang_all()	{
		$conn = connectdb();
		if (!$conn) {
			die("Connection failed: " . mysqli_connect_error());
			return 0;
		}
		
		$sql = "SELECT * FROM language";
		
		$res = mysqli_query($conn, $sql);
		
		if ($res) {
			//echo "New record created successfully";
		} else {
			//echo "Error: " . $sql . "<br>" . mysqli_error($conn);
		}
		return $res;
	}
	
	function get_my_sub_all($handle)	{
		$conn = connectdb();
		if (!$conn) {
			die("Connection failed: " . mysqli_connect_error());
			return 0;
		}
		
		$sql = "SELECT * FROM submission ORDER BY subid DESC";
		$sql = "SELECT * FROM submission where userid=".get_userid($handle)." ORDER BY subid DESC";
		
		$res = mysqli_query($conn, $sql);
		
		if ($res) {
			//echo "New record created successfully";
		} else {
			//echo "Error: " . $sql . "<br>" . mysqli_error($conn);
		}
		return $res;
	}
	
	function get_my_prob_all($handle)	{
		$conn = connectdb();
		if (!$conn) {
			die("Connection failed: " . mysqli_connect_error());
			return 0;
		}
		
		$sql = "SELECT * FROM problems where userid=".get_userid($handle)." ORDER BY probid DESC";
		
		$res = mysqli_query($conn, $sql);
		
		if ($res) {
			//echo "New record created successfully";
		} else {
			//echo "Error: " . $sql . "<br>" . mysqli_error($conn);
		}
		return $res;
	}
	function get_probdescinfo($probid, $chk)	{
		$conn = connectdb();
		$query = "SELECT * FROM probdesc WHERE probid" . "='" . $probid . "'";
		
		$result = mysqli_query($conn, $query);
		if(mysqli_num_rows($result) == 1)	{
			$row = mysqli_fetch_assoc($result);
			if($chk == 1)	{
				return $row['body'];
			}
			if($chk == 2)	{
				return $row['input'];
			}
			if($chk == 3)	{
				return $row['output'];
			}
			if($chk == 4)	{
				return $row['note'];
			}
			
		}
		return 0;
	}
	function get_probinfo($probid, $chk)	{
		$conn = connectdb();
		$query = "SELECT * FROM problems WHERE probid" . "='" . $probid . "'";
		
		$result = mysqli_query($conn, $query);
		if(mysqli_num_rows($result) == 1)	{
			$row = mysqli_fetch_assoc($result);
			if($chk == 1)	{
				return $row['userid'];
			}
			if($chk == 2)	{
				return $row['title'];
			}
			if($chk == 3)	{
				return $row['solved'];
			}
		}
		return 0;
	}
	function get_probio($probid, $chk)	{
		$conn = connectdb();
		$query = "SELECT * FROM probio WHERE probid" . "='" . $probid . "'";
		
		$result = mysqli_query($conn, $query);
		if(mysqli_num_rows($result) == 1)	{
			$row = mysqli_fetch_assoc($result);
			if($chk == 1)	{
				return $row['inp'];
			}
			if($chk == 2)	{
				return $row['outp'];
			}
		}
		return 0;
	}
	function get_problimit($probid, $chk)	{
		$conn = connectdb();
		$query = "SELECT * FROM problimit WHERE probid" . "='" . $probid . "'";
		
		$result = mysqli_query($conn, $query);
		if(mysqli_num_rows($result) == 1)	{
			$row = mysqli_fetch_assoc($result);
			if($chk == 1)	{
				return $row['cpu'];
			}
			if($chk == 2)	{
				return $row['memory'];
			}
			if($chk == 3)	{
				return $row['source'];
			}
		}
		return 0;
	}
	
	
	
	function insert_problems($probid, $userid, $title, $solved, $chk)	{
		$conn = connectdb();
		if (!$conn) {
			die("Connection failed: " . mysqli_connect_error());
			return 0;
		}
		$sql = "";
		if($chk)	{
			///insert
			$sql = "INSERT INTO problems (userid, title, solved)
			VALUES ('" . $userid . "', '" . $title . "', '" . $solved . "')";
		}
		else	{
			///update
			$sql = "UPDATE problems
			SET title='".$title."'
			WHERE probid=".$probid;
		}
		
		if (mysqli_query($conn, $sql)) {
			//echo "New record created successfully<br/>";
		} else {
			//echo "Error: " . $sql . "<br>" . mysqli_error($conn);
		}
		if($chk)	{
			///incase of insert get new probid;
			$probid = mysqli_insert_id($conn);
			//echo "inserted " . $probid . "<br/>";
		}
		mysqli_close($conn);
		return $probid;
	}
	
	function insert_probdesc($probid, $body, $input, $output, $note, $chk)	{
		$conn = connectdb();
		if (!$conn) {
			die("Connection failed: " . mysqli_connect_error());
			return 0;
		}
		$sql = "";
		if($chk)	{
			///insert
			$sql = "INSERT INTO probdesc (probid, body, input, output, note)
			VALUES ('" . $probid . "', '" . $body . "', '" . $input . "', '" . $output . "', '" . $note . "')";
		}
		else	{
			///update
			$sql = "UPDATE probdesc
			SET body='".$body."', input='".$input."', output='".$output."', note='".$note."'
			WHERE probid=".$probid;
		}
		
		if (mysqli_query($conn, $sql)) {
			//echo "New record created successfully<br/>";
		} else {
			//echo "Error: " . $sql . "<br>" . mysqli_error($conn);
		}
		mysqli_close($conn);
		return $probid;
	}
	function insert_problimit($probid, $cpu, $chk)	{
		$conn = connectdb();
		if (!$conn) {
			die("Connection failed: " . mysqli_connect_error());
			return 0;
		}
		$sql = "";
		if($chk)	{
			///insert
			$sql = "INSERT INTO problimit (probid, cpu)
			VALUES ('" . $probid . "', '" . $cpu . "')";
		}
		else	{
			///update
			$sql = "UPDATE problimit
			SET cpu='".$cpu."'
			WHERE probid=".$probid;
		}
		
		if (mysqli_query($conn, $sql)) {
			//echo "New record created successfully<br/>";
		} else {
			//echo "Error: " . $sql . "<br>" . mysqli_error($conn);
		}
		mysqli_close($conn);
		return $probid;
	}
	function insert_probio($probid, $inp, $outp, $chk)	{
		$conn = connectdb();
		if (!$conn) {
			die("Connection failed: " . mysqli_connect_error());
			return 0;
		}
		$sql = "";
		if($chk)	{
			///insert
			$sql = "INSERT INTO probio (probid, inp, outp)
			VALUES ('" . $probid . "', '" . $inp . "', '" . $outp . "')";
		}
		else	{
			///update
			$sql = "UPDATE probio
			SET inp='".$inp."', outp='".$outp."'
			WHERE probid=".$probid;
		}
		
		if (mysqli_query($conn, $sql)) {
			//echo "New record created successfully<br/>";
		} else {
			//echo "Error: " . $sql . "<br>" . mysqli_error($conn);
		}
		mysqli_close($conn);
		return $probid;
	}
	
	function insert_whole_prob($probid, $userid, $title, $solved, $body, $input, $output, $note, $cpu, $inp, $outp, $chk)	{
		///for new prob $chk = 1;
		$probid = insert_problems($probid, $userid, $title, $solved, $chk);
		insert_probdesc($probid, $body, $input, $output, $note, $chk);
		insert_problimit($probid, $cpu, $chk);
		insert_probio($probid, $inp, $outp, $chk);
		return $probid;
	}
	
	function insert_sub($userid, $probid, $langid, $verdict, $soln, $fname)	{
		$conn = connectdb();
		if (!$conn) {
			die("Connection failed: " . mysqli_connect_error());
			return 0;
		}
		$sql = "INSERT INTO submission (userid, probid, langid, verdict, soln, fname)
		VALUES('" . $userid . "', '" . $probid . "', '" . $langid . "', '" . $verdict . "', '" . $soln . "', '" .$fname . "')";
		if (mysqli_query($conn, $sql)) {
			//echo "New record created successfully";
		} else {
			//echo "Error: " . $sql . "<br>" . mysqli_error($conn);
		}
		
		$subid = mysqli_insert_id($conn);
		$fname = "file" . $subid;
		
		
		$sql = "UPDATE submission
			SET fname='".$fname."'
			WHERE subid=".$subid;
		
		if (mysqli_query($conn, $sql)) {
			//echo "New record created successfully";
		} else {
			//echo "Error: " . $sql . "<br>" . mysqli_error($conn);
		}
		
		mysqli_close($conn);
		return $subid;
	}
	
	function get_solvebyuserid($userid)	{
		$conn = connectdb();
		$query = "SELECT solved FROM users WHERE userid" . "='" . $userid . "'";
		$result = mysqli_query($conn, $query);
		if(mysqli_num_rows($result) == 1)	{
			$row = mysqli_fetch_assoc($result);
			return $row['solved'];
		}
		//return 0;
	}
	function get_solvebyprobid($probid)	{
		$conn = connectdb();
		$query = "SELECT solved FROM problems WHERE probid" . "='" . $probid . "'";
		$result = mysqli_query($conn, $query);
		if(mysqli_num_rows($result) == 1)	{
			$row = mysqli_fetch_assoc($result);
			return $row['solved'];
		}
		//return 0;
	}
	function check_solve($userid, $probid)	{
		$conn = connectdb();
		$query = "SELECT * FROM solve WHERE userid" . "=" . $userid . " AND probid = " . $probid;
		$result = mysqli_query($conn, $query);
		if(mysqli_num_rows($result) == 1)	{
			return 1;
		}
		return 0;
	}
	
	function update_solvebyuserid($userid, $ss)	{
		$solved = get_solvebyuserid($userid) + $ss;
		
		$conn = connectdb();
		if (!$conn) {
			die("Connection failed: " . mysqli_connect_error());
			return 0;
		}
		
		$sql = "UPDATE users
			SET solved='".$solved."'
			WHERE userid=".$userid;
			
		if (mysqli_query($conn, $sql)) {
			echo "New record created successfully";
		} else {
			echo "Error: " . $sql . "<br>" . mysqli_error($conn);
		}
		mysqli_close($conn);
		return 1;
	}
	
	function update_solvebyprobid($probid, $ss)	{
		$solved = get_solvebyprobid($probid) + $ss;
		
		$conn = connectdb();
		if (!$conn) {
			die("Connection failed: " . mysqli_connect_error());
			return 0;
		}
		
		$sql = "UPDATE problems
			SET solved='".$solved."'
			WHERE probid=".$probid;
			
		if (mysqli_query($conn, $sql)) {
			echo "New record created successfully";
		} else {
			echo "Error: " . $sql . "<br>" . mysqli_error($conn);
		}
		mysqli_close($conn);
		return 1;
	}
	function insert_solve($userid, $probid)	{
		if(check_solve($userid, $probid))	{
			return 0;
		}
		$conn = connectdb();
		if (!$conn) {
			die("Connection failed: " . mysqli_connect_error());
			return 0;
		}
		$sql = "INSERT INTO solve (userid, probid)
		VALUES('" . $userid . "', '" . $probid . "')";
		if (mysqli_query($conn, $sql)) {
			echo "New record created successfully";
		} else {
			echo "Error: " . $sql . "<br>" . mysqli_error($conn);
		}
		mysqli_close($conn);
		update_solvebyuserid($userid, 1);
		update_solvebyprobid($probid, 1);
		return 1;
	}
	
	
	function deleteprob($probid)	{
		$conn = connectdb();
		$query = "SELECT * FROM solve WHERE probid" . "='" . $probid . "'";
		$result = mysqli_query($conn, $query);
		if(mysqli_num_rows($result) == 0)	{
			return 0;
		}
		$row = mysqli_fetch_assoc($result);
		while($row = mysqli_fetch_assoc($res))	{
			update_solvebyuserid($row['userid'], -1);
		}
		$query = "DELETE FROM problems WHERE probid" . "='" . $probid . "'";
	}
	
	
?>