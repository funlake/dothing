<div class="row well">
	<form class="form-horizontal" id="Afm" method="post">
		<div class="col-lg-5">
			<input type="text" name="DO[search][name]" id="name_search" 
			placeholder="Name"
			value="" class="form-control "
			/>
		</div>
		<div class="btn-group col-lg-4">
			<button class="btn  btn-success" onclick="jQuery('#Afm').submit()">
				<i class=" glyphicon glyphicon-search glyphicon-white"></i>
				Search			</button>
			<button class="btn btn-warning" onclick="jQuery('#module_name_search').val('');jQuery('#Afm').submit()">
				<i class="glyphicon glyphicon-refresh glyphicon-white"></i>
				Reset			</button> 
		</div>
	</form>
</div>
<div class="row">
	<table class="table table-striped table-bordered table-hover">
		<thead>
			<tr>
				<th width="30%"><a href='http://localhost:81/dothing/demo/index.php/ads007/user/permission@_doorder=name&_dosort=desc'>Name</a></th>
				<th>Actions</th>
			</tr>
		</thead>
		<tbody class="adminTable">				
<?php foreach((array)DOFactory::GetModel(strtolower('Module'))->Find() as $key_0=>$item_0) : ?>
<?php $item_0=(array)$item_0; ?>

		<tr >
			<td ><a  href="http://localhost:81/dothing/demo/index.php/ads007/user/editoperation@id=<?php echo $item_0['id']?>"><?php echo $item_0['name']?></a></td>
			<td>
				<ul class="list-group">								
<?php foreach((array)DOFactory::GetModel(strtolower('Operation'))->Select() as $key_1=>$item_1) : ?>
<?php $item_1=(array)$item_1; ?>

					<li class="list-group-item"><input type="checkbox"/><?php echo $item_1['name']?></li>
						
<?php endforeach;?>
</ul>
			</td>
		</tr>
			
<?php endforeach;?>
</tbody>
</table>
<div class="pull-right">		<?php
		 $pager = DOFactory::GetWidget('paginate','default', DOFactory::GetModel(strtolower('Module'))->GetTotal(),DO_LIST_ROWS);
		 echo $pager->Render();
		 ?></div>
</div>
<!--
<div class="row">
        <div class="masonry">				
<?php foreach((array)DOFactory::GetModel(strtolower('Module'))->Find() as $key_0=>$item_0) : ?>
<?php $item_0=(array)$item_0; ?>

        <div class="box">
              <div class="panel <?php echo $item_0['admin_title_class']?>">
                  <div class="panel-heading"><?php echo $item_0['name']?>(<?php echo $item_0['interface']?>)</div>
                  <ul class="list-group">
                    <li class="list-group-item">Access</li>
                    <li class="list-group-item">Add</li>
                    <li class="list-group-item">Update</li>
                    <li class="list-group-item">Remove</li>
                    <li class="list-group-item">Assign</li>
                  </ul>
              </div>
         </div>
    	
<?php endforeach;?>
</div>
     <div class="pull-right">		<?php
		 $pager = DOFactory::GetWidget('paginate','default', DOFactory::GetModel(strtolower('Module'))->GetTotal(),DO_LIST_ROWS);
		 echo $pager->Render();
		 ?></div>
 </div>-->