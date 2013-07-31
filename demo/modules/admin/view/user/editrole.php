<?php !defined('DO_ACCESS') AND DIE("Go Away!"); ?>
<div class="well">
	<form action="<?php echo Url('autocrud/'.$action.'/role');?>" method="post" id="Afm" name="Afm" class="form-horizontal">
	<fieldset>
		<legend>
			<a><?php echo L('Role > '.$action);?></a>
			<div class="pull-right">
			  <button class="btn btn-success" id="submitForm">
			  	<i class="icon-ok icon-white"></i>
			  	<?php echo L('Apply');?>
			  </button>
			  <button class="btn btn-warning" onclick="location.href=$('#__redirect').val();return false;">
			  	<i class="icon-remove icon-white"></i>
			  	<?php echo L('Cancel');?>
			  </button>
			</div>
		</legend>
		<div class="control-group">
			<label class="control-label" for="name">
				<?php echo L('Name');?>
			</label>
			<div class="controls">
				<input type="text" id="name" name="name" class="input-xlarge" value="<?php echo $data->name;?>" required/>
			</div>
		</div>
		<?php $p = array((int)$data->state => 'checked');?>
		<div class="control-group">
			<label class="control-label" for="status">
				<?php echo L('Status');?>
			</label>
			<div class="controls">
				<input id="status" name="state" value="0" type="radio" <?php echo $p[0];?>/>No
				<input id="status" name="state" value="1" type="radio" <?php echo $p[1];?>/>Yes
			</div>
		</div>
	</fieldset>
		<input type="hidden" id="__redirect" name="__redirect" value="<?php echo Url(DO_ADMIN_INTERFACE.'/user/role');?>"/>
		<input type="hidden" id="role_id" name="id" value="<?php echo $data->id;?>"/>
		<input type="hidden" id="__token" name="__token" value="<?php echo DOBase::SetToken()?>"/>
	</form>
</div>