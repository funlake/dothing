<?php !defined('DO_ACCESS') AND DIE("Go Away!"); ?>
<form action="<?php echo Url('autocrud/'.$action.'/group');?>" method="post" id="Afm" name="Afm" class="form-horizontal">
	<div class="row well">
		<div class="col-lg-8"><h4><?php echo L('Group / '.L($action));?></h4></div>
		<div class="col-lg-4 text-right">
		  <button class="btn btn-success" id="submitForm">
		  	<i class="glyphicon glyphicon-ok glyphicon-white"></i>
		  	<?php echo L('Apply');?>
		  </button>
		  <button class="btn btn-danger" onclick="location.href=$('#__redirect').val();return false;">
		  	<i class="glyphicon glyphicon-remove glyphicon-white"></i>
		  	<?php echo L('Cancel');?>
		  </button>
		</div>
	</div>
	<div class="form-group">
		<label class="control-label col-lg-2" for="name">
			<?php echo L('Name');?>
		</label>
		<div class="col-lg-4">
			<input type="text" id="name" name="name" class="form-control" value="<?php echo $data->name;?>" required/>
		</div>
	</div>
	<div class="form-group">
		<label class="control-label col-lg-2" for="ordering">
			<?php echo L('Ordering');?>
		</label>
		<div class="col-lg-4">
			<input type="text" id="ordering" name="ordering" class="form-control" value="<?php echo $data->ordering;?>" />
		</div>
	</div>
	<div class="form-group">
		<label class="control-label col-lg-2" for="group_id">
			<?php echo L('Parent');?>
		</label>
		<div class="col-lg-4">
			<select id="group" data-placeholder="<?php echo L('=====No Parent======');?>" class="chzn-select form-control"  tabindex="2" name="pid" default="<?php echo $data->pid;?>" disable="<?php echo $data->id;?>">
				<option value="0"></option>
				<notag:tree.default=Model|Group.Select>
					<option value="{#id}" parent="{#pid}">[prefix]{#name}</option>
				</notag:tree>
			</select>
		</div>
	</div>
	<div class="form-group">
		<label class="control-label col-lg-2" for="role_id">
			<?php echo L('Role');?>
		</label>
		<div class="col-lg-4">
			<select multiple data-placeholder="<?php echo L('=======Choose roles======');?>" class="chzn-select form-control"  tabindex="2" name="role_id[]" default="<?php echo $data->role_id;?>">
				<option value="0"></option>
				<notag:tree=Model|Role.Select>
					<option value="{#id}" parent="{#pid}">[prefix]{#name}</option>
				</notag:tree>
			</select>
		</div>
	</div>
	<?php $p = array((int)$data->state => 'checked');?>
	<div class="form-group">
		<label class="control-label col-lg-2" for="status">
			<?php echo L('Status');?>
		</label>
		<div class="col-lg-4">
			<label class="radio-inline">
				<input id="status" name="state"  value="0" type="radio" <?php echo $p[0];?>/><?php echo L('No');?>
			</label>
			<label class="radio-inline">
				<input id="status" name="state"  value="1" type="radio" <?php echo $p[1];?>/><?php echo L('Yes');?>
			</label>
		</div>
	</div>
	<input type="hidden" id="__redirect" name="__redirect" value="<?php echo Url(DO_ADMIN_INTERFACE.'/user/group');?>"/>
	<input type="hidden" id="group_id" name="id" value="<?php echo $data->id;?>"/>
	<input type="hidden" id="__token" name="__token" value="<?php echo DOBase::SetToken()?>"/>
</form>