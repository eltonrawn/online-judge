<?php
	//<link rel="stylesheet" href="../styles.css">
	/*<div class="fakeimg" style="height:200px;">Image</div>*/
	//echo $topnav;
	//<li class="navlist" style="float:right"><a href="#">Login</a></li>
	//<li class="navlist" style="float:right"><a href="#">Sign In</a></li>
	/**
	<a href="submit.php?probid=<?php echo $_REQUEST['probid'];?>">Submit</a>
	<br/>
	<a href="<?php echo "createprob.php?probid=" . $_REQUEST['probid']; ?>">Edit</a>

	<br/>
	<a href="#">Delete</a>
	
	
	
	*/
	
?>
<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="../resource/css/home_styles.css">
	<script>
		function myFunction() {
		  if (confirm("Want to delete?")) {
		   return true;
		  } else {
		   return false;
		  }
		}
	</script>
</head>
<body>
	
	
	<ul class="topnav">
		<li class="navlist"><a href="home.php">Home</a></li>
		<li class="navlist"><a href="prob.php">Problems</a></li>
		<li class="navlist"><a href="sub.php">Submissions</a></li>
		<?php echo $topnav;?>
		
	</ul>
	
	
	<div class="row">
	  <div class="leftcolumn">
		<div class="card">
		  <h2><?php echo $title; ?></h2>
		  <p><?php echo $body; ?></p>
		</div>
		
		<div class="card">
		  <h2>Input</h2>
		  <p><?php echo $inp; ?></p>
		</div>
		
		<div class="card">
		  <h2>Output</h2>
		  <p><?php echo $outp; ?></p>
		</div>
		<div class="card">
		  <table>
			<tr>
				<th>Sample input</th><th>Sample output</th>
			</tr>
			<tr>
				<td><?php echo $sinp; ?></td><td><?php echo $soutp; ?></td>
			</tr>
			
		  </table>
		</div>
	  </div>
	  
	  <div class="rightcolumn">
		<div class="card">
		  <h4>Prob Limit</h4>
		  <p>
		  CPU limit : <?php echo $cpu; ?><br/>
		  Memory limit : <?php echo $memory; ?><br/>
		  Source limit : <?php echo $source; ?><br/>
		  </p>
		</div>
		
		<div class="card">
			<?php echo $sinprobeditper;?>
		</div>
	  </div>
	</div>
	
</body>