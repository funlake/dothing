	<form action="http://localhost/dothing/demo/index.php/autocrud/Update/role" method="post" id="Afm" name="Afm" class="form-horizontal">
	<div class="row well">
		<div class="col-lg-8"><h4>Group / 修改</h4></div>
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
				名称			</label>
			<div class="col-lg-4">
				<input type="text" id="name" name="name" class="form-control" value="Project manager" required/>
			</div>
		</div>
		<div class="form-group">
			<label class="control-label col-lg-2" for="group_id">
				Parent			</label>
			<div class="col-lg-4">
				<select id="group" data-placeholder="=======No Parent======" class="chzn-select form-control"  tabindex="2" name="pid" default="5" disable="7">
					<option value="0"></option>
									
<?php $tree_940d106d672622def9ff5d125cc5e266=\Dothing\Lib\Factory::GetWidget("tree","default",array(\Dothing\Lib\Factory::GetModel(strtolower('Role'))->Select())) ?>
<?php echo $tree_940d106d672622def9ff5d125cc5e266->Render("
						<option value=\"{#id}\" parent=\"{#pid}\">[prefix]{#name}</option>
					"); ?>

				</select>
			</div>
		</div>
				<div class="form-group">
			<label class="control-label col-lg-2" for="status">
				状态			</label>
			<div class="col-lg-4">
				<div class="radio-inline">
					<input id="status" name="state"  value="1" type="radio" checked/><label>是</label>
				</div>
				<div class="radio-inline">
					<input id="status" name="state"  value="0" type="radio" /><label>否</label>
				</div>

			</div>
		</div>
		<input type="hidden" id="__redirect" name="__redirect" value="http://localhost/dothing/demo/index.php/ads007/user/role"/>
		<input type="hidden" id="role_id" name="id" value="7"/>
		<input type="hidden" id="__token" name="__token" value="6c0244deff96dad08c89c38ae03a0c7c"/>
	</form>