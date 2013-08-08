<form action="http://localhost:81/dothing/demo/index.php/autocrud/Update/user" method="post" id="Afm" name="Afm" class="form-horizontal">
	<div class="row well">
		<div class="col-lg-8"><h4>User / Update</h4></div>
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
			<input type="text" id="user_name" name="user_name" class="form-control" value="admin" required/>
		</div>
		</div>
	<div class="form-group">
		<label class="control-label col-lg-2" for="group_id">
			Group		</label>
		<div class="col-lg-4">
			<select multiple data-placeholder="=======No group======" class="chzn-select form-control"  tabindex="2" name="group_id[]" default="1">
				<option value="0"></option>
								
<?php $tree_bd7525e02d0f883bc09d6ba592947b22=DOFactory::GetWidget("tree","default",array(DOFactory::GetModel(strtolower('Group'))->Find())) ?>
<?php echo $tree_bd7525e02d0f883bc09d6ba592947b22->Render("
					<option value=\"{#id}\">[prefix]{#name}</option>
				"); ?>

			</select>
		</div>
	</div>
	<div class="form-group">
		<label class="control-label col-lg-2" for="role_id">
			Role		</label>
		<div class="col-lg-4">
			<select multiple data-placeholder=" " class="chzn-select form-control"  tabindex="2" name="role_id[]" default="2">
				<option value="0"></option>
								
<?php $tree_9733ffc64c56265dbe0659b298b39d7a=DOFactory::GetWidget("tree","default",array(DOFactory::GetModel(strtolower('Role'))->Select())) ?>
<?php echo $tree_9733ffc64c56265dbe0659b298b39d7a->Render("
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
				<input id="status" name="state"  value="0" type="radio" />No			</label>
			<label class="radio-inline">
				<input id="status" name="state"  value="1" type="radio" checked/>Yes			</label>
		</div>
	</div>
	<input type="hidden" id="__redirect" name="__redirect" value="http://localhost:81/dothing/demo/index.php/ads007/user/index"/>
	<input type="hidden" id="user_id" name="id" value="12"/>
	<input type="hidden" id="__token" name="__token" value="84c8be470859f3777a7f33c9c3d5a9c5"/>
</form>