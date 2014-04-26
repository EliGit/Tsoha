<?if(!isset($_SESSION["user"])){ ?>
	<div class="col-sm-6">
		<form class="form-horizontal" role="form" action="/login/" method="POST">
		  <div class="form-group">
		    <label class="col-sm-2 control-label">Username</label>
		    <div class="col-sm-10">
		      <input class="form-control" placeholder="Username" name="username">
		    </div>
		  </div>
		  <div class="form-group">
		    <label for="inputPassword3" class="col-sm-2 control-label">Password</label>
		    <div class="col-sm-10">
		      <input type="password" class="form-control" id="inputPassword3" placeholder="Password" name="password">
		    </div>
		  </div>		  
		  <div class="form-group">
		    <div class="col-sm-offset-2 col-sm-10">
		      <button type="submit" class="btn btn-default">Sign in</button>
		    </div>
		  </div>
		  <? if(isset($data->login)){ ?>
			<p>Login <?echo $data->login?> </p>
		<? } ?>
		</form>
	</div>
<?}else {?>

<h1>Tervetuloa</h1>

	<? if(isset($data->login)){ ?>
		<p>Login <?echo $data->login?> </p>
	<? } ?>

<?}?>