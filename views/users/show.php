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
			<th>Poista</th>
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
			<td><button type="button" class="btn btn-danger">x</button></td>
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
			<td><button type="submit" name="add" class="btn btn-primary">Hyväksy kuukauden tunnit</button></td>
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
</div>