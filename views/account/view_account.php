<?php
	//<link rel="stylesheet" href="../styles.css">
	/*<div class="fakeimg" style="height:200px;">Image</div>*/
	//echo $topnav;
	//<li class="navlist" style="float:right"><a href="#">Login</a></li>
	//<li class="navlist" style="float:right"><a href="#">Sign In</a></li>
	/**
	<div class="row">
	  <div class="leftcolumn">
		<div class="card">
		  <p>Some text..</p>
		  <p>Sunt in culpa qui officia deserunt mollit anim id est laborum consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco.</p>
		</div>
	  </div>
	</div>
	*/
?>
<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="../resource/css/home_styles.css">
</head>
<body>
	
	<ul class="topnav">
		<li class="navlist"><a href="home.php">Home</a></li>
		<li class="navlist"><a href="prob.php">Problems</a></li>
		<li class="navlist"><a href="sub.php">Submissions</a></li>
		<?php echo $topnav;?>
	</ul>
	
	
	
	<div style="text-align:center;background: #e0e0eb;" class="card">
		<form action="account.php" method="post">
			<label class="lb">Handle:</label>
			<input type="text" name="handle" class="field left" readonly="readonly" value="<?php echo $handle;?>">
			<br/>
			<br/>
			<label class="lb">Email:</label>
			<input type="text" name="email" class="field left" readonly="readonly"value="<?php echo $email;?>">
			<br/>
			<br/>
			<label class="lb">First Name:</label>
			<input type="text" name="fname" value="<?php echo $fname;?>" required>
			<br/>
			<br/>
			<label class="lb">Last Name:</label>
			<input type="text" name="lname" value="<?php echo $lname;?>" required>
			<br/>
			<br/>
			<label class="lb">Old Password:</label>
			<input type="password" name="opass" required>
			<br/>
			<br/>
			<label class="lb">New Password:</label>
			<input type="password" name="pass" required>
			<br/>
			<br/>
			<label class="lb">Confirm New Password:</label>
			<input type="password" name="cpass" required>
			<br/>
			
			<br/>
			<input type="submit" value="Change">
		</form>
		<br/><br/>
		<?php echo $res; ?>
	</div>
	
</body>