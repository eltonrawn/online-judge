<?php
	//<link rel="stylesheet" href="../styles.css">
	/*<div class="fakeimg" style="height:200px;">Image</div>*/
	//echo $topnav;
	//<li class="navlist" style="float:right"><a href="#">Login</a></li>
	//<li class="navlist" style="float:right"><a href="#">Sign In</a></li>
	/**
	<div class="header">
	  <h2>Online Judge</h2>
	</div>
	<div class="footer">
	  <h2>Footer</h2>
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
		<li class="navlist"><a href="#">Home</a></li>
		<li class="navlist"><a href="prob.php">Problems</a></li>
		<li class="navlist"><a href="sub.php">Submissions</a></li>
		<?php echo $topnav;?>
		
	</ul>
	
	
	<div class="row">
	  <div class="leftcolumn">
		<div class="card">
		  <h2>Welcome to Online Judge</h2>
		  <h5>Title description, Dec 7, 2017</h5>
		  <p>
		  Welcome to our online judge. Here you can test you code for given problems. Cheers!!
		  <br/>
		  Now, we only support c++. Soon we will support many languages.
		</div>
		
		<div class="card">
		  <h2>TITLE HEADING</h2>
		  <h5>Title description, Dec 7, 2017</h5>
		  <img class="naruto" src="../resource/pic/naruto.jpg" style="height:500px;width:500px">
		  <div class="fakeimg">Image</div>
		  <p>Some text..</p>
		  <div class="fakeimg" style="height:200px;">Image</div>
		  
		  <p>Sunt in culpa qui officia deserunt mollit anim id est laborum consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco.</p>
		</div>
		
		<div class="card">
		  <h2>TITLE HEADING</h2>
		  <h5>Title description, Sep 2, 2017</h5>
		  <div class="fakeimg" style="height:200px;">Image</div>
		  <p>Some text..</p>
		  <p>Sunt in culpa qui officia deserunt mollit anim id est laborum consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco.</p>
		</div>
		
		<div class="card">
		  <h2>TITLE HEADING</h2>
		  <h5>Title description, Sep 2, 2017</h5>
		  <div class="fakeimg" style="height:200px;">Image</div>
		  <p>Some text..</p>
		  <p>Sunt in culpa qui officia deserunt mollit anim id est laborum consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco.</p>
		</div>
	  </div>
	  
	  <div class="rightcolumn">
		<div class="card">
		  <h2>TOP SOLVER</h2>
		  <table>
		  <?php echo $usertab;?>
		  </table>
		</div>
		<div class="card">
		  <h3>Popular Post</h3>
		</div>
	  </div>
	</div>
	
	
</body>