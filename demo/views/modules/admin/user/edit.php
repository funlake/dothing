<div class="well">
<form action="http://localhost:81/dothing/demo/index.php/autocrud/Update/user" method="post" id="Afm" name="Afm" class="form-horizontal well">
<fieldset>
	<legend>
		<a>User > Update</a>
		<div class="pull-right">
		  <button class="btn btn-success" id="submitForm">
		  	<i class="icon-ok icon-white"></i>
		  	Apply		  </button>
		  <button class="btn btn-warning" onclick="location.href=$('#__redirect').val();return false;">
		  	<i class="icon-remove icon-white"></i>
		  	Cancel		  </button>
		</div>
	</legend>
	<div class="control-group">
		<label class="control-label" for="user_name">
			Name		</label>
		<div class="controls">
			<input type="text" id="user_name" name="user_name" class="input-xlarge" value="admin" required/>
		</div>
	</div>
			<div class="control-group">
		<label class="control-label" for="group_id">
			Group		</label>
		<div class="controls">
			<select multiple data-placeholder="=======No group======" class="chzn-select"  tabindex="2" name="group_id[]" default="1">
				<option value="0"></option>
								
<?php $tree_85f3aa06b9c31665d49377c767cfb7f3=DOFactory::GetWidget("tree","default",array(DOFactory::GetModel(strtolower('Group'))->Find())) ?>
<?php echo $tree_85f3aa06b9c31665d49377c767cfb7f3->Render("
					<option value=\"{#id}\">[prefix]{#name}</option>
				"); ?>

			</select>
		</div>
	</div>
	<div class="control-group">
		<label class="control-label" for="status">
			Status		</label>
		<div class="controls">
			<input id="status" name="state" value="0" type="radio" />No
			<input id="status" name="state" value="1" type="radio" checked/>Yes
		</div>
	</div>
</fieldset>

	<input type="hidden" id="__redirect" name="__redirect" value="http://localhost:81/dothing/demo/index.php/ads007/user/index"/>
	<input type="hidden" id="user_id" name="id" value="12"/>
	<input type="hidden" id="__token" name="__token" value="363d88569da0ff8aa1c3cbf69e18e2ec"/>
</form>

</div>