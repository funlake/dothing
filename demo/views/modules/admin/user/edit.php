<form action="http://localhost/dothing/demo/index.php/autocrud/Add/user" method="post" id="Afm" name="Afm" class="form-horizontal">
	<div class="row well">
		<div class="col-lg-8"><h4>用户 / 添加</h4></div>
		<div class="col-lg-4 text-right">
		  <button class="btn btn-sm btn-success" id="submitForm">
		  	<i class="glyphicon glyphicon-ok glyphicon-white"></i>
		  	应用		  </button>
		  <button class="btn btn-sm btn-danger" onclick="location.href=$('#__redirect').val();return false;">
		  	<i class="glyphicon glyphicon-remove glyphicon-white"></i>
		  	取消		  </button>
		</div>
	</div>
	<div class="form-group">
		<label class="control-label col-lg-2" for="user_name">
			名称		</label>
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
			用户组		</label>
		<div class="col-lg-4">
			<select multiple data-placeholder="=======No group======" class="chzn-select form-control"  tabindex="2" name="group_id[]" default="">
				<option value="0"></option>
								
<?php $tree_d6c2fc46786e5780b30e8184263bff33=\Dothing\Lib\Factory::GetWidget("tree","default",array(\Dothing\Lib\Factory::GetModel(strtolower('Group'))->Find())) ?>
<?php echo $tree_d6c2fc46786e5780b30e8184263bff33->Render("
					<option value=\"{#id}\">[prefix]{#name}</option>
				"); ?>

			</select>
		</div>
	</div>
	<div class="form-group">
		<label class="control-label col-lg-2" for="role_id">
			角色		</label>
		<div class="col-lg-4">
			<select multiple data-placeholder=" " class="chzn-select form-control"  tabindex="2" name="role_id[]" default="">
				<option value="0"></option>
								
<?php $tree_5f1ad90a99caa57095ee45bff243a531=\Dothing\Lib\Factory::GetWidget("tree","default",array(\Dothing\Lib\Factory::GetModel(strtolower('Role'))->Select())) ?>
<?php echo $tree_5f1ad90a99caa57095ee45bff243a531->Render("
					<option value=\"{#id}\" parent=\"{#pid}\">[prefix]{#name}</option>
				"); ?>

			</select>

		</div>
	</div>
		<div class="form-group">
		<label class="control-label col-lg-2" for="status">
			状态		</label>
		<div class="col-lg-4">
			<div class="radio-inline">
				<input id="status" name="state"  value="1" type="radio" /><label>是</label>
			</div>
			<div class="radio-inline">
				<input id="status" name="state"  value="0" type="radio" checked/><label>否</label>
			</div>

		</div>
	</div>
	<input type="hidden" id="__redirect" name="__redirect" value="http://localhost/dothing/demo/index.php/manage/user"/>
	<input type="hidden" id="user_id" name="id" value=""/>
	<input type="hidden" id="__token" name="__token" value="415b1eb17458246e558fa2a1cd6e9012"/>
</form>