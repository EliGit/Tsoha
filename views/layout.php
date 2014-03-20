<!DOCTYPE HTML>
<html>
	<head>
		<title>HR-Manager</title>
		<meta charset="utf-8" />
		<!--<link href="./assets/css/layout.css">-->
		<link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.css">
	</head>
	<body>
	  	<header>
	  		<nav class="navbar navbar-default" role="navigation">
		  		<div class="container-fluid">
		  			<div class="navbar-header">
		  				<a class="navbar-brand" href="/">HR-Manager</a>
		  			</div>
		  		
			        <ul class="nav navbar-nav">
			            <li><a href="/userlist/">Userlist</a></li>
			            <li><a href="/hours/">Hours</a></li>
			            <li><a href="">Services</a></li>
			            <li><a href="">Contact us</a></li>
			        </ul>
		        </div>
			</nav>
	    </header>
	  	
		  	
	    <div class="container">
		  	<!-- liitä sisältö -->
			<?php require 'views/'.$sivu; ?>
		</div >

		<footer>
			<hr>
			<p>ELN</p>
		</footer>
  

  	</body>
</html>