<script type='text/javascript' src='<?php echo DOUri::getRoot();?>/data/js/common/loader.js'>
	@load Ext;
	@load Valid;
	@load Editlayout;
	@load Theme[backend/default]
</script>

<div id="edit_content" class="edit_form">
<form action="<?php echo DOUri::buildQuery('module','module','save');?>" name="adminForm" id="adminForm" onsubmit="return false;">
	<fieldset>
		<legend><?php echo DOLang::get('base_info','基本信息');?> </legend>
		<p>
			<label class="require_field"><?php echo DOLang::get('module','模块');?> : </label><br/>
			<input type='text' name="module_name" class="half required" value="<?php echo $this->data['module_name'];?>"/>
		</p>
		<p>
			<label class="require_field"><?php echo DOLang::get('reference','编号');?> : </label><br/>
			<input type='text' name="module_code" class="half required" value="<?php echo $this->data['module_code'];?>"/>
		</p>
		<p>
			<label class="require_field"><?php echo DOLang::get('module_icon','图标');?> : </label><br/>
			<?php echo DOExtWidget::listDirImg('module_icon',IMAGE_ROOT.DS.'module',DOUri::getRoot().'/data/images/module/',$this->data['module_icon']);?>
		</p>
		<p>
			<label class="require_field"><?php echo DOLang::get('module_url','入口链接');?> : </label><br/>
			<input type='text' name="module_url" class="half required" value="<?php echo $this->data['module_url'];?>"/>
		</p>
		<p>
			<label><?php echo DOLang::get('g_ordering','排序');?> : </label><br/>
			<input type='text' name="ordering" class="half" value="<?php echo $this->data['ordering'];?>"/>
		</p>
		<p>
			<label><?php echo DOLang::get('g_state','发布');?> : </label><br/>
			<?php echo DOHtml::radio('state',array('1'=>'是','0'=>'否'),'',(!!$this->data) ? $this->data['state'] : 1);?>
		</p>
	</fieldset>
	<input type='hidden' name='module_id' value="<?php echo $this->var['task'] == 'edit' ? $this->var['id'] : 0;?>" />
	<input type='hidden' name='module_pid' value="<?php echo $this->var['task'] == 'add' ? $this->var['id'] : $this->var['pid'];?>" />
	<input type='hidden' name='task' value="<?php echo $this->var['task'];?>" />
</form>
</div>
<script type="text/javascript">
	Ext.onReady(function(){
		DO.addBtns([
			['<?php echo DOLang::get('g_save','保存');?>','DO.formPost()','save-icon','']
		   ,['<?php echo DOLang::get('g_cancel','取消');?>','parent.DO.dialog.hide()','cancel-icon','']
		 //  ,['<?php echo DOLang::get('g_add','添加模块');?>','top.DO.showDialog("添加","<?php echo DOUri::buildQuery('module','module','add');?>")','add-icon','']
		])
	})
</script>

