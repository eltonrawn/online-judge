<?php
	function get_email($handle)	{
		$conn = connectdb();
		$query = "SELECT email FROM users WHERE handle" . "='" . $handle . "'";
		$result = mysqli_query($conn, $query);
		if(mysqli_num_rows($result) == 1)	{
			$row = mysqli_fetch_assoc($result);
			return $row['email'];
		}
		return 0;
	}
	function get_fname($handle)	{
		$conn = connectdb();
		$query = "SELECT fname FROM users WHERE handle" . "='" . $handle . "'";
		$result = mysqli_query($conn, $query);
		if(mysqli_num_rows($result) == 1)	{
			$row = mysqli_fetch_assoc($result);
			return $row['fname'];
		}
		return 0;
	}
	function get_lname($handle)	{
		$conn = connectdb();
		$query = "SELECT lname FROM users WHERE handle" . "='" . $handle . "'";
		$result = mysqli_query($conn, $query);
		if(mysqli_num_rows($result) == 1)	{
			$row = mysqli_fetch_assoc($result);
			return $row['lname'];
		}
		return 0;
	}
	function get_pass($handle)	{
		$conn = connectdb();
		$query = "SELECT hash FROM users WHERE handle" . "='" . $handle . "'";
		$result = mysqli_query($conn, $query);
		if(mysqli_num_rows($result) == 1)	{
			$row = mysqli_fetch_assoc($result);
			return $row['hash'];
		}
		return 0;
	}
	function change_user($handle, $fname, $lname, $hash)	{
		$conn = connectdb();
		if (!$conn) {
			die("Connection failed: " . mysqli_connect_error());
			return 0;
		}
		$sql = "UPDATE users
		SET fname='" . $fname . "', lname='" . $lname . "', hash='" . $hash . "'
		WHERE handle='" . $handle . "'";
		if (mysqli_query($conn, $sql)) {
			echo "New record created successfully";
		} else {
			echo "Error: " . $sql . "<br>" . mysqli_error($conn);
		}
		mysqli_close($conn);
		return 1;
	}
	function complete_account_change($handle, $fname, $lname, $pass)	{
		change_user($handle, $fname, $lname, create_hash($pass));
	}
?>
