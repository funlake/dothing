<form action="http://localhost/dothing/demo/index.php/autocrud/Add/user" method="post" id="Afm" name="Afm" class="form-horizontal">

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
	<hr/>
	<div class="form-group">
		<label class="control-label" for="user_name">
			Name		</label>
		<input type="text" id="user_name" name="user_name" class="form-control" value="" required/>
	</div>
		<div class="form-group">
		<label class="control-label" for="user_pass">
			Password		</label>
		<div class="controls">
			<input type="password" id="user_pass" name="user_pass" class="form-control"  value="" required/>
		</div>
	</div>
			<div class="form-group">
		<label class="control-label" for="group_id">
			Group		</label>
		<select multiple data-placeholder="=======No group======" class="chzn-select form-control"  tabindex="2" name="group_id[]" default="">
			<option value="0"></option>
							
<?php $tree_829cfaa1b4727b959e6516c9bc95ad43=DOFactory::GetWidget("tree","default",array(DOFactory::GetModel(strtolower('Group'))->Find())) ?>
<?php echo $tree_829cfaa1b4727b959e6516c9bc95ad43->Render("
				<option value=\"{#id}\">[prefix]{#name}</option>
			"); ?>

		</select>
	</div>
	<div class="input-group">
		<label class="control-label" for="status">
			Status		</label>
		<input id="status" name="state"  value="0" type="radio" checked/>No
		<input id="status" name="state"  value="1" type="radio" />Yes
	</div>
	<input type="hidden" id="__redirect" name="__redirect" value="http://localhost/dothing/demo/index.php/ads007/user/index"/>
	<input type="hidden" id="user_id" name="id" value=""/>
	<input type="hidden" id="__token" name="__token" value="1dd17a39f8e16eb475cbb80406037330"/>
</form>