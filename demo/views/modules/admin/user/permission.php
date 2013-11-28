<form action="http://localhost/dothing/demo/index.php/autocrud/Update/permission" method="post" id="Afm" name="Afm" class="form-horizontal">
<div class="row well">
	<div class="col-lg-8">
	</div>
	<div class="col-lg-4 text-right">
		  <button class="btn btn-success" id="submitForm">
	  		<i class="glyphicon glyphicon-ok glyphicon-white"></i>
	  		Save	  	</button>
	</div>
</div>
<div class="row">
        	
    <div class="masonry">				
<?php foreach((array)DOFactory::GetModel(strtolower('Module'))->Find() as $key_0=>$item_0) : ?>
<?php $item_0=(array)$item_0; ?>

        <div class="box">
              <div class="panel <?php echo $item_0['admin_title_class']?>">
                  <div class="panel-heading"><?php echo $item_0['name']?>(<?php echo $item_0['interface']?>)</div>
                  <ul class="list-group">								
<?php foreach((array)DOFactory::GetModel(strtolower('Permission'))->GetOperationPermission($item_0['id']) as $key_1=>$item_1) : ?>
<?php $item_1=(array)$item_1; ?>

                    <li class="list-group-item">
	                    	<div class="input-group">
	                    		<input type="text" class="form-control" name="action_interface[<?php echo $item_0['id']?>_<?php echo $item_1['oid']?>]" value="<?php echo $item_1['url_pattern']?>" placeholder="<?php echo $item_1['oname']?>">
	                    		<span class="input-group-btn">
	                    			<input type="checkbox" class="btn" name="action[]" value="<?php echo $item_0['id']?>_<?php echo $item_1['oid']?>" <?php echo $item_1['checked']?>> 
	                    		</span>
	                    	</div>
                    </li>
                  		
<?php endforeach;?>
</ul>
              </div>
         </div>
    		
<?php endforeach;?>
</div>
     <div class="pull-right">		<?php
		 $pager = DOFactory::GetWidget('paginate','default', DOFactory::GetModel(strtolower('Module'))->GetTotal(),DO_LIST_ROWS);
		 echo $pager->Render();
		 ?></div>
 </div>
 <input type="hidden" id="__token" name="__token" value="f7fe8d479a4790b129d47f748bfaf6e9"/>
</form>