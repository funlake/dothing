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
			<button class="btn  btn-success" onclick="jQuery('#Afm').submit()">
				<i class=" glyphicon glyphicon-search glyphicon-white"></i>
				<?php echo L('Search');?>
			</button>
			<button class="btn btn-warning" onclick="jQuery('#group_name_search').val('');jQuery('#Afm').submit()">
				<i class="glyphicon glyphicon-refresh glyphicon-white"></i>
				<?php echo L('Reset');?>
			</button> 
		</div>
		<div class="btn-group  col-lg-3">
			<span class="btn btn-danger"><i class="glyphicon glyphicon-wrench glyphicon-white"></i> <?php echo L('Action');?></span>
			<a class="btn btn-danger dropdown-toggle" data-toggle="dropdown" href="#"><span class="caret"></span></a>
			<ul class="dropdown-menu">
				<li><a href='javascript:void(0)' onclick="location.href='<?php echo Url(DO_ADMIN_INTERFACE.'/user/addrole','');?>'"><i class="glyphicon glyphicon-plus"></i> <?php echo L('Add');?></a></li>
				<li><a href='javascript:void(0)' onclick="location.href='<?php echo Url(DO_ADMIN_INTERFACE.'/user/rolepermission','');?>'"><i class="glyphicon glyphicon-user"></i> <?php echo L('Assign permission');?></a></li>

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
				<th width="40%"><?php echo L('Name');?></th>
				<th width="10%"><?php echo L('Status');?></th>
				<th><?php echo L('Actions');?></th>
			</tr>
		</thead>
		<tbody:loop=Model|Role.TreeData class="adminTable">
		<tr>
			<td>{#id}</td>
			<td><a href="<?php echo Url(DO_ADMIN_INTERFACE.'/user/editrole','id=');?>{#id}">{#name}</a></td>
			<td>{#state|showStatus(?,'role',#id)}</td>
			<td>
				<a class="glyphicon glyphicon-edit" href="<?php echo Url(DO_ADMIN_INTERFACE.'/user/editrole','id=');?>{#id}">
				&nbsp;
				</a>
				<a class="glyphicon glyphicon-trash" href="#" data-toggle="modal" data-target="#DOModal_{#id}">&nbsp;</a>
				<div class="modal fade" id="DOModal_{#id}">
					<div class="modal-dialog">
						<div class="modal-content">
							<form id="form{#id}" action="<?php echo Url('autocrud/Delete/role');?>" method="post">
								<div class="modal-header">
									<a class="close" data-dismiss="modal">×</a>
									<h3><?php echo L('Warning');?></h3>
								</div>
								<div class="modal-body">
									<p><?php echo L('Do you want to delete this item?');?></p>
								</div>
								<div class="modal-footer">
									<a href="javascript:void(0);" onclick="jQuery('#form{#id}').submit()" class="btn btn-success">
										<i class="glyphicon glyphicon-ok glyphicon-white"></i>
										<?php echo L('Yes');?>
									</a>
									<a data-dismiss="modal" class="btn btn-warning">
										<i class="glyphicon glyphicon-remove glyphicon-white"></i>
										<?php echo L('Cancel');?>
									</a>
									<input type="hidden" id="__redirect" name="__redirect" value="<?php echo Url(DO_ADMIN_INTERFACE.'/user/role');?>"/>
									<input type="hidden" id="id" name="id" value="{#id}"/>
								</div>
							</form>
						</div>
					</div>
				</div>
				<a class="glyphicon glyphicon-user" href="<?php echo Url(DO_ADMIN_INTERFACE.'/user/rolepermission','id=');?>{#id}"><?php echo L("Assign");?></a>
			</td>
		</tr>
	</tbody:loop>
</table>
</div>
