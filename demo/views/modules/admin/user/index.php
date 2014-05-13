<div class="row well">
	<form class="form-horizontal" id="Afm" method="post">
		<div class="col-lg-5">
			<input type="text" name="DO[search][user_name]" id="user_name" 
			placeholder="名称"
			value="" class="form-control "
			/>
		</div>
		<div class="btn-group col-lg-4">
			<button class="btn btn-sm  btn-success" onclick="jQuery('#Afm').submit()">
				<i class="glyphicon glyphicon-search glyphicon-white"></i>
				搜索			</button>
			<button class="btn btn-sm btn-warning" onclick="jQuery('#user_name').val('');jQuery('#Afm').submit()">
				<i class="glyphicon glyphicon-refresh glyphicon-white"></i>
				清空			</button> 
		</div>
		<div class="btn-group  col-lg-3">
			<span class="btn btn-sm btn-danger"><i class="glyphicon glyphicon-wrench glyphicon-white"></i> 操作</span>
			<a class="btn btn-sm  btn-danger dropdown-toggle" data-toggle="dropdown" href="#"><span class="caret"></span></a>
			<ul class="dropdown-menu">
				<li><a href='javascript:void(0)' onclick="location.href='http://localhost:81/dothing/demo/index.php/ads007/user/add'"><i class="glyphicon glyphicon-plus"></i> 添加</a></li>
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
				<th width="5%"><a data-toggle='post' data-link='http://localhost:81/dothing/demo/index.php/manage/user' class='sorter' data-key='order,sort' data-value='u.id,desc' href='javascript:void(0);'>Id</a></th>
				<th width="30%"><a data-toggle='post' data-link='http://localhost:81/dothing/demo/index.php/manage/user' class='sorter' data-key='order,sort' data-value='u.user_name,desc' href='javascript:void(0);'>名称</a></th>
				<th width="20%">用户组</th>
				<th width="20%">角色</th>
				<th width="10%"><a data-toggle='post' data-link='http://localhost:81/dothing/demo/index.php/manage/user' class='sorter' data-key='order,sort' data-value='u.state,desc' href='javascript:void(0);'>状态</a></th>
				<th>操作</th>
			</tr>
		</thead>
		<tbody class="adminTable">				
<?php foreach((array)\Dothing\Lib\Factory::GetModel(strtolower('User'))->UserGroupList() as $key_0=>$item_0) : ?>
<?php $item_0=(array)$item_0; ?>

		<tr>
			<td><?php echo $item_0['id']?></td>
			<td><?php echo $item_0['user_name']?></td>
			<td><?php echo cutStr($item_0['group'],20)?></td>
			<td><?php echo cutStr($item_0['role'],20)?></td>
			<td><?php echo showStatus($item_0['state'],'user',$item_0['id'])?></td>
			<td>
				<a class="glyphicon glyphicon-edit" href="http://localhost:81/dothing/demo/index.php/manage/user-<?php echo $item_0['id']?>"></a>
				<?php echo showCfm($item_0['id'],'autocrud/Delete/user')?>
			</td>
		</tr>
		
<?php endforeach;?>
</tbody>
</table>
<div class="pull-right">		<?php
		 $pager = \Dothing\Lib\Factory::GetWidget('paginate','default', \Dothing\Lib\Factory::GetModel(strtolower('User'))->GetTotal(),DO_LIST_ROWS);
		 echo $pager->Render();
		 ?></div>
</div>
