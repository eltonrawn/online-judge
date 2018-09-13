<?php
// connects to the database
function connectdb() {
  include('dbinfo.php');
  $conn = mysqli_connect($host,$user,$password, $database);
  return $conn;
}

// gets the name of the event
function getName(){
  $conn = mysqli_connect($host,$user,$password, $database);
  $query="SELECT name FROM prefs";
  $result = mysqli_query($conn, $query);
  $row = mysqli_fetch_array($result);
  return $row['name'];
}

function createDB()	{
	include('dbinfo.php');
	$conn = mysqli_connect($host, $user, $password);
	// create the database
	if(mysqli_query($conn, "CREATE DATABASE $database"))	{
		echo "Database created <br/>";
	}
	else	{
		echo "Database create hoi nai <br/>";
	}
	mysqli_close($conn);
}
	function createUserTable()	{
		$conn = connectdb();
		
		// create the users table
		$sql = 
		"CREATE TABLE IF NOT EXISTS users (
			userid int(11) UNSIGNED AUTO_INCREMENT,
			handle varchar(20) NOT NULL,
			fname varchar(255) NOT NULL,
			lname varchar(255) NOT NULL,
			hash varchar(255) NOT NULL,
			email varchar(255) NOT NULL,
			status int(11) NOT NULL DEFAULT '1',
			solved int(11) NOT NULL DEFAULT '0',
			UNIQUE(handle),
			UNIQUE(email),
			PRIMARY KEY (userid)
		)";

		if (mysqli_query($conn, $sql)) {
			echo "Table users created successfully<br/>";
		} else {
			echo "Error creating table: " . mysqli_error($conn);
		}
		mysqli_close($conn);
	}
	
	function createLangTable()	{
		$conn = connectdb();
		
		// create the users table
		$sql = 
		"CREATE TABLE IF NOT EXISTS language (
			langid int(11) UNSIGNED AUTO_INCREMENT,
			lname varchar(255) NOT NULL,
			UNIQUE(lname),
			PRIMARY KEY(langid)
		)";

		if (mysqli_query($conn, $sql)) {
			echo "Table lang created successfully";
		} else {
			echo "Error creating table: " . mysqli_error($conn);
		}
		mysqli_close($conn);
	}
	
	function createSolveTable()	{
		$conn = connectdb();
		
		// create the users table
		$sql = 
		"CREATE TABLE IF NOT EXISTS solve (
			userid int(11) UNSIGNED,
			probid int(11) UNSIGNED,
			FOREIGN KEY(userid) REFERENCES users(userid)
				ON DELETE CASCADE
				ON UPDATE CASCADE,
			FOREIGN KEY(probid) REFERENCES problems(probid)
				ON DELETE CASCADE
				ON UPDATE CASCADE
		)";

		if (mysqli_query($conn, $sql)) {
			echo "Table solve created successfully";
		} else {
			echo "Error creating table: " . mysqli_error($conn);
		}
		mysqli_close($conn);
	}
	
	function createSubTable()	{
		$conn = connectdb();
		// create the users table
		$sql = 
		"CREATE TABLE IF NOT EXISTS submission (
			subid int(11) UNSIGNED AUTO_INCREMENT,
			userid int(11) UNSIGNED,
			probid int(11) UNSIGNED,
			langid int(11) UNSIGNED ,
			verdict int(11) NOT NULL,
			soln varchar(255) NOT NULL,
			fname varchar(255) NOT NULL,
			PRIMARY KEY (subid),
			FOREIGN KEY(userid) REFERENCES users(userid)
				ON DELETE CASCADE
				ON UPDATE CASCADE,
			FOREIGN KEY(probid) REFERENCES problems(probid)
				ON DELETE CASCADE
				ON UPDATE CASCADE,
			FOREIGN KEY(langid) REFERENCES language(langid)
				ON DELETE CASCADE
				ON UPDATE CASCADE
		)";
		/**
			
			
		*/

		if (mysqli_query($conn, $sql)) {
			echo "Table submission created successfully<br/>";
		} else {
			echo "Error creating table: " . mysqli_error($conn);
		}
		mysqli_close($conn);
	}
	/**
	createDB();
	createUserTable();
	*/
	function pass_check($pass, $hash_db)	{
		if(password_verify($pass, $hash_db))	{
			return 1;
		}
		return 0;
	}
	function create_hash($pass)	{
		return password_hash($pass, PASSWORD_DEFAULT);
	}
	function hash_function_verify()	{
		if(pass_check("rawn", create_hash("rawn")))	{
			echo "thik ache 1<br/>";
		}
		if(!pass_check("RawN", create_hash("rawn")))	{
			echo "thik ache 2<br/>";
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
			echo "New record created successfully";
		} else {
			echo "Error: " . $sql . "<br>" . mysqli_error($conn);
		}
		mysqli_close($conn);
		return 1;
	}
	
	function get_solvebyid($userid)	{
		$conn = connectdb();
		$query = "SELECT solved FROM users WHERE userid" . "='" . $userid . "'";
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
	
	function update_solvebyid($userid)	{
		$solved = get_solvebyid($userid) + 1;
		
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
	
	
	function insert_sub($userid, $probid, $langid, $verdict, $soln, $fname)	{
		$conn = connectdb();
		if (!$conn) {
			die("Connection failed: " . mysqli_connect_error());
			return 0;
		}
		$sql = "INSERT INTO submission (userid, probid, langid, verdict, soln, fname)
		VALUES('" . $userid . "', '" . $probid . "', '" . $langid . "', '" . $verdict . "', '" . $soln . "', '" .$fname . "')";
		if (mysqli_query($conn, $sql)) {
			echo "New record created successfully";
		} else {
			echo "Error: " . $sql . "<br>" . mysqli_error($conn);
		}
		
		$subid = mysqli_insert_id($conn);
		$fname = "file" . $subid;
		
		$sql = "UPDATE submission
			SET fname='".$fname."'
			WHERE subid=".$subid;
		
		if (mysqli_query($conn, $sql)) {
			echo "New record created successfully";
		} else {
			echo "Error: " . $sql . "<br>" . mysqli_error($conn);
		}
		mysqli_close($conn);
		return 1;
	}
	function insert_language($lname)	{
		$conn = connectdb();
		if (!$conn) {
			die("Connection failed: " . mysqli_connect_error());
			return 0;
		}
		$sql = "INSERT INTO language (lname)
		VALUES ('" . $lname . "')";
		//VALUES ('" . $handle . "', '" . $fname . "', '" . $lname . "', '" . $hash . "', '" . $email . "', '" . $status . "')";
		if (mysqli_query($conn, $sql)) {
			echo "New record created successfully";
		} else {
			echo "Error: " . $sql . "<br>" . mysqli_error($conn);
		}
		mysqli_close($conn);
		return 1;
	}
	function insert_solve($userid, $probid)	{
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
		return 1;
	}
	function create_users()	{
		insert_user("rawn", "Rawnak", "Sarker", create_hash("rawn"), "eltonrawn@gmail.com", 4);
		insert_user("priya", "Tahsina", "Priya", create_hash("priya"), "priya@gmail.com", 3);
		insert_user("elton", "Elton", "Rawn", create_hash("elton"), "rawn@gmail.com", 2);
		insert_user("moka", "Moka", "Moka", create_hash("moka"), "moka@gmail.com", 1);
		//insert_user("ninja", "naruto", "uzumaki", create_hash("naruto"), "naruto@gmail.com", 1);
	}
	///createUserTable();
	///create_users();
	
	function createProblemTable()	{
		$conn = connectdb();
		
		// create the problems table
		$sql = 
		"CREATE TABLE IF NOT EXISTS problems (
			probid int(11) UNSIGNED PRIMARY KEY AUTO_INCREMENT,
			userid int(11) UNSIGNED NOT NULL,
			title varchar(50) NOT NULL,
			solved int(11) NOT NULL DEFAULT '0',
			FOREIGN KEY(userid) REFERENCES users(userid)
				ON DELETE CASCADE
				ON UPDATE CASCADE
		)";
		if (mysqli_query($conn, $sql)) {
			echo "Table 'Problems' created successfully<br/>";
		} else {
			echo "Error creating table: " . mysqli_error($conn);
		}
		/***************************************************/
		// create the problems description table
		$sql = 
		"CREATE TABLE IF NOT EXISTS probdesc (
			probid int(11) UNSIGNED UNIQUE,
			body text NOT NULL DEFAULT '',
			input text NOT NULL DEFAULT '',
			output text NOT NULL DEFAULT '',
			note text NOT NULL DEFAULT '',
			FOREIGN KEY(probid) REFERENCES problems(probid)
				ON DELETE CASCADE
				ON UPDATE CASCADE
		)";
		if (mysqli_query($conn, $sql)) {
			echo "Table 'Probdesc' created successfully<br/>";
		} else {
			echo "Error creating table: " . mysqli_error($conn);
		}
		/***************************************************/
		// create the problems limit table
		$sql = 
		"CREATE TABLE IF NOT EXISTS problimit (
			probid int(11) UNSIGNED UNIQUE,
			cpu int(11) NOT NULL DEFAULT '1',
			memory int(11) NOT NULL DEFAULT '512',
			source int(11) NOT NULL DEFAULT '32',
			FOREIGN KEY(probid) REFERENCES problems(probid)
				ON DELETE CASCADE
				ON UPDATE CASCADE
		)";
		if (mysqli_query($conn, $sql)) {
			echo "Table 'Problimit' created successfully<br/>";
		} else {
			echo "Error creating table: " . mysqli_error($conn);
		}
		/***************************************************/
		// create the problems input output table
		$sql = 
		"CREATE TABLE IF NOT EXISTS probio (
			probid int(11) UNSIGNED,
			inp text NOT NULL DEFAULT '',
			outp text NOT NULL DEFAULT '',
			FOREIGN KEY(probid) REFERENCES problems(probid)
			ON DELETE CASCADE
			ON UPDATE CASCADE
		)";
		//echo $sql . "<br/>";
		if (mysqli_query($conn, $sql)) {
			echo "Table 'Probio' created successfully<br/>";
		} else {
			echo "Error creating table: " . mysqli_error($conn);
		}
		/***************************************************/
		mysqli_close($conn);
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
			echo "New record created successfully<br/>";
		} else {
			echo "Error: " . $sql . "<br>" . mysqli_error($conn);
		}
		if($chk)	{
			///incase of insert get new probid;
			$probid = mysqli_insert_id($conn);
			echo "inserted " . $probid . "<br/>";
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
			echo "New record created successfully<br/>";
		} else {
			echo "Error: " . $sql . "<br>" . mysqli_error($conn);
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
			echo "New record created successfully<br/>";
		} else {
			echo "Error: " . $sql . "<br>" . mysqli_error($conn);
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
			echo "New record created successfully<br/>";
		} else {
			echo "Error: " . $sql . "<br>" . mysqli_error($conn);
		}
		mysqli_close($conn);
		return $probid;
	}
	
	function insert_whole_prob($probid, $userid, $title, $solved, $body, $input, $output, $note, $cpu, $inp, $outp, $chk)	{
		$probid = insert_problems($probid, $userid, $title, $solved, $chk);
		insert_probdesc($probid, $body, $input, $output, $note, $chk);
		insert_problimit($probid, $cpu, $chk);
		insert_probio($probid, $inp, $outp, $chk);
	}
	
	function create_problems()	{
		/**
		insert_problems(3, "a + b", 0);
		insert_problems(10, "koi jao", 0);
		insert_problems(14, "notun prob", 0);
		*/
		//insert_problems(2, "onek valo prob", 0);
		
		///chk 1 means notun prob
		//insert_whole_prob(0, 15, "how mow", 0, "eita body", "eita input", "eita output", "eita note", 2, "1 2", "3", 1);
		insert_whole_prob(0, 2, "arek prob", 0, "eita 2 body", "eita 2 input", "eita 2 output", "eita 2 note", 5, "1 2", "3", 1);
	}
	//createProblemTable();
	//create_users();
	//create_problems();
	//insert_probio(13, "ami", "tumi", 0);
	//insert_problimit(13, 10, 0);
	//insert_probdesc(13, "aro onek baki", "inp eta", "", "", 0);
	//insert_problems(13, 0, "aro valo title", 0, 0);
	
	function make_db()	{
		/**
		createDB();///create database
		createUserTable();///create user table
		create_users();///create some users
		createProblemTable();
		createLangTable();
		createSubTable();
		insert_language("cpp");
		createSolveTable();
		update_solvebyid(2);
		*/
		//echo check_solve(2, 1);
		echo check_solve(2, 3);
		
	}
	make_db();
?>