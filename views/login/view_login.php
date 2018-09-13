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
		<li class="navlist" style="float:right"><a href="login.php">Login</a></li>
		<li class="navlist" style="float:right"><a href="register.php">Register</a></li>
	</ul>
	
	
	
	<div style="text-align:center;background: #e0e0eb;" class="card">
		<form action="login.php" method="post">
			<label class="lb">Handle:</label>
			<input type="text" name="handle" required>
			<br/>
			<br/>
			<label class="lb">Password:</label>
			<input type="password" name="pass" required>
			<br/>
			<br/>
			<input type="submit" value="Login">
		</form>
		<br/><br/>
		<?php echo $res;?>
	</div>
</body>