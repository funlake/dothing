<?php !defined('DO_ACCESS') AND DIE("Go Away!"); ?>
<form action="<?php echo Url('autocrud/'.$action.'/operation');?>" method="post" id="Afm" name="Afm" class="form-horizontal">
	<div class="row well">
		<div class="col-lg-8"><h4><?php echo L('Operation / '.L($action));?></h4></div>
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
			<input type="text" id="ordering" name="ordering" class="form-control" value="<?php echo $data->ordering;?>" required/>
		</div>
	</div>
	<div class="form-group">
		<label class="control-label col-lg-2" for="description">
			<?php echo L('Description');?>
		</label>
		<div class="col-lg-4">
			<textarea id="description" name="description" class="form-control" rows="3"><?php echo $data->description;?></textarea>
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
	<input type="hidden" id="__redirect" name="__redirect" value="<?php echo Url(DO_ADMIN_INTERFACE.'/user/operation');?>"/>
	<input type="hidden" id="id" name="id" value="<?php echo $data->id;?>"/>
	<input type="hidden" id="__token" name="__token" value="<?php echo DOBase::SetToken()?>"/>
</form>