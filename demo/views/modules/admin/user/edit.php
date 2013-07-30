<?php !defined('DO_ACCESS') AND DIE("Go Away!"); ?>
<div class="well">
<form action="<?php echo Url('autocrud/'.$action.'/user');?>" method="post" id="Afm" name="Afm" class="form-horizontal well">
<fieldset>
	<legend>
		<a><?php echo L('User > '.L($action));?></a>
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
		<label class="control-label" for="user_name">
			<?php echo L('Name');?>
		</label>
		<div class="controls">
			<input type="text" id="user_name" name="user_name" class="input-xlarge" value="<?php echo $data->user_name;?>" required/>
		</div>
	</div>
	<?php if($action != "Update") : ?>
	<div class="control-group">
		<label class="control-label" for="user_pass">
			<?php echo L('Password');?>
		</label>
		<div class="controls">
			<input type="password" id="user_pass" name="user_pass" class="input-xlarge" value="<?php echo $data->user_pass;?>" required/>
		</div>
	</div>
	<?php endif;?>
	<?php $p = array((int)$data->state => 'checked');?>
	<div class="control-group">
		<label class="control-label" for="group_id">
			<?php echo L('Group');?>
		</label>
		<div class="controls">
<<<<<<< HEAD
			<select data-placeholder="Choose a Country..." class="chzn-select"  tabindex="2" name="group_id">				
=======
			<?php $selected = array($data->group_id=>"selected");?>
			<select data-placeholder="<?php echo L('==Please select==');?>				
>>>>>>> 7708a9b54af06fcf19427fa24984a02c3b804690
<?php foreach(DOFactory::GetModel(strtolower('Group'))->Find() as $key_0=>$item_0) : ?>
<?php $item_0=(array)$item_0; ?>
" class="chzn-select"  tabindex="2" name="group_id">
				<option value="<?php echo $item_0['id']?>" <?php echo $selected[$item_0['id']]?> ><?php echo $item_0['name']?></option>
				
<?php endforeach;?>
</select>
		</div>
	</div>
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

	<input type="hidden" id="__redirect" name="__redirect" value="<?php echo Url(DO_ADMIN_INTERFACE.'/user/index');?>"/>
	<input type="hidden" id="user_id" name="id" value="<?php echo $data->id;?>"/>
	<input type="hidden" id="__token" name="__token" value="<?php echo DOBase::SetToken()?>"/>
</form>

<script type="text/javascript">
	require(['form'],function(){
		var $ = jQuery;
		$('.chzn-select').chosen()
	})
</script>
</div>
