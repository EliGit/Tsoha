<h1>Asiakkaille laskutettavat tunnit</h1>



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

			<tr class=<?echo '"'.$h['id'].'"' ?> >
				<td style="padding: 5px;"><?echo $h['day']?></td>
				<td><?echo $h['customer']?></td>
				<td><?echo implode(',', $h['people']) ?></td>
				<td><?echo $h['description']?></td>
				<td><?echo ($h['hours']?$h['hours']:'')?></td>
				<td><?echo ($h['offhours']?$h['offhours']:'')?></td>
				<td><?if($h['billed']==1){ echo "true";} else {echo "false";} ?></td>
				<td><button data-id=<?echo '"'.$h['id'].'"' ?> type="button" class="modalopener btn btn-danger" data-toggle="modal" data-target="#modalHour">x</button></td>			
			</tr>
		<? } ?>
		<!-- /Table content -->

		<!-- Transfer data to modal -->
		<script>
		$(document).on('click', ".modalopener", function() {
			var date = $("." + $(this).data('id') + " td:nth-child(1)").text();
			var customer = $("." + $(this).data('id') + " td:nth-child(2)").text();
			var people = $("." + $(this).data('id') + " td:nth-child(3)").text();
			var description = $("." + $(this).data('id') + " td:nth-child(4)").text();
			var hours = $("." + $(this).data('id') + " td:nth-child(5)").text();
			var offhours = $("." + $(this).data('id') + " td:nth-child(6)").text();
			var billed = $("." + $(this).data('id') + " td:nth-child(7)").text();
			var id = $(this).data('id')
			//$("#hour1").val(id);
			$("#day").val(date)
			$("#customer").val(customer)
			$("#people").val(people)
			$("#description").val(description)
			$("#hours").val(hours)
			$("#offhours").val(offhours)
			$("#hiddenID_update").val(id)
			$("#hiddenID_destroy").val(id)
			if(billed=="true"){
				$('#billed').prop('checked', true);	
			}
			
		});
		</script>
		<!-- /Transfer data to modal -->

		<!--Table input row -->
		<tr>
			<form action="/hours/add" method="post">
				<td><input type="text" name="day" value="<?echo $data->uparams[0];?>" class="form-control" size="10" /></td>
				<td><input type="text" name="customer" value="<?echo $data->uparams[1];?>" size="20" class="form-control"/></td>
				<td><input type="text" name="people" value="<?echo $data->uparams[2];?>" size="10" class="form-control"/></td>
				<td><input type="text" name="description" size="40" value="<?echo $data->uparams[3];?>" class="form-control"/></td>
				<td><input type="text" name="hours" value="<?echo $data->uparams[4];?>" size="2" class="form-control"/></td>
				<td><input type="text" name="offhours" value="<?echo $data->uparams[5];?>" size="2" class="form-control"/></td>
				<td><button type="submit" class="btn btn-success">Submit</button></td>			
				<td></td>
			</form>
		</tr>
		<!--/Table input row -->
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
	      	<form action="/hours/update" method="post">
		        <table class="table">
					<thead><h3>Asiakaslaskutus</h3></thead>
					<tr><td>Päivä:</td>       <td><input type="text" name="day" id="day" value="" size="10" class="form-control"></td></tr>
					<tr><td>Asiakas:</td>     <td><input type="text" name="customer" id="customer" value="" size="10" class="form-control"/></td></tr>
					<tr><td>Tekijät:</td>     <td><input type="text" name="people" id="people" value="" size="10" class="form-control"/></td></tr>
					<tr><td>Kuvaus:</td>      <td><input type="text" name="description" id="description" value="" size="10" class="form-control"/></td></tr>
					<tr><td>Tunnit 8-17:</td> <td><input type="text" name="hours" id="hours" value="" size="10" class="form-control"/></td></tr>
					<tr><td>Tunnit 17-8:</td> <td><input type="text" name="offhours" id="offhours" value="" size="10" class="form-control"/></td></tr>
					<tr><td>Laskutettu:</td>  <td><input type="checkbox" name="billed" id="billed" value="true"></td></tr>
				</table>
				<input type="hidden" name="hiddenID" id="hiddenID_update" />
				<button type="submit" class="btn btn-primary">Save changes</button>
			</form>
	      </div>
	      <div class="modal-footer">
	      	<form class="form-inline" action="/hours/destroy" method="post">	      		
	      		<div class="form-group">
    				<label class="sr-only" for="exampleInputPassword2">Password</label>
    				<input type="password" class="form-control" name="password" placeholder="Password">
  				</div>  				
  				<input type="hidden" name="hiddenID" id="hiddenID_destroy" />
	      		<button type="submit" class="btn btn-danger">Delete</button>	        	
      		</form>
      		<!--<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>-->
	        
	      </div>
	    </div>
	  </div>
	</div>

