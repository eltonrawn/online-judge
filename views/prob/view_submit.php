<?php
	//<link rel="stylesheet" href="../styles.css">
	/*<div class="fakeimg" style="height:200px;">Image</div>*/
	//echo $topnav;
	//<li class="navlist" style="float:right"><a href="#">Login</a></li>
	//<li class="navlist" style="float:right"><a href="#">Sign In</a></li>
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
	
	<form action="validate.php" method="POST">
		
		<input type="hidden" name="probid" value="<?php echo $_REQUEST['probid'];?>">
		<div class="row">
			<div class="leftcolumn">
				<div class="card">
					<h2>Language</h2>
					<select name="language">
						<?php echo $lang;?>
					</select>
				</div>
				
				<div class="card">
					<h2>Code</h2>
					<textarea name="code" rows="30" cols="80"></textarea>
				</div>
			</div>
		  
			<div class="rightcolumn">
				

				<div class="card">
					<h2>Submit</h2>
					<input type="submit" value="Submit">
				</div>
			</div>
		</div>
	</form>
	
</body>