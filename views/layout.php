<!DOCTYPE HTML>
<html>
	<head>
		<title>HR-Manager</title>
		<meta charset="utf-8" />
		<!--<link href="./assets/css/layout.css">-->
		<link rel="stylesheet" type="text/css" href="../assets/css/layout.css">
	</head>
	<body>
	  	<header>
	            <h1>Welcome to HR-Manager</h1>
	    </header>
	  	
	  	<nav>
	        <ul class="fancyNav">
	            <li><a href="/index.php">Index</a></li>
	            <li><a href="/userlist.php">Userlist</a></li>
	            <li><a href="">About us</a></li>
	            <li><a href="">Services</a></li>
	            <li><a href="">Contact us</a></li>
	        </ul>
		</nav>

	  	<!-- liitä sisältö -->
		<?php require 'views/'.$sivu; ?>

		<footer>
			<hr>
			<p>ELN</p>
		</footer>
  

  	</body>
</html>