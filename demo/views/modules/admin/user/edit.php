<form action="http://localhost:81/dothing/demo/index.php/autocrud/Update/user" method="post" id="Afm" name="Afm" class="form-horizontal">

	<div class="row">
		<div class="col-lg-8"><a>User > Modify</a></div>
		<div class="col-lg-4 text-right">
		  <button class="btn btn-success" id="submitForm">
		  	<i class="glyphicon glyphicon-ok glyphicon-white"></i>
		  	Apply		  </button>
		  <button class="btn btn-danger" onclick="location.href=$('#__redirect').val();return false;">
		  	<i class="glyphicon glyphicon-remove glyphicon-white"></i>
		  	Cancel		  </button>
		</div>
	</div>
	<hr/>
	<div class="form-group">
		<label class="control-label" for="user_name">
			Name		</label>
		<input type="text" id="user_name" name="user_name" class="form-control" value="admin" required/>
	</div>
			<div class="form-group">
		<label class="control-label" for="group_id">
			Group		</label>
		<select multiple data-placeholder="=======No group======" class="chzn-select form-control"  tabindex="2" name="group_id[]" default="1">
			<option value="0"></option>
							
<?php $tree_97b9f7693850cdc2e22664467e1fbd34=DOFactory::GetWidget("tree","default",array(DOFactory::GetModel(strtolower('Group'))->Find())) ?>
<?php echo $tree_97b9f7693850cdc2e22664467e1fbd34->Render("
				<option value=\"{#id}\">[prefix]{#name}</option>
			"); ?>

		</select>
	</div>
	<div class="input-group">
		<label class="control-label" for="status">
			Status		</label>
		<input id="status" name="state"  value="0" type="radio" />No
		<input id="status" name="state"  value="1" type="radio" checked/>Yes
	</div>
	<input type="hidden" id="__redirect" name="__redirect" value="http://localhost:81/dothing/demo/index.php/ads007/user/index"/>
	<input type="hidden" id="user_id" name="id" value="12"/>
	<input type="hidden" id="__token" name="__token" value="5f72954903a106e432421a27440cb625"/>
</form>