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
	<link rel="stylesheet" href="../resource/css/prob_styles.css">
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
			<table>
				<?php echo $probtab; ?>
			</table>
		</div>
	  </div>
	</div>
	
</body>


<?php
/**/
?>