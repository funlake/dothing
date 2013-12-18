<form action="http://localhost:81/dothing/demo/index.php/autocrud/Update/group" method="post" id="Afm" name="Afm" class="form-horizontal">
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
			<input type="text" id="name" name="name" class="form-control" value="Administrators" required/>
		</div>
	</div>
	<div class="form-group">
		<label class="control-label col-lg-2" for="ordering">
			Ordering		</label>
		<div class="col-lg-4">
			<input type="text" id="ordering" name="ordering" class="form-control" value="30" />
		</div>
	</div>
	<div class="form-group">
		<label class="control-label col-lg-2" for="group_id">
			Parent		</label>
		<div class="col-lg-4">
			<select id="group" data-placeholder="=====No Parent======" class="chzn-select form-control"  tabindex="2" name="pid" default="0" disable="1">
				<option value="0"></option>
								
<?php $tree_3f49ea6b5c55db3359bfea974e5f7075=DOFactory::GetWidget("tree","default",array(DOFactory::GetModel(strtolower('Group'))->Select())) ?>
<?php echo $tree_3f49ea6b5c55db3359bfea974e5f7075->Render("
					<option value=\"{#id}\" parent=\"{#pid}\">[prefix]{#name}</option>
				"); ?>

			</select>
		</div>
	</div>
	<div class="form-group">
		<label class="control-label col-lg-2" for="role_id">
			Role		</label>
		<div class="col-lg-4">
			<select multiple data-placeholder="=======Choose roles======" class="chzn-select form-control"  tabindex="2" name="role_id[]" default="">
				<option value="0"></option>
								
<?php $tree_ec5e023b73fc58b64f0bcf47320fd259=DOFactory::GetWidget("tree","default",array(DOFactory::GetModel(strtolower('Role'))->Select())) ?>
<?php echo $tree_ec5e023b73fc58b64f0bcf47320fd259->Render("
					<option value=\"{#id}\" parent=\"{#pid}\">[prefix]{#name}</option>
				"); ?>

			</select>
		</div>
	</div>
		<div class="form-group">
		<label class="control-label col-lg-2" for="status">
			Status		</label>
		<div class="col-lg-4">
			<label class="radio-inline">
				<input id="status" name="state"  value="0" type="radio" /><label>No</label>
			</label>
			<label class="radio-inline">
				<input id="status" name="state"  value="1" type="radio" checked/><label>Yes</label>
			</label>
		</div>
	</div>
	<input type="hidden" id="__redirect" name="__redirect" value="http://localhost:81/dothing/demo/index.php/ads007/user/group"/>
	<input type="hidden" id="group_id" name="id" value="1"/>
	<input type="hidden" id="__token" name="__token" value="256e785a4c80f72278901fb767eb4bd1"/>
</form>