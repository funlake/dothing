<?php !defined('DO_ACCESS') AND DIE("Go Away!"); ?>
<?php 
$searchIndex = "DOSearch.".DORouter::GetPageIndex();
$session     = DOFactory::GetSession();
$searchs     = $session->Get($searchIndex);
?>
<div class="well">
	<form class="form-inline" id="Afm" method="post">
		<div class="row-fluid span6">
			<input type="text" name="DO[search][group_name]" id="user_name" class="span5" 
				   placeholder="<?php echo L('Name');?>"
				   value="<?php echo $searchs['group_name'];?>"
			/>
		</div>
		<div class="row-fluid span3 pull-right">
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
<table class="table table-striped table-bordered">
	<thead>
		<tr>
			<th width="5%"><?php echo L('Id');?></th>
			<th width="25%"><?php echo L('Name');?></th>
			<th width="10%"><?php echo L('Ordering');?></th>
			<th width="10%"><?php echo L('Status');?></th>
			<th><?php echo L('Actions');?></th>
		</tr>
	</thead>
	<tbody:loop=Model|Group.Find class="adminTable">
		<tr>
			<td>{#group_id}</td>
			<td>{#group_name}</td>
			<td>{#ordering}</td>
			<td>{#state}</td>
			<td>
				<a class="icon-edit" href="<?php echo Url(DO_ADMIN_INTERFACE.'/user/editgroup@id=');?>{#group_id}">
				</a>
				<a class="icon-remove" href="javascript:void(0)" data-toggle="modal" data-target="#DOModal"></a>
			</td>
		</tr>
	</tbody:loop>
</table>

<div class="modal" id="DOModal" style="display:none">
  <div class="modal-header">
    <a class="close" data-dismiss="modal">×</a>
    <h3><?php echo L('Warning');?></h3>
  </div>
  <div class="modal-body">
    <p><?php echo L('Do you want to delete this item?');?></p>
  </div>
  <div class="modal-footer">
  	<a href="<?php echo Url('autocrud/Delete/group@group_id=1');?>" class="btn btn-primary">
  		<i class="icon-arrow-right icon-white"></i>
  		<?php echo L('Go');?>
  	</a>
    <a data-dismiss="modal" class="btn btn-warning">
    	<i class="icon-remove icon-white"></i>
    	<?php echo L('Cancel');?>
   	</a>
  </div>
</div>