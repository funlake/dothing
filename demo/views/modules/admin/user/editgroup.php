<form action="http://localhost/dothing/demo/index.php/autocrud/Update/group" method="post" id="Afm" name="Afm" class="form-horizontal">
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
			<input type="text" id="name" name="name" class="form-control" value="Manager" required/>
		</div>
	</div>
	<div class="form-group">
		<label class="control-label col-lg-2" for="ordering">
			Ordering		</label>
		<div class="col-lg-4">
			<input type="text" id="ordering" name="ordering" class="form-control" value="22" />
		</div>
	</div>
	<div class="form-group">
		<label class="control-label col-lg-2" for="group_id">
			Parent		</label>
		<div class="col-lg-4">
			<select id="group" data-placeholder="=====No Parent======" class="chzn-select form-control"  tabindex="2" name="pid" default="1" disable="4">
				<option value="0"></option>
								
<?php $tree_e5754fa572cfa4020eb920a733a0daf2=DOFactory::GetWidget("tree","default",array(DOFactory::GetModel(strtolower('Group'))->Select())) ?>
<?php echo $tree_e5754fa572cfa4020eb920a733a0daf2->Render("
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
								
<?php $tree_5daec6d4c419e0961b4f0774a5b5b3b1=DOFactory::GetWidget("tree","default",array(DOFactory::GetModel(strtolower('Role'))->Select())) ?>
<?php echo $tree_5daec6d4c419e0961b4f0774a5b5b3b1->Render("
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
	<input type="hidden" id="__redirect" name="__redirect" value="http://localhost/dothing/demo/index.php/ads007/user/group"/>
	<input type="hidden" id="group_id" name="id" value="4"/>
	<input type="hidden" id="__token" name="__token" value="0a5e5cca1bd035c6cf2ffaa0b3a920b7"/>
</form>