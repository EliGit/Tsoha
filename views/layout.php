<!DOCTYPE HTML>
<html>
	<head>
		<title>HR-Manager</title>
		<meta charset="utf-8" />		
		<link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
		<script src="../assets/bootstrap/js/bootstrap.min.js"></script>

	</head>
	<body>
	  	<header>
	  		<nav class="navbar navbar-default" role="navigation">
		  		<div class="container-fluid">
		  			<div class="navbar-header">
		  				<a class="navbar-brand" href="/">HR-Manager</a>
		  			</div>
		  			<!-- NAVBAR -->
			        <ul class="nav navbar-nav">
			        	<?if(isset($_SESSION['user'])){?>
				            
				            <li><a href="/users/">Käyttäjät</a></li>
				            <li><a href="/hours/">Asiakastunnit</a></li>
				            <li><a href=<?echo "/users?u=".$_SESSION["user"]?>><?echo $_SESSION["user"];?></a></li>
				            
				            <?if($_SESSION['rank']==1) {?> 
				            	<li><a href="/report/">Yleisraportti</a></li>			            
			            	<?}?>
		            		
		            		<li><a href="/logout/">logout</a></li>
		            	<?}?>
			        </ul>
			        <!-- /NAVBAR -->
		        </div>
			</nav>
	    </header>

	    <!-- NOTICE -->
	  	<? if(isset($data->notice)){ ?>
		  	<div class="container">
	  			<h3><font color="red"> <?echo $data->notice . "!";?> </font><h3>
		  	</div>	  		
		<?}?>
		  	
	    <div class="container">
		  	<!-- CONTENT -->
			<?php require 'views/'.$sivu; ?>
		</div >

		<footer>
			<hr>
			<p>ELN</p>
		</footer>
  
  	</body>
</html>