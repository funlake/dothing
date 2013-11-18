<form action="http://localhost:81/dothing/demo/index.php/autocrud/Add/group" method="post" id="Afm" name="Afm" class="form-horizontal">
	<div class="row well">
		<div class="col-lg-8"><h4>Group / Add</h4></div>
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
			<input type="text" id="name" name="name" class="form-control" value="" required/>
		</div>
	</div>
	<div class="form-group">
		<label class="control-label col-lg-2" for="ordering">
			Ordering		</label>
		<div class="col-lg-4">
			<input type="text" id="ordering" name="ordering" class="form-control" value="" />
		</div>
	</div>
	<div class="form-group">
		<label class="control-label col-lg-2" for="group_id">
			Parent		</label>
		<div class="col-lg-4">
			<select id="group" data-placeholder="=====No Parent======" class="chzn-select form-control"  tabindex="2" name="pid" default="" disable="">
				<option value="0"></option>
								
<?php $tree_b8394a7b404c9ff4e8f21ae97688f338=DOFactory::GetWidget("tree","default",array(DOFactory::GetModel(strtolower('Group'))->Select())) ?>
<?php echo $tree_b8394a7b404c9ff4e8f21ae97688f338->Render("
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
								
<?php $tree_5aeb98ecd67e377ec2f1d13763b0dbe1=DOFactory::GetWidget("tree","default",array(DOFactory::GetModel(strtolower('Role'))->Select())) ?>
<?php echo $tree_5aeb98ecd67e377ec2f1d13763b0dbe1->Render("
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
				<input id="status" name="state"  value="0" type="radio" checked/>No			</label>
			<label class="radio-inline">
				<input id="status" name="state"  value="1" type="radio" />Yes			</label>
		</div>
	</div>
	<input type="hidden" id="__redirect" name="__redirect" value="http://localhost:81/dothing/demo/index.php/ads007/user/group"/>
	<input type="hidden" id="group_id" name="id" value=""/>
	<input type="hidden" id="__token" name="__token" value="ecf622e8910b4c539f29975aee27fbe6"/>
</form>