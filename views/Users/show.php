<h1>Hei käyttäjä</h1>

<table class="table table-striped">
	<thead>
		<h3>Kuukauden Työtunnit</h3>
	</thead>
		<tr>
			<th>P&auml;iv&auml;</th>
			<th>Tunnit 6-22</th>
			<th>Tunnit 22-6</th>
			<th>Tunnit päivystys</th>
			<th>Edit</th>
		</tr>

		<?
			$a = array(array("date" => "2014-03-01", "hours1" => 1, "hours2"=>2, "hours3"=>3), 
					 	array("date" => "2014-03-02", "hours1" => 1, "hours2"=>2, "hours3"=>3), 
					 	array("date" => "2014-03-03", "hours1" => 1, "hours2"=>2, "hours3"=>3));

			foreach ($a as $h) {
		?>
		<tr>
			<td style="padding: 5px;"><?echo $h['date']?></td>
			<td><?echo $h['hours1']?></td>
			<td><?echo $h['hours2']?></td>
			<td><?echo $h['hours3']?></td>			
			<td><button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modalWorkHour">x</button></td>
		</tr>
		<? } ?>

		<tr>
			<td><input type="text" name="date" value="<?echo date('Y-m-d')?>" class="form-control" size="10" /></td>
			<td><input type="text" name="hour1" value="" size="10" class="form-control"/></td>
			<td><input type="text" name="hour2" value="" size="10" class="form-control"/></td>
			<td><input type="text" name="hour3" value="" size="10" class="form-control"/></td>			
			<td><button type="submit" name="add" class="btn btn-success">Submit</button></td>			
		</tr>

		<tr>
			<td><button type="submit" name="add" class="btn btn-primary">Hyväksy tunnit</button></td>
			<td></td>
			<td><button type="submit" name="add" class="btn btn-primary">Näytä mennyt kuukausi</button></td>
			
			<td>
				<select class="form-control">
				    <option value="one">Tammikuu 2014</option>
				    <option value="two">Helmikuu 2014</option>
				    <option value="three">jne</option>
				</select>
			</td>
		</tr>
</table>	








<div class="col-md-4"> 
	<table class="table">
		<thead><h3>Käyttäjätiedot</h3></thead>
		<tr><td>Username:</td><td>ELN</td></tr>
		<tr><td>Phone:</td><td>123456789</td></tr>
		<tr><td>Email:</td><td>email@email.com</td></tr>
		<tr><td>Address:</td><td>Someroad, in some country, 00100</td></tr>
	</table>

	<!-- Button trigger modal -->
	<button class="btn btn-primary btn-lg" data-toggle="modal" data-target="#modalUser">
 		 Edit
	</button>

</div>

<div class="col-md-4"> 
	

	<!-- Modal User Edit-->
	<div class="modal fade" id="modalUser" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	  <div class="modal-dialog">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
	        <h4 class="modal-title" id="myModalLabel">Muokkaa tietoja</h4>
	      </div>
	      <div class="modal-body">
	        <table class="table">
	        	<thead><h3>Käyttäjätiedot</h3></thead>
				<tr><td>Username:</td><td>Käyttäjä</td></tr>
				<tr><td>Phone:</td><td><input type="text" name="hour1" value="" size="10" class="form-control"/></td></tr>
				<tr><td>Email:</td><td><input type="text" name="hour1" value="" size="10" class="form-control"/></td></tr>
				<tr><td>Address:</td><td><input type="text" name="hour1" value="" size="10" class="form-control"/></td></tr>				
			</table>			
	      </div>
	      <div class="modal-footer">
	      	<form class="form-inline" role="form">
	      		<div class="form-group">
    				<label class="sr-only" for="exampleInputPassword2">Password</label>
    				<input type="password" class="form-control" id="exampleInputPassword2" placeholder="Password">
  				</div>
	      		<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	        	<button type="button" class="btn btn-primary">Save changes</button>
      		</form>
	        
	      </div>
	    </div>
	  </div>
	</div>

	<!-- Modal WorkHour Edit-->
	<div class="modal fade" id="modalWorkHour" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	  <div class="modal-dialog">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
	        <h4 class="modal-title" id="myModalLabel">Muokkaa tietoja</h4>
	      </div>
	      <div class="modal-body">
	        <table class="table">
				<thead><h3>Päivän tunnit</h3></thead>
				<tr><td>Päivä:</td><td>2014-01-01</td></tr>
				<tr><td>Tunnit 6-22:</td><td><input type="text" name="hour1" value="" size="10" class="form-control"/></td></tr>
				<tr><td>Tunnit 22-6:</td><td><input type="text" name="hour1" value="" size="10" class="form-control"/></td></tr>
				<tr><td>Tunnit päivystys:</td><td><input type="text" name="hour1" value="" size="10" class="form-control"/></td></tr>				
			</table>			
	      </div>
	      <div class="modal-footer">
	      	<form class="form-inline" role="form">
	      		<div class="form-group">
    				<label class="sr-only" for="exampleInputPassword2">Password</label>
    				<input type="password" class="form-control" id="exampleInputPassword2" placeholder="Password">
  				</div>
	      		<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	      		<button type="button" class="btn btn-danger">Delete</button>
	        	<button type="button" class="btn btn-primary">Save changes</button>
      		</form>
	        
	      </div>
	    </div>
	  </div>
	</div>
</div>

