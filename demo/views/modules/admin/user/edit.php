<form action="http://localhost:81/dothing/demo/index.php/autocrud/Add/user" method="post" id="Afm" name="Afm" class="form-horizontal">
	<div class="row well">
		<div class="col-lg-8"><h4>User / Add</h4></div>
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
		<label class="control-label col-lg-2" for="user_name">
			Name		</label>
		<div class="col-lg-4">
			<input type="text" id="user_name" name="user_name" class="form-control" value="" required/>
		</div>
			<label class="control-label col-lg-2" for="user_pass">
			Password		</label>
		<div class="col-lg-4">
			<input type="password" id="user_pass" name="user_pass" class="form-control"  value="" required/>
		</div>
		</div>
	<div class="form-group">
		<label class="control-label col-lg-2" for="group_id">
			Group		</label>
		<div class="col-lg-4">
			<select multiple data-placeholder="=======No group======" class="chzn-select form-control"  tabindex="2" name="group_id[]" default="">
				<option value="0"></option>
								
<?php $tree_d9519bffeab56c756f320c73e79f4373=DOFactory::GetWidget("tree","default",array(DOFactory::GetModel(strtolower('Group'))->Find())) ?>
<?php echo $tree_d9519bffeab56c756f320c73e79f4373->Render("
					<option value=\"{#id}\">[prefix]{#name}</option>
				"); ?>

			</select>
		</div>
	</div>
	<div class="form-group">
		<label class="control-label col-lg-2" for="role_id">
			Role		</label>
		<div class="col-lg-4">
			<select multiple data-placeholder=" " class="chzn-select form-control"  tabindex="2" name="role_id[]" default="">
				<option value="0"></option>
								
<?php $tree_7ac15810907640e63e1f7f14c03ac692=DOFactory::GetWidget("tree","default",array(DOFactory::GetModel(strtolower('Role'))->Select())) ?>
<?php echo $tree_7ac15810907640e63e1f7f14c03ac692->Render("
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
	<input type="hidden" id="__redirect" name="__redirect" value="http://localhost:81/dothing/demo/index.php/ads007/user/index"/>
	<input type="hidden" id="user_id" name="id" value=""/>
	<input type="hidden" id="__token" name="__token" value="f231e2a0b3f39a9228ef2c0624ac80b3"/>
</form>