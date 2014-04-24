<h1>Hei <?echo $data->user?></h1>

<table class="table table-striped">
	<thead>
		<h3>Kuukauden Työtunnit</h3>
	</thead>
		<!--Table headers -->
		<tr>
			<th>P&auml;iv&auml;</th>
			<th>Tunnit 6-22</th>
			<th>Tunnit 22-6</th>
			<th>Tunnit päivystys</th>
			<th>Edit</th>
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
				<td><input type="text" name="day" value="<?echo date('Y-m-d')?>" class="form-control" size="10" /></td>
				<td><input type="text" name="hours" value="" size="10" class="form-control"/></td>
				<td><input type="text" name="offhours" value="" size="10" class="form-control"/></td>
				<td><input type="text" name="standbyhours" value="" size="10" class="form-control"/></td>			
				<td><button type="submit" name="add" class="btn btn-success">Submit</button></td>			
			</form>
		</tr>
		<!--/Table input row -->


		<!-- Monthly work hour controls-->
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


<!-- User info -->
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
        <table class="table">
        	<thead><h3>Käyttäjätiedot</h3></thead>
			<tr><td>Username:</td><td><?echo $data->user?></td></tr>
			<tr><td>Phone:</td><td><input type="text" name="userphone" id="" value="" size="10" class="form-control"/></td></tr>
			<tr><td>Email:</td><td><input type="text" name="useremail" id="" value="" size="10" class="form-control"/></td></tr>
			<tr><td>Address:</td><td><input type="text" name="useraddr" id="" value="" size="10" class="form-control"/></td></tr>				
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


<!-- Modal for WorkHour Edit-->
<div class="modal fade" id="modalWorkHour" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Muokkaa tietoja</h4>
      </div>
      <div class="modal-body">
      	<form action="/workhours/update" method="post">
      		<table class="table">
				<thead><h3>Päivän tunnit</h3></thead>
				<tr><td>Päivä:</td>     		<td><input type="text" name="day" id="day" value="" size="10" class="form-control"></td></tr>
				<tr><td>Tunnit 6-22:</td>		<td><input type="text" name="hours" id="hours" value="" size="10" class="form-control"/></td></tr>
				<tr><td>Tunnit 22-6:</td>		<td><input type="text" name="offhours" id="offhours" value="" size="10" class="form-control"/></td></tr>
				<tr><td>Tunnit päivystys:</td>	<td><input type="text" name="standbyhours" id="standbyhours" value="" size="10" class="form-control"/></td></tr>				
			</table>
			<input type="hidden" name="hiddenID" id="hiddenID_update" />
			<button type="submit" class="btn btn-primary">Save changes</button>
      	</form>
        
      </div>
      <div class="modal-footer">
      	<form class="form-inline" action="/workhours/destroy" method="post">
      		<div class="form-group">
				<label class="sr-only" for="exampleInputPassword2">Password</label>
				<input type="password" class="form-control" id="exampleInputPassword2" placeholder="Password">
			</div>
  			<input type="hidden" name="hiddenID" id="hiddenID_destroy" />
      		<button type="submit" class="btn btn-danger">Delete</button>        	
  		</form>
        
      </div>
    </div>
  </div>
</div>

