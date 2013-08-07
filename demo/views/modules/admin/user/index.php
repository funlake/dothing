<div class="row well">
	<form class="form-horizontal" id="Afm" method="post">
		<div class="col-lg-5">
			<input type="text" name="DO[search][user_name]" id="user_name" 
			placeholder="Name"
			value="" class="form-control "
			/>
		</div>
		<div class="btn-group col-lg-4">
			<button class="btn  btn-success" onclick="jQuery('#Afm').submit()">
				<i class="glyphicon glyphicon-search glyphicon-white"></i>
				Search			</button>
			<button class="btn btn-warning" onclick="jQuery('#user_name').val('');jQuery('#Afm').submit()">
				<i class="glyphicon glyphicon-refresh glyphicon-white"></i>
				Reset			</button> 
		</div>
		<div class="btn-group  col-lg-3">
			<span class="btn btn-danger"><i class="glyphicon glyphicon-wrench glyphicon-white"></i> Action</span>
			<a class="btn btn-danger dropdown-toggle" data-toggle="dropdown" href="#"><span class="caret"></span></a>
			<ul class="dropdown-menu">
				<li><a href='javascript:void(0)' onclick="location.href='http://localhost/dothing/demo/index.php/ads007/user/add'"><i class="glyphicon glyphicon-plus"></i> Add</a></li>
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
				<th width="5%"><a href='http://localhost/dothing/demo/index.php/ads007/user/index@_doorder=u.id&_dosort=desc'>Id</a></th>
				<th width="30%"><a href='http://localhost/dothing/demo/index.php/ads007/user/index@_doorder=u.user_name&_dosort=desc'>Name</a></th>
				<th width="20%">Group</th>
				<th width="10%"><a href='http://localhost/dothing/demo/index.php/ads007/user/index@_doorder=u.state&_dosort=desc'>Status</a></th>
				<th>Actions</th>
			</tr>
		</thead>
		<tbody class="adminTable">				
<?php foreach((array)DOFactory::GetModel(strtolower('User'))->UserGroupList() as $key_0=>$item_0) : ?>
<?php $item_0=(array)$item_0; ?>

		<tr>
			<td><?php echo $item_0['id']?></td>
			<td><?php echo $item_0['user_name']?></td>
			<td><?php echo cutStr($item_0['group'],20)?></td>
			<td><?php echo showStatus($item_0['state'],'user',$item_0['id'])?></td>
			<td>
				<a class="glyphicon glyphicon-edit" href="http://localhost/dothing/demo/index.php/ads007/user/edit@id=<?php echo $item_0['id']?>">
				</a>
				<a class="glyphicon glyphicon-trash" href="#" data-toggle="modal" data-target="#DOModal_<?php echo $item_0['id']?>"></a>
				<div class="modal fade" id="DOModal_<?php echo $item_0['id']?>">
					<div class="modal-dialog">
						<div class="modal-content">
							<form id="form<?php echo $item_0['id']?>" action="http://localhost/dothing/demo/index.php/autocrud/Delete/user" method="post">
								<div class="modal-header">
									<a class="close" data-dismiss="modal">×</a>
									<h3>Warning</h3>
								</div>
								<div class="modal-body">
									<p>Do you want to delete this item?</p>
								</div>
								<div class="modal-footer">
									<a href="javascript:void(0);" onclick="jQuery('#form<?php echo $item_0['id']?>').submit()" class="btn btn-success">
										<i class=" glyphicon glyphicon-ok glyphicon-white"></i>
										Yes									</a>
									<a data-dismiss="modal" class="btn btn-warning">
										<i class="glyphicon glyphicon-remove glyphicon-white"></i>
										Cancel									</a>
									<input type="hidden" id="__redirect" name="__redirect" value="http://localhost/dothing/demo/index.php/ads007/user/index"/>
									<input type="hidden" id="user_id" name="id" value="<?php echo $item_0['id']?>"/>
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
		 $pager = DOFactory::GetWidget('paginate','default', DOFactory::GetModel(strtolower('User'))->GetTotal(),DO_LIST_ROWS);
		 echo $pager->Render();
		 ?></div>
</div>
