<?php
	$str="<a href=\"prob.php\">Problems</a>
		<a href=\"#\">Status</a>
		<a href=\"#\" style=\"float:right\">Logout</a>
		<a href=\"#\" style=\"float:right\">My Profile</a>";
?>
<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="styles.css">
</head>
<body>
	
	<div class="header">
	  <h2>Online Judge</h2>
	</div>
	
	<div class="topnav">
		<?php echo $str;?>
	</div>
	
	<div class="row">
	  <div class="leftcolumn">
		<div class="card">
			<table>
			  <tr>
				<th>Company</th>
				<th>Contact</th>
				<th>Country</th>
			  </tr>
			  <tr>
				<td><a href="#">Alfreds Futterkiste</a></td>
				<td>Maria Anders</td>
				<td>Germany</td>
			  </tr>
			  <tr>
				<td>Centro comercial Moctezuma</td>
				<td>Francisco Chang</td>
				<td>Mexico</td>
			  </tr>
			  <tr>
				<td>Ernst Handel</td>
				<td>Roland Mendel</td>
				<td>Austria</td>
			  </tr>
			</table>
		</div>
		
	  </div>
	  
	  <div class="rightcolumn">
		<div class="card">
		  <h3>Popular Post</h3>
		  <div class="fakeimg"><p>Image</p></div>
		  <div class="fakeimg"><p>Image</p></div>
		  <div class="fakeimg"><p>Image</p></div>
		</div>
		<div class="card">
		  <h3>Follow Me</h3>
		  <p>Some text..</p>
		</div>
		<div class="card">
			<table>
				<tr>
					<th>Company</th>
					<th>Contact</th>
					<th>Country</th>
				</tr>
				<tr>
					<td>Alfreds Futterkiste</td>
					<td>Maria Anders</td>
					<td>Germany</td>
				</tr>
				<tr>
					<td>Centro comercial Moctezuma</td>
					<td>Francisco Chang</td>
					<td>Mexico</td>
				</tr>
				<tr>
					<td>Ernst Handel</td>
					<td>Roland Mendel</td>
					<td>Austria</td>
				</tr>
			</table>
		</div>
	  </div>
	</div>
	
	<div class="footer">
	  <h2>Footer</h2>
	</div>
</body>