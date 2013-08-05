<div class="well">
	<form action="http://localhost/dothing/demo/index.php/autocrud/Update/role" method="post" id="Afm" name="Afm" class="form-horizontal">
	<fieldset>
		<legend>
			<a>Role > Update</a>
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
			<label class="control-label" for="group_id">
				Parent			</label>
			<div class="controls">
				<select id="group" data-placeholder="=====No Parent======" class="chzn-select"  tabindex="2" name="pid" default="0" disable="3">
					<option value="0"></option>
									
<?php $tree_74bfe9fe9e41796ec1b6a1743fd4d861=DOFactory::GetWidget("tree","default",array(DOFactory::GetModel(strtolower('Role'))->Select())) ?>
<?php echo $tree_74bfe9fe9e41796ec1b6a1743fd4d861->Render("
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
		<input type="hidden" id="__redirect" name="__redirect" value="http://localhost/dothing/demo/index.php/ads007/user/role"/>
		<input type="hidden" id="role_id" name="id" value="3"/>
		<input type="hidden" id="__token" name="__token" value="e006e0550ee85ece08ba89805693135e"/>
	</form>
</div>