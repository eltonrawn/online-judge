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
	
	<form action="createprob.php" method="POST">
		<input type="hidden" name="probid" value="<?php echo $probid;?>">
		<div class="row">
			<div class="leftcolumn">
				<div class="card">
					<?php echo $preerror; ?>
					<?php echo $error; ?>
					<h2>Title</h2>
					<input name="title" type="text" value="<?php echo $title; ?>" required>
				</div>
				
				<div class="card">
					<h2>Body</h2>
					<textarea name="body" rows="30" cols="80"><?php echo $body; ?></textarea>
				</div>
				
				<div class="card">
					<h2>Input</h2>
					<textarea name="input" rows="10" cols="80"><?php echo $inp; ?></textarea>
				</div>
				
				<div class="card">
					<h2>Output</h2>
					<textarea name="output" rows="10" cols="80"><?php echo $outp; ?></textarea>
				</div>
				<div class="card">
				  <table>
					<tr>
						<th>Sample input</th><th>Sample output</th>
					</tr>
					<tr>
						<td><textarea name="sinp" rows="10" cols="50"><?php echo $sinp; ?></textarea></td>
						<td><textarea name="sout" rows="10" cols="50"><?php echo $soutp; ?></textarea></td>
					</tr>
					
				  </table>
				</div>
			</div>
		  
			<div class="rightcolumn">
				<div class="card">
					<h4>Prob Limit</h4>
					<p>
					CPU limit (In Second) : <br/>
					<input name="cpu" type="number" value="<?php echo $cpu;?>" required max=3 min=1><br/><br/>
					Memory limit (In Megabyte) : <br/>
					<input name="memory" type="number" value="<?php echo $memory;?>" required max=512 min=32><br/><br/>
					Source limit (In Kilobyte) : <br/>
					<input name="source" type="number" value="<?php echo $source;?>" required min=32><br/><br/>
					</p>
				</div>

				<div class="card">
					<h2>Submit</h2>
					<input type="submit" value="Submit">
				</div>
			</div>
		</div>
	</form>
	
</body>