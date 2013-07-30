<?php !defined('DO_ACCESS') AND DIE("Go Away!"); ?>
<div class="well">
	<form action="<?php echo Url('autocrud/'.$action.'/group');?>" method="post" id="Afm" name="Afm" class="form-horizontal">
	<fieldset>
		<legend>
			<a><?php echo L('Group > Edit');?></a>
			<div class="pull-right">
			  <button class="btn btn-primary" id="submitForm">
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
		<div class="control-group">
			<label class="control-label" for="ordering">
				<?php echo L('Ordering');?>
			</label>
			<div class="controls">
				<input type="text" id="ordering" name="ordering" class="input-xlarge" value="<?php echo $data->ordering;?>" />
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" for="group_id">
				<?php echo L('Parent');?>
			</label>
			<div class="controls">
				<?php 
					$selected = array($data->pid=>"selected");
					$ignored   = array($data->id => "disabled");
				?>
				<select id="group" data-placeholder="<?php echo L('=====No Parent======');?>" class="chzn-select"  tabindex="2" name="pid" default="<?php echo $data->pid;?>" disable="<?php echo $data->id;?>">
					<option value="0"></option>
					<notag:tree=Model|Group.Find>
						<option value="{#id}">[prefix]{#name}</option>
					</notag:tree>
				</select>
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
		<input type="hidden" id="__redirect" name="__redirect" value="<?php echo Url(DO_ADMIN_INTERFACE.'/user/group');?>"/>
		<input type="hidden" id="group_id" name="id" value="<?php echo $data->id;?>"/>
		<input type="hidden" id="__token" name="__token" value="<?php echo DOBase::SetToken()?>"/>
	</form>
</div>