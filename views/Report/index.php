<h1>Yhteenveto</h1>

<p>Aggregoitu yhteenveto käyttäjien HYVÄKSYTYISTÄ työtunneista. Ei hyväksyttyjä tunteja ja hyväksyttyjen tuntien kuukausittainen tarkastelu käyttäjän sivuilta.</p>

<div class="container">
	<h1>Käyttäjät</h1>
	<table class="table table-striped">
		<tr>
			<th>Username</th>
			<th>Total hours</th>
			<th>Total offhours</th>
			<th>Total standby hours</th>
		</tr>
	<? foreach ($data->lista as $h) { ?>
		<tr class="">
			<td><?echo $h['username']?></td>
			<td><?echo $h['thours']?></td>
			<td><?echo $h['toffhours']?></td>
			<td><?echo $h['tstandbyhours']?></td>
		</tr>	
	<? } ?>
	</table>
</div>
