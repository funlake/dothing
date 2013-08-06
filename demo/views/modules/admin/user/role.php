<div class="well">
	<form class="form-inline" id="Afm" method="post">
		<div class="row-fluid span10 input-appened btn-group">
			<input type="text" name="DO[search][name]" id="name" class="span7" 
			placeholder="Name"
			value=""
			/>
			<button class="btn btn-success" onclick="jQuery('#Afm').submit()">
					<i class="icon-search icon-white"></i>
					Search			</button>
			<button class="btn btn-warning" onclick="jQuery('#name').val('');jQuery('#Afm').submit()">
					<i class="icon-refresh icon-white"></i>
					Reset			</button> 
		</div>
		<div class="btn-group pull-right">
				<span class="btn btn-danger"><i class="icon-wrench icon-white"></i> Action</span>
				<a class="btn btn-danger dropdown-toggle" data-toggle="dropdown" href="#"><span class="caret"></span></a>
				<ul class="dropdown-menu">
					<li><a href='javascript:void(0)' onclick="location.href='http://localhost:81/dothing/demo/index.php/ads007/user/addrole'"><i class="icon-plus"></i> Add</a></li>
					<!-- 	    <li class="divider"></li> -->
					<!-- 	    <li><a href="#"><i class="i"></i> Make admin</a></li> -->
				</ul>
		</div>
	</form>
</div>
<table class="table table-striped table-bordered table-hover">
	<thead>
		<tr>
			<th width="5%" >Id</th>
			<th width="25%">Name</th>
			<th width="10%">Status</th>
			<th>Actions</th>
		</tr>
	</thead>
	<tbody class="adminTable">				
<?php foreach((array)DOFactory::GetModel(strtolower('Role'))->TreeData() as $key_0=>$item_0) : ?>
<?php $item_0=(array)$item_0; ?>

		<tr>
			<td><?php echo $item_0['id']?></td>
			<td><?php echo $item_0['name']?></td>
			<td><?php echo showStatus($item_0['state'],'role',$item_0['id'])?></td>
			<td>
				<a class="icon-edit" href="http://localhost:81/dothing/demo/index.php/ads007/user/editrole@id=<?php echo $item_0['id']?>">
				</a>
				<a class="icon-trash" href="#" data-toggle="modal" data-target="#DOModal_<?php echo $item_0['id']?>"></a>
				<div class="modal" id="DOModal_<?php echo $item_0['id']?>" style="display:none">
				  <form id="form<?php echo $item_0['id']?>" action="http://localhost:81/dothing/demo/index.php/autocrud/Delete/role" method="post">
					  <div class="modal-header">
					    <a class="close" data-dismiss="modal">×</a>
					    <h3>Warning</h3>
					  </div>
					  <div class="modal-body">
					    <p>Do you want to delete this item?</p>
					  </div>
					  <div class="modal-footer">
					  	<a href="javascript:void(0);" onclick="jQuery('#form<?php echo $item_0['id']?>').submit()" class="btn btn-success">
					  		<i class="icon-ok icon-white"></i>
					  		Yes					  	</a>
					    <a data-dismiss="modal" class="btn btn-warning">
					    	<i class="icon-remove icon-white"></i>
					    	Cancel					   	</a>
						<input type="hidden" id="__redirect" name="__redirect" value="http://localhost:81/dothing/demo/index.php/ads007/user/role"/>
						<input type="hidden" id="id" name="id" value="<?php echo $item_0['id']?>"/>
					   </div>
				   </form>
				</div>
			</td>
		</tr>
		
<?php endforeach;?>
</tbody>
</table>
