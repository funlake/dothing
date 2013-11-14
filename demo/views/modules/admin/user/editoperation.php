<form action="http://localhost:81/dothing/demo/index.php/autocrud/Update/operation" method="post" id="Afm" name="Afm" class="form-horizontal">
	<div class="row well">
		<div class="col-lg-8"><h4>Operation / Update</h4></div>
		<div class="col-lg-4 text-right">
		  <button class="btn btn-success" id="submitForm">
		  	<i class="glyphicon glyphicon-ok glyphicon-white"></i>
		  	Apply		  </button>
		  <button class="btn btn-danger" onclick="location.href=$('#__redirect').val();return false;">
		  	<i class="glyphicon glyphicon-remove glyphicon-white"></i>
		  	Cancel		  </button>
		</div>
	</div>
	<div class="form-group">
		<label class="control-label col-lg-2" for="name">
			Name		</label>
		<div class="col-lg-4">
			<input type="text" id="name" name="name" class="form-control" value="Access" required/>
		</div>
	</div>
	<div class="form-group">
		<label class="control-label col-lg-2" for="ordering">
			Ordering		</label>
		<div class="col-lg-4">
			<input type="text" id="ordering" name="ordering" class="form-control" value="45" required/>
		</div>
	</div>
	<div class="form-group">
		<label class="control-label col-lg-2" for="description">
			Description		</label>
		<div class="col-lg-4">
			<textarea id="description" name="description" class="form-control" rows="3">Access module page</textarea>
		</div>
	</div>
		<div class="form-group">
		<label class="control-label col-lg-2" for="status">
			Status		</label>
		<div class="col-lg-4">
			<label class="radio-inline">
				<input id="status" name="state"  value="0" type="radio" />No			</label>
			<label class="radio-inline">
				<input id="status" name="state"  value="1" type="radio" checked/>Yes			</label>
		</div>
	</div>
	<input type="hidden" id="__redirect" name="__redirect" value="http://localhost:81/dothing/demo/index.php/ads007/user/operation"/>
	<input type="hidden" id="id" name="id" value="1"/>
	<input type="hidden" id="__token" name="__token" value="cab2d0468e2fdd6058af3a7de0d7ae74"/>
</form>