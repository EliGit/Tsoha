<h1>Käyttäjä: <?echo $data->user['username']?></h1>

<p>Merkkaa päivittäiset työtuntisi. Kun kuukauden tunnit on merkattu ja olet vakuuttunut, että ne ovat merkattu oikeiksi, voit hyväksyä ne.
   Hyväksytyt tunnit poistuvat näkyvistä, mutta niitä voidaan tarkastella kuukausittain. </p>

<?if($_SESSION['rank']==1) { ?> 
	<p>ADMIN: Pystyt vain tarkastelemaan tietoa tai poistamaan käyttäjän. Et voi muokata käyttäjän tunteja tai tietoja. </p>
<?} ?>

<table class="table table-striped">
	<thead>
		<h3>Kuukauden Työtunnit</h3>
	</thead>
		<!--Table headers -->
		<tr>
			<th>P&auml;iv&auml;</th>
			<th>Tunnit 6-22</th>
			<th>Tunnit 22-6</th>
			<th>Tunnit standby</th>
			<th>Edit</th>
		</tr>

		<!-- helper function for totals -->
		<?
		function total($field, $data) {
			$acc=0;			
			foreach ($data->lista as $h) {
				$acc += $h[$field];
			}
			return $acc;
		}
		?>
		<tr>
			<th>TOTAL (kuukausi)</th>
			<th><?echo total('hours', $data); ?></th>
			<th><?echo total('offhours', $data); ?></th>
			<th><?echo total('standbyhours', $data); ?></th>
			<th></th>
		</tr>

		<!--Table content -->
		<?	foreach ($data->lista as $h) { ?>
		<tr class=<?echo '"'.$h['id'].'"' ?> >
			<td style="padding: 5px;"><?echo $h['day']?></td>
			<td><?echo $h['hours']?></td>
			<td><?echo $h['offhours']?></td>
			<td><?echo $h['standbyhours']?></td>			
			<td><button data-id=<?echo '"'.$h['id'].'"' ?> type="button" class="modalopener btn btn-danger" data-toggle="modal" data-target="#modalWorkHour">x</button></td>
		</tr>
		<? } ?>
		<!-- /Table content -->

		<!-- Transfer data to modal -->
		<script>
			$(document).on('click', ".modalopener", function() {
				var date = $("." + $(this).data('id') + " td:nth-child(1)").text();
				var hours = $("." + $(this).data('id') + " td:nth-child(2)").text();
				var offhours = $("." + $(this).data('id') + " td:nth-child(3)").text();
				var standbyhours = $("." + $(this).data('id') + " td:nth-child(4)").text();
				var id = $(this).data('id')


				$("#day").val(date)
				$("#hours").val(hours)
				$("#offhours").val(offhours)
				$("#standbyhours").val(standbyhours)		
				$("#hiddenID_update").val(id)
				$("#hiddenID_destroy").val(id)	
			});
		</script>
		<!-- /Transfer data to modal -->

		<!--Table input row -->
		<tr>
			<form action="/workhours/create" method="post">
				<input type="hidden" name="user" value=<?echo '"'.$data->user['username'].'"' ?>>
				<td><input type="text" name="day" value="<?if($data->uparams['day']){echo $data->uparams['day'];} else {echo date('Y-m-d');}?>" class="form-control" size="10" /></td>
				<td><input type="text" name="hours" value=<?echo '"'. $data->uparams['hour1'] .'"';?> size="10" class="form-control"/></td>
				<td><input type="text" name="offhours" value=<?echo '"'. $data->uparams['hour2'] .'"';?> size="10" class="form-control"/></td>
				<td><input type="text" name="standbyhours" value=<?echo '"'. $data->uparams['hour3'] .'"';?> size="10" class="form-control"/></td>			
				<td><button type="submit" name="add" class="btn btn-success">Submit</button></td>			
			</form>
		</tr>
		<!--/Table input row -->


		<!-- Monthly work hour controls-->
		<tr>
			<form action="/users/approve/" method="post" onsubmit="return confirm('HUOM! Hyväksymällä vakuutat tunnit oikein merkatuiksi.')">
				<input type="hidden" name="u" value=<?echo '"'.$data->user['username'].'"' ?> size="10" class="form-control">
				<td><button type="submit" class="btn btn-primary">Hyväksy tunnit</button></td>
			</form>
			<td></td>
			<form action="" method="GET">
				<input type="hidden" name="u" value=<?echo '"'.$data->user['username'].'"' ?> size="10" class="form-control">
				<td><input type="text" name="m" value="YYYY-MM" size="10" class="form-control"></td>
				<td>					
					<button type="submit" class="btn btn-primary">Tarkastele hyväksyttyjä</button>
				</td>
			</form>
		</tr>
</table>	



<!-- User info -->
<div class="col-md-4"> 
	<table class="table">
		<thead><h3>Käyttäjätiedot</h3></thead>
		<tr><td>Username:</td>	<td><?echo $data->user['username']?></td></tr>
		<tr><td>Firstname:</td>	<td><?echo $data->user['firstname']?></td></tr>
		<tr><td>Lastname:</td>	<td><?echo $data->user['lastname']?></td></tr>		
		<tr><td>Phone:</td>		<td><?echo $data->user['phone']?></td></tr>
		<tr><td>Email:</td>		<td><?echo $data->user['email']?></td></tr>
		<tr><td>Address:</td>	<td><?echo $data->user['address']?></td></tr>
		<tr><td><button class="usermodalopener btn btn-primary" data-toggle="modal" data-target="#modalUser">Edit</button></td>
			<td>
				<?if($_SESSION['rank']==1) { ?>

				<form class="form-inline" action="/users/destroy" method="post">
					<input type="hidden" name="username" value=<?echo '"' . $data->user['username'] . '"';?> />
					<input type="password" name="password" size="10" />
					<button type="submit" class="btn btn-danger">Delete</button>        	
				</form>
				<? }?>
			</td>
		</tr>
	</table>

	<!-- Button trigger modal -->
	
</div>



<!-- ............... MODALS ................ -->
 	



<!-- Modal User Edit-->
<div class="modal fade" id="modalUser" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Muokkaa tietoja</h4>        
      </div>
      <div class="modal-body">
      	<p>Kaikki muutokset vaativat salasanan.</p>
      	<form action="/users/update" method="post">
	        <table class="table">
	        	<thead><h3>Käyttäjätiedot</h3></thead>
				<tr><td>Username:</td><td><?echo $data->user['username']?></td></tr>
				<tr><td>Firstname:</td><td><input type="text" name="firstname" value=<?echo '"' . $data->user['firstname'] . '"';?> size="10" class="form-control"/></td></tr>
				<tr><td>Lastname:</td><td><input type="text" name="lastname" value=<?echo '"' . $data->user['lastname'] . '"';?> size="10" class="form-control"/></td></tr>
				<tr><td>Phone:</td><td><input type="text" name="userphone" value=<?echo '"' . $data->user['phone'] . '"';?> size="10" class="form-control"/></td></tr>
				<tr><td>Email:</td><td><input type="text" name="useremail" value=<?echo '"' . $data->user['email'] . '"';?> size="10" class="form-control"/></td></tr>
				<tr><td>Address:</td><td><input type="text" name="useraddr" value=<?echo '"' . $data->user['address'] . '"';?> size="10" class="form-control"/></td></tr>
				<tr><td><b>Optional:</b></td><td></td></tr>
				<tr><td>New password:</td><td><input type="password" name="password1" value="" size="10" class="form-control"/></td></tr>
				<tr><td>New passford confirmation:</td><td><input type="password" name="password2" value="" size="10" class="form-control"/></td></tr>
			</table>						
      </div>
      <div class="modal-footer">      	
		<label class="sr-only" for="exampleInputPassword2">Password</label>
		<input type="password" class="form-control" name="password" placeholder="Password">
		<input type="hidden" name="username" value=<?echo '"' . $data->user['username'] . '"';?> />
		<button type="submit" class="btn btn-primary">Save changes</button>	
      </div>
      </form>
    </div>
  </div>
</div>


<!-- Modal for WorkHour Edit-->
<div class="modal fade" id="modalWorkHour" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Muokkaa tietoja</h4>
      </div>
      <div class="modal-body">
      	<p>Poistaminen vaatii salasanan.</p>
      	<form action="/workhours/update" method="post">
      		<table class="table">
				<thead><h3>Päivän tunnit</h3></thead>
				<tr><td>Päivä:</td>     		<td><input type="text" name="day" id="day" value="" size="10" class="form-control"></td></tr>
				<tr><td>Tunnit 6-22:</td>		<td><input type="text" name="hours" id="hours" value="" size="10" class="form-control"/></td></tr>
				<tr><td>Tunnit 22-6:</td>		<td><input type="text" name="offhours" id="offhours" value="" size="10" class="form-control"/></td></tr>
				<tr><td>Tunnit päivystys:</td>	<td><input type="text" name="standbyhours" id="standbyhours" value="" size="10" class="form-control"/></td></tr>				
			</table>
			<input type="hidden" name="hiddenID" id="hiddenID_update" />
			<input type="hidden" name="user" value=<?echo '"'.$data->user['username'].'"' ?>>
			<button type="submit" class="btn btn-primary">Save changes</button>
      	</form>
        
      </div>
      <div class="modal-footer">
      	<form class="form-inline" action="/workhours/destroy" method="post">
      		<div class="form-group">
				<label class="sr-only" for="exampleInputPassword2">Password</label>
				<input type="password" class="form-control" name="password" placeholder="Password">
			</div>
  			<input type="hidden" name="hiddenID" id="hiddenID_destroy" />  			
  			<input type="hidden" name="user" value=<?echo '"'.$data->user['username'].'"' ?>>
      		<button type="submit" class="btn btn-danger">Delete</button>        	
  		</form>
        
      </div>
    </div>
  </div>
</div>

