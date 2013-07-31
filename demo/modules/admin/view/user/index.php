<?php 
!defined('DO_ACCESS') AND DIE("Go Away!"); 
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
<table class="table table-striped table-bordered table-hover">
	<thead>
		<tr>
			<th width="5%"><?php echo DOMakeSortHead('u.id', L('Id'));?></th>
			<th width="20%"><?php echo DOMakeSortHead('u.user_name',L('Name'));?></th>
			<th width="20%"><?php echo L('Group');?></th>
			<th width="10%"><?php echo DOMakeSortHead('u.state',L('Status'));?></th>
			<th><?php echo L('Actions');?></th>
		</tr>
	</thead>
	<tbody:loop=Model|User.UserGroupList class="adminTable">
	<tr>
		<td>{#id}</td>
		<td>{#user_name}</td>
		<td>{#group|cutStr(?,20)}</td>
		<td>{#state|showStatus(?,'user',#id)}</td>
		<td>
			<a class="icon-edit" href="<?php echo Url(DO_ADMIN_INTERFACE.'/user/edit','id=');?>{#id}">
			</a>
			<a class="icon-trash" href="#" data-toggle="modal" data-target="#DOModal_{#id}"></a>
			<div class="modal" id="DOModal_{#id}" style="display:none">
				<form id="form{#id}" action="<?php echo Url('autocrud/Delete/user');?>" method="post">
					<div class="modal-header">
						<a class="close" data-dismiss="modal">×</a>
						<h3><?php echo L('Warning');?></h3>
					</div>
					<div class="modal-body">
						<p><?php echo L('Do you want to delete this item?');?></p>
					</div>
					<div class="modal-footer">
						<a href="javascript:void(0);" onclick="jQuery('#form{#id}').submit()" class="btn btn-success">
							<i class="icon-ok icon-white"></i>
							<?php echo L('Yes');?>
						</a>
						<a data-dismiss="modal" class="btn btn-warning">
							<i class="icon-remove icon-white"></i>
							<?php echo L('Cancel');?>
						</a>
						<input type="hidden" id="__redirect" name="__redirect" value="<?php echo Url(DO_ADMIN_INTERFACE.'/user/index');?>"/>
						<input type="hidden" id="user_id" name="id" value="{#id}"/>
					</div>
				</form>
			</div>
		</td>
	</tr>
</tbody:loop>
</table>
<?php $total = DOModel::LastTotal();?>
<div:paginate={#total}/>
