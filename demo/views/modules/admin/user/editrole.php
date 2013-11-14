	<form action="http://localhost:81/dothing/demo/index.php/autocrud/Update/role" method="post" id="Afm" name="Afm" class="form-horizontal">
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
				Name			</label>
			<div class="col-lg-4">
				<input type="text" id="name" name="name" class="form-control" value="Manager" required/>
			</div>
		</div>
		<div class="form-group">
			<label class="control-label col-lg-2" for="group_id">
				Parent			</label>
			<div class="col-lg-4">
				<select id="group" data-placeholder="=====No Parent======" class="chzn-select form-control"  tabindex="2" name="pid" default="2" disable="6">
					<option value="0"></option>
									
<?php $tree_7f179f80165e6676d09a822b135e7cdc=DOFactory::GetWidget("tree","default",array(DOFactory::GetModel(strtolower('Role'))->Select())) ?>
<?php echo $tree_7f179f80165e6676d09a822b135e7cdc->Render("
						<option value=\"{#id}\" parent=\"{#pid}\">[prefix]{#name}</option>
					"); ?>

				</select>
			</div>
		</div>
				<div class="form-group">
			<label class="control-label col-lg-2" for="status">
				Status			</label>
			<div class="col-lg-4">
				<label class="radio-inline">
					<input id="status" name="state" value="0" type="radio" />No
				</label>
				<label class="radio-inline">
					<input id="status" name="state" value="1" type="radio" checked/>Yes
				</label>
			</div>
		</div>
		<input type="hidden" id="__redirect" name="__redirect" value="http://localhost:81/dothing/demo/index.php/ads007/user/role"/>
		<input type="hidden" id="role_id" name="id" value="6"/>
		<input type="hidden" id="__token" name="__token" value="edda04784aeb2336cac254663b6c7c4e"/>
	</form>