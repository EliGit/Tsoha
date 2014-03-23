<h4>Listaelementtitesti: listataan käyttäjät tietokannasta</h4>

<div class="container">
	<ul>
	<?php foreach($data->lista as $asia) { ?>
	  <li><?php echo $asia; ?></li>
	<?php } ?>
	</ul>
</div>

<hr>
<div class= "container">
	<form class="form-inline" role="form">
	  <div class="form-group">
	    <label class="sr-only">Username</label>
	    <input type="email" class="form-control" id="exampleInputEmail2" placeholder="Username">
	  </div>
	  <div class="form-group">
	    <label class="sr-only" for="exampleInputPassword2">Password1</label>
	    <input type="password" class="form-control" id="exampleInputPassword2" placeholder="Password1">
	    <label class="sr-only" for="exampleInputPassword2">Password2</label>
	    <input type="password" class="form-control" id="exampleInputPassword2" placeholder="Password2">
	  </div>
	  <button type="submit" class="btn btn-default">Lisää käyttäjä</button>
	</form>
</div>