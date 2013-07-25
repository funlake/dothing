<?php !defined('DO_ACCESS') AND DIE("Go Away!"); ?>
<?php 
$searchIndex = "DOSearch/".DORouter::GetPageIndex();
$searchs     = SG($searchIndex);
?>
<div class="well">
	<form class="form-inline" id="Afm" method="post">
		<div class="row-fluid span10 input-appened btn-group">
			<input type="text" name="DO[search][user_name]" id="user_name" class="span7" 
			placeholder="<?php echo L('Name');?>"
			value="<?php echo $searchs['user_name'];?>"
			/>
			<button class="btn btn-success" onclick="jQuery('#Afm').submit()">
					<i class="icon-search icon-white"></i>
					<?php echo L('Search');?>
			</button>
			<button class="btn btn-warning" onclick="jQuery('#user_name').val('');jQuery('#Afm').submit()">
					<i class="icon-refresh icon-white"></i>
					<?php echo L('Reset');?>
			</button> 
		</div>
		<div class="btn-group pull-right">
				<span class="btn btn-danger"><i class="icon-wrench icon-white"></i> <?php echo L('Action');?></span>
				<a class="btn btn-danger dropdown-toggle" data-toggle="dropdown" href="#"><span class="caret"></span></a>
				<ul class="dropdown-menu">
					<li><a href='javascript:void(0)' onclick="location.href='<?php echo Url(DO_ADMIN_INTERFACE.'/user/add','');?>'"><i class="icon-plus"></i> <?php echo L('Add');?></a></li>
					<!-- 	    <li class="divider"></li> -->
					<!-- 	    <li><a href="#"><i class="i"></i> Make admin</a></li> -->
				</ul>
		</div>
	</form>
</div>
<table class="table table-striped table-bordered">
	<thead>
		<tr>
			<th width="5%"><?php echo L('Id');?></th>
			<th width="20%"><?php echo L('Name');?></th>
			<th width="20%"><?php echo L('Password');?></th>
			<th width="10%"><?php echo L('Status');?></th>
			<th><?php echo L('Actions');?></th>
		</tr>
	</thead>
	<tbody class="adminTable">				
<?php foreach(DOFactory::GetModel(strtolower('User'))->Data() as $key_0=>$item_0) : ?>
<?php $item_0=(array)$item_0; ?>

	<tr>
		<td><?php echo $item_0['id']?></td>
		<td><?php echo $item_0['user_name']?></td>
		<td><?php echo substr($item_0['user_pass'],0,30)?>...</td>
		<td><?php echo showStatus($item_0['state'],'user',$item_0['id'])?></td>
		<td>
			<a class="icon-edit" href="<?php echo Url(DO_ADMIN_INTERFACE.'/user/edit','id=');?><?php echo $item_0['id']?>">
			</a>
			<a class="icon-trash" href="javascript:void(0)" data-toggle="modal" data-target="#DOModal_<?php echo $item_0['id']?>"></a>
			<div class="modal" id="DOModal_<?php echo $item_0['id']?>" style="display:none">
				<form id="form<?php echo $item_0['id']?>" action="<?php echo Url('autocrud/Delete/user');?>" method="post">
					<div class="modal-header">
						<a class="close" data-dismiss="modal">×</a>
						<h3><?php echo L('Warning');?></h3>
					</div>
					<div class="modal-body">
						<p><?php echo L('Do you want to delete this item?');?></p>
					</div>
					<div class="modal-footer">
						<a href="javascript:void(0);" onclick="jQuery('#form<?php echo $item_0['id']?>').submit()" class="btn btn-success">
							<i class="icon-ok icon-white"></i>
							<?php echo L('Yes');?>
						</a>
						<a data-dismiss="modal" class="btn btn-warning">
							<i class="icon-remove icon-white"></i>
							<?php echo L('Cancel');?>
						</a>
						<input type="hidden" id="__redirect" name="__redirect" value="<?php echo Url(DO_ADMIN_INTERFACE.'/user/index');?>"/>
						<input type="hidden" id="user_id" name="id" value="<?php echo $item_0['id']?>"/>
					</div>
				</form>
			</div>
		</td>
	</tr>
	
<?php endforeach;?>
</tbody>
</table>
<div >		<?php
		 $pager = DOFactory::GetWidget('paginate','simple', DOFactory::GetModel(strtolower('User'))->Count(),DO_LIST_ROWS);
		 echo $pager->Render();
		 ?></div>
