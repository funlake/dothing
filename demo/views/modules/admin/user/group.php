<div class="row well">
	<form class="form-horizontal" id="Afm" method="post">
		<div class="col-lg-5">
			<input type="text" name="DO[search][name]" id="group_name_search" 
			placeholder="名称"
			value="" class="form-control "
			/>
		</div>
		<div class="btn-group col-lg-4">
			<button class="btn btn-sm btn-success" onclick="jQuery('#Afm').submit()">
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
				<li><a href='javascript:void(0)' onclick="location.href='http://localhost/dothing/demo/index.php/ads007/user/addgroup'"><i class="glyphicon glyphicon-plus"></i> 添加</a></li>
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
				<th width="30%"><a data-toggle='post' data-link='http://localhost/dothing/demo/index.php/manage/group' class='sorter' data-key='order,sort' data-value='g.name,desc' href='javascript:void(0);'>名称</a></th>
				<th width="25%">角色</th>
				<th width="10%"><a data-toggle='post' data-link='http://localhost/dothing/demo/index.php/manage/group' class='sorter' data-key='order,sort' data-value='g.ordering,desc' href='javascript:void(0);'>Ordering</a></th>
				<th width="10%">状态</th>
				<th>操作</th>
			</tr>
		</thead>
		<tbody class="adminTable">				
<?php foreach((array)\Dothing\Lib\Factory::GetModel(strtolower('Group'))->TreeData() as $key_0=>$item_0) : ?>
<?php $item_0=(array)$item_0; ?>

		<tr>
			<td><?php echo $item_0['id']?></td>
			<td><a href="http://localhost/dothing/demo/index.php/manage/group-<?php echo $item_0['id']?>"><?php echo $item_0['name']?></a></td>
			<td><?php echo cutStr($item_0['role'],20)?></td>
			<td><?php echo $item_0['ordering']?></td>
			<td><?php echo showStatus($item_0['state'],'group',$item_0['id'])?></td>
			<td>
				<?php echo showEditLink('id='.$item_0['id'],'admin/user/editgroup')?>
				<?php echo showCfm($item_0['id'],'autocrud/Delete/group')?>
			</td>
		</tr>
		
<?php endforeach;?>
</tbody>
</table>
<div >		<?php
		 $pager = \Dothing\Lib\Factory::GetWidget('paginate','default', \Dothing\Lib\Factory::GetModel(strtolower('Group'))->GetTotal(),DO_LIST_ROWS);
		 echo $pager->Render();
		 ?></div>
</div>
