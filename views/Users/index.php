<h1>Käyttäjät</h1>

<p>Ohjelman käyttäjät ja heidän tietonsa - tiedot ovat käyttäjiensä itse päivittämiä.</p>

<?if($_SESSION['rank']==1) { ?> 
<p>ADMIN: Tästä pääsee yksittäisten käyttäjien sivuille. Huomioithan, että et silti pääse muuttamaan käyttäjien tietoja tai työtunteja. Voit kuitenkin poistaa käyttäjiä. </p>
<?} ?>

<div class="container">	
	<table class="table table-striped">
		<tr>
			<th>Username</th>
			<th>Name</th>
			<th>Address</th>
			<th>Email</th>
			<th>Phone</th>
			<?if($_SESSION['rank']==1) { echo '<th>Edit</th>'; } ?>
		</tr>
	<? foreach ($data->lista as $h) { ?>
		<tr class="">
			<td><?echo $h['username']?></td>
			<td><?echo $h['firstname']." ".$h['lastname']?></td>
			<td><?echo $h['address']?></td>
			<td><?echo $h['email']?></td>
			<td><?echo $h['phone']?></td>			
			<?if($_SESSION['rank']==1) { ?> 
				<td><a href="/users?u=<?echo $h['username']?>"><button type="button" class="btn btn-danger">x</button></a></td>
			<?} ?>
		</tr>	
	<? } ?>
	</table>
</div>

<?if($_SESSION['rank']==1) { ?> 
<hr>
<div class= "container">
	<form class="form-inline" role="form" action="/users/create" method="post">
	  <div class="form-group">
	    <label class="sr-only">Username</label>
	    <input type="text" class="form-control" placeholder="Username" name="username">
	  </div>
	  <div class="form-group">
	    <label class="sr-only" for="exampleInputPassword2">Password1</label>
	    <input type="password" class="form-control" placeholder="Password1" name="password1">
	    <label class="sr-only" for="exampleInputPassword2">Password2</label>
	    <input type="password" class="form-control" placeholder="Password2" name="password2">
	  </div>
	  <button type="submit" class="btn btn-default">Lisää käyttäjä</button>
	</form>
</div>
<?} ?>