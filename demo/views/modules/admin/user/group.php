<div class="row">
	<form class="form-horizontal" id="Afm" method="post">
		<div class="col-lg-5">
			<input type="text" name="DO[search][name]" id="group_name_search" 
			placeholder="Name"
			value="" class="form-control "
			/>
		</div>
		<div class="btn-group col-lg-4">
			<button class="btn  btn-success" onclick="jQuery('#Afm').submit()">
				<i class=" glyphicon glyphicon-search glyphicon-white"></i>
				Search			</button>
			<button class="btn btn-warning" onclick="jQuery('#group_name_search').val('');jQuery('#Afm').submit()">
				<i class="glyphicon glyphicon-refresh glyphicon-white"></i>
				Reset			</button> 
		</div>
		<div class="btn-group  col-lg-3">
			<span class="btn btn-danger"><i class="glyphicon glyphicon-wrench glyphicon-white"></i> Action</span>
			<a class="btn btn-danger dropdown-toggle" data-toggle="dropdown" href="#"><span class="caret"></span></a>
			<ul class="dropdown-menu">
				<li><a href='javascript:void(0)' onclick="location.href='http://localhost:81/dothing/demo/index.php/ads007/user/addgroup'"><i class="glyphicon glyphicon-plus"></i> Add</a></li>
				<!-- 	    <li class="divider"></li> -->
				<!-- 	    <li><a href="#"><i class="i"></i> Make admin</a></li> -->
			</ul>
		</div>
	</form>
</div>
<hr/>
<div class="row">
	<table class="table table-striped table-bordered table-hover">
		<thead>
			<tr>
				<th width="5%" >Id</th>
				<th width="30%"><a href='http://localhost:81/dothing/demo/index.php/ads007/user/group@_doorder=g.name&_dosort=desc'>Name</a></th>
				<th width="25%">Roles</th>
				<th width="10%"><a href='http://localhost:81/dothing/demo/index.php/ads007/user/group@_doorder=g.ordering&_dosort=desc'>Ordering</a></th>
				<th width="10%">Status</th>
				<th>Actions</th>
			</tr>
		</thead>
		<tbody class="adminTable">				
<?php foreach((array)DOFactory::GetModel(strtolower('Group'))->TreeData() as $key_0=>$item_0) : ?>
<?php $item_0=(array)$item_0; ?>

		<tr>
			<td><?php echo $item_0['id']?></td>
			<td><?php echo $item_0['name']?></td>
			<td><?php echo cutStr($item_0['role'],20)?></td>
			<td><?php echo $item_0['ordering']?></td>
			<td><?php echo showStatus($item_0['state'],'group',$item_0['id'])?></td>
			<td>
				<?php echo showEditLink('id='.$item_0['id'],'ads007/user/editgroup')?>
				<a class="glyphicon glyphicon-trash" href="#" data-toggle="modal" data-target="#DOModal_<?php echo $item_0['id']?>"></a>
				<div class="modal fade" id="DOModal_<?php echo $item_0['id']?>">
					<div class="modal-dialog">
						<div class="modal-content">
							<form id="form<?php echo $item_0['id']?>" action="http://localhost:81/dothing/demo/index.php/autocrud/Delete/group" method="post">
								<div class="modal-header">
									<a class="close" data-dismiss="modal">×</a>
									<h3>Warning</h3>
								</div>
								<div class="modal-body">
									<p>Do you want to delete this item?</p>
								</div>
								<div class="modal-footer">
									<a href="javascript:void(0);" onclick="jQuery('#form<?php echo $item_0['id']?>').submit()" class="btn btn-success">
										<i class="glyphicon glyphicon-ok glyphicon-white"></i>
										Yes									</a>
									<a data-dismiss="modal" class="btn btn-warning">
										<i class="glyphicon glyphicon-remove glyphicon-white"></i>
										Cancel									</a>
									<input type="hidden" name="__redirect" value="http://localhost:81/dothing/demo/index.php/ads007/user/group"/>
									<input type="hidden" name="id" value="<?php echo $item_0['id']?>"/>
								</div>
							</form>
						</div>
					</div>
				</div>
			</td>
		</tr>
		
<?php endforeach;?>
</tbody>
</table>
<div >		<?php
		 $pager = DOFactory::GetWidget('paginate','default', DOFactory::GetModel(strtolower('Group'))->GetTotal(),DO_LIST_ROWS);
		 echo $pager->Render();
		 ?></div>
</div>
