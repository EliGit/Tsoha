<h1>Ty&ouml;tuntikirjanpito</h1>

<form action="/hours/add" method="post">

<div>
	<table class="table table-striped">
		<tr>
			<th>P&auml;iv&auml;</th>
			<th>Asiakas</th>
			<th>Tekij&auml;(t)</th>
			<th>Kuvaus</th>
			<th>Tunnit 8-17</th>
			<th>Tunnit 17-8</th>
			<th>Laskutettu</th>
			<th>Poista</th>
		</tr>
	
	<?
	/*$billed = in('get','billed');
	if($billed != 1) {
		$billed = 0;
	}
	
	$hours = Hour::get_all($billed);
	
	*/
	
	foreach ($data->lista as $h) {

	?>
		
		
		
		
		<tr class="">
			<td style="padding: 5px;"><?echo $h['day']?></td>
			<td><?echo $h['customer']?></td>
			<td><?echo $h['people']?></td>
			<td><?echo $h['description']?></td>
			<td><?echo ($h['hours']?$h['hours']:'')?></td>
			<td><?echo ($h['offhours']?$h['offhours']:'')?></td>
			<td>ei</td>
			<td><button type="button" class="btn btn-danger">x</button></td>
			<!--<td><a style="color: black; text-decoration: none;" href="/hours/delete/<?echo $h['id']?>"><span class="icon-trash"></span></a></td>-->
		</tr>
		
		
		
		
	<?
		}
	?>

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

</form>