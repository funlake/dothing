<?php !defined('DO_ACCESS') AND DIE("Go Away!"); ?>
<form action="<?php echo Url('autocrud/'.$action.'/user');?>" method="post" id="Afm" name="Afm" class="form-horizontal">

	<div class="row">
		<div class="col-lg-8"><a><?php echo L('User > '.L('Modify'));?></a></div>
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
	<hr/>
	<div class="form-group">
		<label class="control-label" for="user_name">
			<?php echo L('Name');?>
		</label>
		<input type="text" id="user_name" name="user_name" class="form-control" value="<?php echo $data->user_name;?>" required/>
	</div>
	<?php if($action != "Update") : ?>
	<div class="form-group">
		<label class="control-label" for="user_pass">
			<?php echo L('Password');?>
		</label>
		<div class="controls">
			<input type="password" id="user_pass" name="user_pass" class="form-control"  value="<?php echo $data->user_pass;?>" required/>
		</div>
	</div>
	<?php endif;?>
	<?php $p = array((int)$data->state => 'checked');?>
	<div class="form-group">
		<label class="control-label" for="group_id">
			<?php echo L('Group');?>
		</label>
		<select multiple data-placeholder="<?php echo L('=======No group======');?>" class="chzn-select form-control"  tabindex="2" name="group_id[]" default="<?php echo $data->group_id;?>">
			<option value="0"></option>
			<notag:tree=Model|Group.Find>
				<option value="{#id}">[prefix]{#name}</option>
			</notag:tree>
		</select>
	</div>
	<div class="input-group">
		<label class="control-label" for="status">
			<?php echo L('Status');?>
		</label>
		<input id="status" name="state"  value="0" type="radio" <?php echo $p[0];?>/>No
		<input id="status" name="state"  value="1" type="radio" <?php echo $p[1];?>/>Yes
	</div>
	<input type="hidden" id="__redirect" name="__redirect" value="<?php echo Url(DO_ADMIN_INTERFACE.'/user/index');?>"/>
	<input type="hidden" id="user_id" name="id" value="<?php echo $data->id;?>"/>
	<input type="hidden" id="__token" name="__token" value="<?php echo DOBase::SetToken()?>"/>
</form>