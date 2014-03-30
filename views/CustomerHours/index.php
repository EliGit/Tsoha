<h1>Asiakkaille laskutettavat tunnit</h1>

<p>

Lisäys ja luku tietokantayhteys ok. Update ja Destroy tapahtuu Bootstrap modalin kautta, mutta näitä ei vielä toteutettu.

</p>

<form action="/hours/add" method="post">

<div>
	<table class="table table-striped">
		<!--Table headers -->
		<tr>
			<th>P&auml;iv&auml;</th>
			<th>Asiakas</th>
			<th>Tekij&auml;(t)</th>
			<th>Kuvaus</th>
			<th>Tunnit 8-17</th>
			<th>Tunnit 17-8</th>
			<th>Laskutettu</th>
			<th>Edit</th>
		</tr>
		<!--Table content -->
		<? foreach ($data->lista as $h) { ?>

			<tr class="">
				<td style="padding: 5px;"><?echo $h['day']?></td>
				<td><?echo $h['customer']?></td>
				<td><?echo $h['people']?></td>
				<td><?echo $h['description']?></td>
				<td><?echo ($h['hours']?$h['hours']:'')?></td>
				<td><?echo ($h['offhours']?$h['offhours']:'')?></td>
				<td>ei</td>
				<td><button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modalHour">x</button></td>			
			</tr>
		<? } ?>

		<!--Table input -->
		<tr>
			<td><input type="text" name="day" value="<?echo date('Y-m-d')?>" class="form-control" size="10" /></td>
			<td><input type="text" name="customer" value="" size="20" class="form-control"/></td>
			<td><input type="text" name="people" value="<?echo "username"?>" size="10" class="form-control"/></td>
			<td><input type="text" name="description" value="" size="40" placeholder="Lyhyt kuvaus" class="form-control"/></td>
			<td><input type="text" name="hours" value="" size="2" class="form-control"/></td>
			<td><input type="text" name="offhours" value="" size="2" class="form-control"/></td>
			<td><button type="submit" name="add" class="btn btn-success">Submit</button></td>			
			<td></td>
		</tr>
	</table>
</div>


<!-- Modal for CustomerHour Edit-->
	<div class="modal fade" id="modalHour" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	  <div class="modal-dialog">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
	        <h4 class="modal-title" id="myModalLabel">Muokkaa tietoja</h4>
	      </div>
	      <div class="modal-body">
	        <table class="table">
				<thead><h3>Asiakaslaskutus</h3></thead>
				<tr><td>Päivä:</td><td>2014-01-01</td></tr>
				<tr><td>Asiakas:</td><td><input type="text" name="hour1" value="" size="10" class="form-control"/></td></tr>
				<tr><td>Tekijät:</td><td><input type="text" name="hour1" value="" size="10" class="form-control"/></td></tr>
				<tr><td>Kuvaus:</td><td><input type="text" name="hour1" value="" size="10" class="form-control"/></td></tr>
				<tr><td>Tunnit 8-17:</td><td><input type="text" name="hour1" value="" size="10" class="form-control"/></td></tr>
				<tr><td>Tunnit 17-8:</td><td><input type="text" name="hour1" value="" size="10" class="form-control"/></td></tr>
				<tr><td>Laskutettu:</td><td><input type="checkbox"></td></tr>
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

</form>