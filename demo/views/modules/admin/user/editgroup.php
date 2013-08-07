<div class="well">
	<form action="http://localhost:81/dothing/demo/index.php/autocrud/Add/group" method="post" id="Afm" name="Afm" class="form-horizontal">
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
				<input type="text" id="name" name="name" class="input-xlarge" value="" required/>
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" for="ordering">
				Ordering			</label>
			<div class="controls">
				<input type="text" id="ordering" name="ordering" class="input-xlarge" value="" />
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" for="group_id">
				Parent			</label>
			<div class="controls">
				<select required id="group" data-placeholder="=====No Parent======" class="chzn-select"  tabindex="2" name="pid" default="" disable="">
					<option value="0"></option>
									
<?php $tree_6d11bfac6e4b25c11470552324bddb0d=DOFactory::GetWidget("tree","default",array(DOFactory::GetModel(strtolower('Group'))->Select())) ?>
<?php echo $tree_6d11bfac6e4b25c11470552324bddb0d->Render("
						<option value=\"{#id}\" parent=\"{#pid}\">[prefix]{#name}</option>
					"); ?>

				</select>
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" for="role_id">
				Role			</label>
			<div class="controls">
				<select multiple data-placeholder="=======Choose roles======" class="chzn-select"  tabindex="2" name="role_id[]" default="">
					<option value="0"></option>
									
<?php $tree_7b2f33f6ebcaff5552722e38b98734de=DOFactory::GetWidget("tree","default",array(DOFactory::GetModel(strtolower('Role'))->Select())) ?>
<?php echo $tree_7b2f33f6ebcaff5552722e38b98734de->Render("
						<option value=\"{#id}\" parent=\"{#pid}\">[prefix]{#name}</option>
					"); ?>

				</select>
			</div>
		</div>
				<div class="control-group">
			<label class="control-label" for="status">
				Status			</label>
			<div class="controls">
				<input id="status" name="state" value="0" type="radio" checked/>No
				<input id="status" name="state" value="1" type="radio" />Yes
			</div>
		</div>
	</fieldset>
		<input type="hidden" id="__redirect" name="__redirect" value="http://localhost:81/dothing/demo/index.php/ads007/user/group"/>
		<input type="hidden" id="group_id" name="id" value=""/>
		<input type="hidden" id="__token" name="__token" value="513cc79af0ce738d69dd079560462b45"/>
	</form>
</div>