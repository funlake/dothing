<?php !defined('DO_ACCESS') AND DIE("Go Away!"); ?>
<?php 
$searchIndex = "DOSearch/".DORouter::GetPageIndex();
$searchs     = SG($searchIndex);
?>
<div class="well">
	<form class="form-inline" id="Afm" method="post">
		<div class="row-fluid span6">
			<input type="text" name="DO[search][user_name]" id="user_name" class="span5" 
				   placeholder="<?php echo L('Name');?>"
				   value="<?php echo $searchs['user_name'];?>"
			/>
		</div>
	<div class="row-fluid pull-right span3">
	  <button class="btn btn-success" onclick="jQuery('#Afm').submit()">
	  	<i class="icon-search icon-white"></i>
	  	<?php echo L('Search');?>
	  </button>
	  <button class="btn btn-warning" onclick="jQuery('#user_name').val('');jQuery('#Afm').submit()">
	  	<i class="icon-refresh icon-white"></i>
	  	<?php echo L('Reset');?>
	  </button>
	</div>
	</form>
</div>
<div class="well">
	<div class="row-fluid span3 pull-right">
	  <button class="btn btn-primary" onclick="location.href='<?php echo Url(DO_ADMIN_INTERFACE.'/user/edit','');?>'">
	  	<i class="icon-plus icon-white"></i>
	  	<?php echo L('Add');?>
	  </button>
	</div>
</div>
<table class="table table-striped table-bordered">
	<thead>
		<tr>
			<th width="5%"><?php echo L('Id');?></th>
			<th width="20%"><?php echo L('Name');?></th>
			<th width="20%"><?php echo L('Password');?></th>
			<th><?php echo L('Actions');?></th>
		</tr>
	</thead>
	<tbody:loop=Model|User.Data class="adminTable">
		<tr>
			<td>{#user_id}</td>
			<td>{#user_name}</td>
			<td>{#user_pass}</td>
			<td>
				<a class="icon-edit" href="<?php echo Url(DO_ADMIN_INTERFACE.'/user/edit','id=');?>{#user_id}">
				</a>
				<a class="icon-remove" href="javascript:void(0)" data-toggle="modal" data-target="#DOModal_{#user_id}"></a>
				<div class="modal" id="DOModal_{#user_id}" style="display:none">
				  <form id="form{#user_id}" action="<?php echo Url('autocrud/Delete/user');?>" method="post">
					  <div class="modal-header">
					    <a class="close" data-dismiss="modal">×</a>
					    <h3><?php echo L('Warning');?></h3>
					  </div>
					  <div class="modal-body">
					    <p><?php echo L('Do you want to delete this item?');?></p>
					  </div>
					  <div class="modal-footer">
					  	<a href="javascript:void(0);" onclick="jQuery('#form{#user_id}').submit()" class="btn btn-success">
					  		<i class="icon-ok icon-white"></i>
					  		<?php echo L('Yes');?>
					  	</a>
					    <a data-dismiss="modal" class="btn btn-warning">
					    	<i class="icon-remove icon-white"></i>
					    	<?php echo L('Cancel');?>
					   	</a>
						<input type="hidden" id="__redirect" name="__redirect" value="<?php echo Url(DO_ADMIN_INTERFACE.'/user/index');?>"/>
						<input type="hidden" id="user_id" name="user_id" value="{#user_id}"/>
					   </div>
				   </form>
				</div>
			</td>
		</tr>
	</tbody:loop>
</table>
<?php
	$pager = DOFactory::GetPaginate('google',M('user')->Count(),DO_LIST_ROWS);
	echo $pager->Render();
?>