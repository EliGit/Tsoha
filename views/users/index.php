<h4>Listaelementtitesti: listataan käyttäjät tietokannasta</h4>

<div class="container">
	<table class="table table-striped">
		<tr>
			<th>Username</th>
			<th>Name</th>
			<th>Address</th>
			<th>Email</th>
			<th>Phone</th>
		</tr>
	<? foreach ($data->lista as $h) { ?>
		<tr class="">
			<td><?echo $h['username']?></td>
			<td><?echo $h['firstname']." ".$h['lastname']?></td>
			<td><?echo $h['address']?></td>
			<td><?echo $h['email']?></td>
			<td><?echo $h['phone']?></td>			
			<td><button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modalHour">x</button></td>			
		</tr>	
	<? } ?>
	</table>
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