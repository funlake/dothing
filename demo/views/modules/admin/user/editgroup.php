<form action="http://localhost:81/dothing/demo/index.php/autocrud/Add/group" method="post" id="Afm" name="Afm" class="form-horizontal">
	<div class="row well">
		<div class="col-lg-8"><h4>Group / 添加</h4></div>
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
		<label class="control-label col-lg-2" for="name">
			名称		</label>
		<div class="col-lg-4">
			<input type="text" id="name" name="name" class="form-control" value="" required/>
		</div>
	</div>
	<div class="form-group">
		<label class="control-label col-lg-2" for="ordering">
			Ordering		</label>
		<div class="col-lg-4">
			<input type="text" id="ordering" name="ordering" class="form-control" value="" />
		</div>
	</div>
	<div class="form-group">
		<label class="control-label col-lg-2" for="group_id">
			Parent		</label>
		<div class="col-lg-4">
			<select id="group" data-placeholder="=====No Parent======" class="chzn-select form-control"  tabindex="2" name="pid" default="" disable="">
				<option value="0"></option>
								
<?php $tree_7ff03c01d21362ff26abc8b45cce93e5=DOFactory::GetWidget("tree","default",array(DOFactory::GetModel(strtolower('Group'))->Select())) ?>
<?php echo $tree_7ff03c01d21362ff26abc8b45cce93e5->Render("
					<option value=\"{#id}\" parent=\"{#pid}\">[prefix]{#name}</option>
				"); ?>

			</select>
		</div>
	</div>
	<div class="form-group">
		<label class="control-label col-lg-2" for="role_id">
			角色		</label>
		<div class="col-lg-4">
			<select multiple data-placeholder="=======Choose roles======" class="chzn-select form-control"  tabindex="2" name="role_id[]" default="">
				<option value="0"></option>
								
<?php $tree_c7282e2fb745a6847e188c8162ca0165=DOFactory::GetWidget("tree","default",array(DOFactory::GetModel(strtolower('Role'))->Select())) ?>
<?php echo $tree_c7282e2fb745a6847e188c8162ca0165->Render("
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
	<input type="hidden" id="__redirect" name="__redirect" value="http://localhost:81/dothing/demo/index.php/manage/group"/>
	<input type="hidden" id="group_id" name="id" value=""/>
	<input type="hidden" id="__token" name="__token" value="8efb1fafcbb823c125206bcc1d83ebaa"/>
</form>