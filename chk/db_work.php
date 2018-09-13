<?php
// connects to the database
function connectdb() {
  include('dbinfo.php');
  $conn = mysqli_connect($host,$user,$password, $database);
  return $conn;
}

// gets the name of the event
function getName(){
  $conn = connectdb();
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
		UNIQUE(handle),
		UNIQUE(email),
		PRIMARY KEY (userid)
	)";

	if (mysqli_query($conn, $sql)) {
		echo "Table users created successfully";
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
	function create_users()	{
		insert_user("rawn", "Rawnak", "Sarker", create_hash("rawn"), "eltonrawn@gmail.com", 4);
		insert_user("priya", "Tahsina", "Priya", create_hash("priya"), "priya@gmail.com", 3);
		insert_user("elton", "Elton", "Rawn", create_hash("elton"), "rawn@gmail.com", 2);
		insert_user("moka", "Moka", "Moka", create_hash("moka"), "moka0@gmail.com", 1);
	}
	createUserTable();
	create_users();
?>