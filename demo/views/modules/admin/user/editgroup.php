<div class="well">
	<form action="http://localhost:81/dothing/demo/index.php/autocrud/Update/group" method="post" id="Afm" name="Afm" class="form-horizontal">
	<fieldset>
		<legend>
			<a>Group > Edit</a>
			<div class="pull-right">
			  <button class="btn btn-success" id="submitForm">
			  	<i class="icon-ok icon-white"></i>
			  	Apply			  </button>
			  <button class="btn btn-warning" onclick="location.href=$('#__redirect').val();return false;">
			  	<i class="icon-remove icon-white"></i>
			  	Cancel			  </button>
			</div>
		</legend>
		<div class="control-group">
			<label class="control-label" for="name">
				Name			</label>
			<div class="controls">
				<input type="text" id="name" name="name" class="input-xlarge" value="Register" required/>
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" for="ordering">
				Ordering			</label>
			<div class="controls">
				<input type="text" id="ordering" name="ordering" class="input-xlarge" value="15" />
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" for="group_id">
				Parent			</label>
			<div class="controls">
				<select id="group" data-placeholder="=====No Parent======" class="chzn-select"  tabindex="2" name="pid" default="1" disable="5">
					<option value="0"></option>
									
<?php $tree_63b2acf1057911affffa12e39256dd17=DOFactory::GetWidget("tree","default",array(DOFactory::GetModel(strtolower('Group'))->Select())) ?>
<?php echo $tree_63b2acf1057911affffa12e39256dd17->Render("
						<option value=\"{#id}\" parent=\"{#pid}\">[prefix]{#name}</option>
					"); ?>

				</select>
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" for="role_id">
				Role			</label>
			<div class="controls">
				<select multiple data-placeholder="=======Choose roles======" class="chzn-select"  tabindex="2" name="role_id[]" default="5">
					<option value="0"></option>
									
<?php $tree_fcc6fc7c35445910beb7aed756d84cd3=DOFactory::GetWidget("tree","default",array(DOFactory::GetModel(strtolower('Role'))->Select())) ?>
<?php echo $tree_fcc6fc7c35445910beb7aed756d84cd3->Render("
						<option value=\"{#id}\" parent=\"{#pid}\">[prefix]{#name}</option>
					"); ?>

				</select>
			</div>
		</div>
				<div class="control-group">
			<label class="control-label" for="status">
				Status			</label>
			<div class="controls">
				<input id="status" name="state" value="0" type="radio" />No
				<input id="status" name="state" value="1" type="radio" checked/>Yes
			</div>
		</div>
	</fieldset>
		<input type="hidden" id="__redirect" name="__redirect" value="http://localhost:81/dothing/demo/index.php/ads007/user/group"/>
		<input type="hidden" id="group_id" name="id" value="5"/>
		<input type="hidden" id="__token" name="__token" value="1605428b8ce3681007373a828edbb56c"/>
	</form>
</div>