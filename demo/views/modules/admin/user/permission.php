<div class="row well">
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
				<li><a href='javascript:void(0)' onclick="location.href='http://localhost/dothing/demo/index.php/ads007/permission/add'"><i class="glyphicon glyphicon-plus"></i> Add</a></li>
				<!-- 	    <li class="divider"></li> -->
				<!-- 	    <li><a href="#"><i class="i"></i> Make admin</a></li> -->
			</ul>
		</div>
	</form>
</div>
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
</div> <!-- /container -->
     <div class="pull-right">		<?php
		 $pager = DOFactory::GetWidget('paginate','default', DOFactory::GetModel(strtolower('Module'))->GetTotal(),DO_LIST_ROWS);
		 echo $pager->Render();
		 ?></div>
 </div>