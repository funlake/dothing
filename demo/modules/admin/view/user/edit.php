<?php !defined('DO_ACCESS') AND DIE("Go Away!"); ?>
<form action="<?php echo Url('autocrud/'.$action.'/user');?>" method="post" id="Afm" name="Afm" class="form-horizontal">
	<div class="row well">
		<div class="col-lg-8"><h4><?php echo L('User'). ' / '.L($action);?></h4></div>
		<div class="col-lg-4 text-right">
		  <button class="btn btn-sm btn-success" id="submitForm">
		  	<i class="glyphicon glyphicon-ok glyphicon-white"></i>
		  	<?php echo L('Apply');?>
		  </button>
		  <button class="btn btn-sm btn-danger" onclick="location.href=$('#__redirect').val();return false;">
		  	<i class="glyphicon glyphicon-remove glyphicon-white"></i>
		  	<?php echo L('Cancel');?>
		  </button>
		</div>
	</div>
	<div class="form-group">
		<label class="control-label col-lg-2" for="user_name">
			<?php echo L('Name');?>
		</label>
		<div class="col-lg-4">
			<input type="text" id="user_name" name="user_name" class="form-control" value="<?php echo $data->user_name;?>" required/>
		</div>
	<?php if($action != "Update") : ?>
		<label class="control-label col-lg-2" for="user_pass">
			<?php echo L('Password');?>
		</label>
		<div class="col-lg-4">
			<input type="password" id="user_pass" name="user_pass" class="form-control"  value="<?php echo $data->user_pass;?>" required/>
		</div>
	<?php endif;?>
	</div>
	<div class="form-group">
		<label class="control-label col-lg-2" for="group_id">
			<?php echo L('Group');?>
		</label>
		<div class="col-lg-4">
			<select multiple data-placeholder="<?php echo L('=======No group======');?>" class="chzn-select form-control"  tabindex="2" name="group_id[]" default="<?php echo $data->group_id;?>">
				<option value="0"></option>
				<notag:tree=Model|Group.Find>
					<option value="{#id}">[prefix]{#name}</option>
				</notag:tree>
			</select>
		</div>
	</div>
	<div class="form-group">
		<label class="control-label col-lg-2" for="role_id">
			<?php echo L('Role');?>
		</label>
		<div class="col-lg-4">
			<select multiple data-placeholder=" " class="chzn-select form-control"  tabindex="2" name="role_id[]" default="<?php echo $data->role_id;?>">
				<option value="0"></option>
				<notag:tree=Model|Role.Select>
					<option value="{#id}" parent="{#pid}">[prefix]{#name}</option>
				</notag:tree>
			</select>

		</div>
	</div>
	<?php $p = array((int)$data->state => 'checked',!$data->state=>'');?>
	<div class="form-group">
		<label class="control-label col-lg-2" for="status">
			<?php echo L('Status');?>
		</label>
		<div class="col-lg-4">
			<div class="radio-inline">
				<input id="status" name="state"  value="0" type="radio" <?php echo $p[0];?>/><label><?php echo L('No');?></label>
			</div>
			<div class="radio-inline">
				<input id="status" name="state"  value="1" type="radio" <?php echo $p[1];?>/><label><?php echo L('Yes');?></label>
			</div>
		</div>
	</div>
	<input type="hidden" id="__redirect" name="__redirect" value="<?php echo Url('admin/user/index');?>"/>
	<input type="hidden" id="user_id" name="id" value="<?php echo $data->id;?>"/>
	<input type="hidden" id="__token" name="__token" value="<?php echo DOBase::SetToken()?>"/>
</form>