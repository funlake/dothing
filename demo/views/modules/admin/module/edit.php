<form action="http://localhost:81/dothing/demo/index.php/autocrud/Update/module" method="post" id="Afm" name="Afm" class="form-horizontal">
	<div class="row well">
		<div class="col-lg-8"><h4>Group / Update</h4></div>
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
			<input type="text" id="name" name="name" class="form-control" value="Permission" required/>
		</div>
	</div>
	<div class="form-group">
		<label class="control-label col-lg-2" for="interface">
			Interface		</label>
		<div class="col-lg-4">
			<input type="text" id="interface" name="interface" class="form-control" value="user/permission" />
		</div>
	</div>
	<div class="form-group">
		<label class="control-label col-lg-2" for="ordering">
			Ordering		</label>
		<div class="col-lg-4">
			<input type="text" id="ordering" name="ordering" class="form-control" value="2" />
		</div>
	</div>
		<div class="form-group">
		<label class="control-label col-lg-2" for="status">
			Core		</label>
		<div class="col-lg-4">
			<label class="radio-inline">
				<input id="status" name="iscore"  value="0" type="radio" />No			</label>
			<label class="radio-inline">
				<input id="status" name="iscore"  value="1" type="radio" checked/>Yes			</label>
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
	<input type="hidden" id="__redirect" name="__redirect" value="http://localhost:81/dothing/demo/index.php/ads007/module/"/>
	<input type="hidden" id="module_id" name="id" value="6"/>
	<input type="hidden" id="__token" name="__token" value="f47630a56a3a789e9803bf6cbf699280"/>
</form>