<div class="row well">
	<form class="form-horizontal" id="Afm" method="post">
		<div class="col-lg-5">
			<input type="text" name="DO[search][name]" id="group_name_search" 
			placeholder="名称"
			value="" class="form-control "
			/>
		</div>
		<div class="btn-group col-lg-4">
			<button class="btn btn-sm  btn-success" onclick="jQuery('#Afm').submit()">
				<i class=" glyphicon glyphicon-search glyphicon-white"></i>
				搜索			</button>
			<button class="btn btn-sm btn-warning" onclick="jQuery('#group_name_search').val('');jQuery('#Afm').submit()">
				<i class="glyphicon glyphicon-refresh glyphicon-white"></i>
				清空			</button> 
		</div>
		<div class="btn-group  col-lg-3">
			<span class="btn btn-sm btn-danger"><i class="glyphicon glyphicon-wrench glyphicon-white"></i> 操作</span>
			<a class="btn btn-sm btn-danger dropdown-toggle" data-toggle="dropdown" href="#"><span class="caret"></span></a>
			<ul class="dropdown-menu">
				<li><a href='javascript:void(0)' onclick="location.href='http://localhost:81/dothing/demo/index.php/ads007/user/addrole'"><i class="glyphicon glyphicon-plus"></i> 添加</a></li>
				<li><a href='javascript:void(0)' onclick="location.href='http://localhost:81/dothing/demo/index.php/assign/permission-'"><i class="glyphicon glyphicon-user"></i> Assign permission</a></li>

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
				<th width="5%" >Id</th>
				<th width="40%">名称</th>
				<th width="10%">状态</th>
				<th>Actions</th>
			</tr>
		</thead>
		<tbody class="adminTable">				
<?php foreach((array)\Dothing\Lib\Factory::GetModel(strtolower('Role'))->TreeData() as $key_0=>$item_0) : ?>
<?php $item_0=(array)$item_0; ?>

		<tr>
			<td><?php echo $item_0['id']?></td>
			<td><a href="http://localhost:81/dothing/demo/index.php/ads007/user/editrole@id=<?php echo $item_0['id']?>"><?php echo $item_0['name']?></a></td>
			<td><?php echo showStatus($item_0['state'],'role',$item_0['id'])?></td>
			<td>
				<a class="glyphicon glyphicon-edit" href="http://localhost:81/dothing/demo/index.php/ads007/user/editrole@id=<?php echo $item_0['id']?>"></a>
				<a class="glyphicon glyphicon-trash" href="#" data-toggle="modal" data-target="#DOModal_<?php echo $item_0['id']?>"></a>
				<div class="modal fade" id="DOModal_<?php echo $item_0['id']?>">
					<div class="modal-dialog">
						<div class="modal-content">
							<form id="form<?php echo $item_0['id']?>" action="http://localhost:81/dothing/demo/index.php/autocrud/Delete/role" method="post">
								<div class="modal-header">
									<a class="close" data-dismiss="modal">×</a>
									<h3>Warning</h3>
								</div>
								<div class="modal-body">
									<p>Do you want to delete this item?</p>
								</div>
								<div class="modal-footer">
									<a href="javascript:void(0);" onclick="jQuery('#form<?php echo $item_0['id']?>').submit()" class="btn btn-sm btn-success">
										<i class="glyphicon glyphicon-ok glyphicon-white"></i>
										Yes									</a>
									<a data-dismiss="modal" class="btn btn-sm btn-warning">
										<i class="glyphicon glyphicon-remove glyphicon-white"></i>
										取消									</a>
									<input type="hidden" id="__redirect" name="__redirect" value="http://localhost:81/dothing/demo/index.php/ads007/user/role"/>
									<input type="hidden" id="id" name="id" value="<?php echo $item_0['id']?>"/>
								</div>
							</form>
						</div>
					</div>
				</div>
				<a class="glyphicon glyphicon-user" href="http://localhost:81/dothing/demo/index.php/assign/permission-<?php echo $item_0['id']?>"></a>
			</td>
		</tr>
		
<?php endforeach;?>
</tbody>
</table>
</div>
