<?php 
!defined('DO_ACCESS') AND DIE("Go Away!"); 
$searchIndex = "DOSearch/".DORouter::GetPageIndex();
$searchs     = SG($searchIndex);
?>
<div class="row well">
	<form class="form-horizontal" id="Afm" method="post">
		<div class="col-lg-5">
			<input type="text" name="DO[search][name]" id="group_name_search" 
			placeholder="<?php echo L('Name');?>"
			value="<?php echo $searchs['name'];?>" class="form-control "
			/>
		</div>
		<div class="btn-group col-lg-4">
			<button class="btn btn-sm btn-success" onclick="jQuery('#Afm').submit()">
				<i class=" glyphicon glyphicon-search glyphicon-white"></i>
				<?php echo L('Search');?>
			</button>
			<button class="btn btn-sm btn-warning" onclick="jQuery('#group_name_search').val('');jQuery('#Afm').submit()">
				<i class="glyphicon glyphicon-refresh glyphicon-white"></i>
				<?php echo L('Reset');?>
			</button> 
		</div>
		<div class="btn-group  col-lg-3">
			<span class="btn btn-sm btn-danger"><i class="glyphicon glyphicon-wrench glyphicon-white"></i> <?php echo L('Action');?></span>
			<a class="btn btn-sm btn-danger dropdown-toggle" data-toggle="dropdown" href="#"><span class="caret"></span></a>
			<ul class="dropdown-menu">
				<li><a href='javascript:void(0)' onclick="location.href='<?php echo Url('admin/user/addgroup','');?>'"><i class="glyphicon glyphicon-plus"></i> <?php echo L('Add');?></a></li>
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
				<th width="5%" ><?php echo L('Id');?></th>
				<th width="30%"><?php echo DOMakeSortHead('g.name',L('Name'));?></th>
				<th width="25%"><?php echo L('Role');?></th>
				<th width="10%"><?php echo DOMakeSortHead('g.ordering',L('Ordering'));?></th>
				<th width="10%"><?php echo L('Status');?></th>
				<th><?php echo L('Action');?></th>
			</tr>
		</thead>
		<tbody:loop=Model|Group.TreeData class="adminTable">
		<tr>
			<td>{#id}</td>
			<td><a href="<?php echo Url('admin/user/editgroup','id=');?>{#id}">{#name}</a></td>
			<td>{#role|cutStr(?,20)}</td>
			<td>{#ordering}</td>
			<td>{#state|showStatus(?,'group',#id)}</td>
			<td>
				{#id|showEditLink('id='.?,'<?php echo 'admin/user/editgroup';?>')}
				{#id|showCfm(?,'autocrud/Delete/group')}
			</td>
		</tr>
	</tbody:loop>
</table>
<div:paginate=Model|Group.GetTotal/>
</div>
