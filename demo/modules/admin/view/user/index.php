<?php 
!defined('DO_ACCESS') AND DIE("Go Away!"); 
$searchIndex = "DOSearch/".DORouter::GetPageIndex();
$searchs     = SG($searchIndex);

?>
<div class="row well">
	<form class="form-horizontal" id="Afm" method="post">
		<div class="col-lg-5">
			<input type="text" name="DO[search][user_name]" id="user_name" 
			placeholder="<?php echo L('Name');?>"
			value="<?php echo $searchs['user_name'];?>" class="form-control "
			/>
		</div>
		<div class="btn-group col-lg-4">
			<button class="btn btn-sm  btn-success" onclick="jQuery('#Afm').submit()">
				<i class="glyphicon glyphicon-search glyphicon-white"></i>
				<?php echo L('Search');?>
			</button>
			<button class="btn btn-sm btn-warning" onclick="jQuery('#user_name').val('');jQuery('#Afm').submit()">
				<i class="glyphicon glyphicon-refresh glyphicon-white"></i>
				<?php echo L('Reset');?>
			</button> 
		</div>
		<div class="btn-group  col-lg-3">
			<span class="btn btn-sm btn-danger"><i class="glyphicon glyphicon-wrench glyphicon-white"></i> <?php echo L('Action');?></span>
			<a class="btn btn-sm  btn-danger dropdown-toggle" data-toggle="dropdown" href="#"><span class="caret"></span></a>
			<ul class="dropdown-menu">
				<li><a href='javascript:void(0)' onclick="location.href='<?php echo Url('admin/user/add','');?>'"><i class="glyphicon glyphicon-plus"></i> <?php echo L('Add');?></a></li>
				<!-- 	    <li class="divider"></li> -->
				<!-- 	    <li><a href="#"><i class="i"></i> Make admin</a></li> -->
			</ul>
		</div>
	</form>
</div>
<div class="row">
	<table class="table table-striped table-bordered table-hover">
		<thead>
			<tr>
				<th width="5%"><?php echo DOMakeSortHead('u.id', L('Id'));?></th>
				<th width="30%"><?php echo DOMakeSortHead('u.user_name',L('Name'));?></th>
				<th width="20%"><?php echo L('Group');?></th>
				<th width="20%"><?php echo L('role');?></th>
				<th width="10%"><?php echo DOMakeSortHead('u.state',L('Status'));?></th>
				<th><?php echo L('Action');?></th>
			</tr>
		</thead>
		<tbody:loop=Model|User.UserGroupList class="adminTable">
		<tr>
			<td>{#id}</td>
			<td>{#user_name}</td>
			<td>{#group|cutStr(?,20)}</td>
			<td>{#role|cutStr(?,20)}</td>
			<td>{#state|showStatus(?,'user',#id)}</td>
			<td>
				<a class="glyphicon glyphicon-edit" href="<?php echo Url('admin/user/edit','id={#id}');?>"></a>
				{#id|showCfm(?,'autocrud/Delete/user')}
			</td>
		</tr>
	</tbody:loop>
</table>
<div:paginate=Model|User.GetTotal class="pull-right"/>
</div>
