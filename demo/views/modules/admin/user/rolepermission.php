<form action="http://localhost/dothing/demo/index.php/autocrud/Add/rolepermission" method="post" id="Afm" name="Afm" class="form-horizontal">
<div class="row well">
	<div class="col-lg-8">
       <h4> Superadmins</h4>
	</div>
	<div class="col-lg-4 text-right">
        <button class="btn btn-danger" id="backlink" onclick="location.href='http://localhost/dothing/demo/index.php/ads007/user/role';return false;">
        <i class="glyphicon glyphicon-chevron-left glyphicon-white"></i>
        Back      </button>
		  <button class="btn btn-success" id="submitForm">
	  		<i class="glyphicon glyphicon-ok glyphicon-white"></i>
	  		Save	  	</button>
	</div>
</div>
<div class="row">
        	
    <div class="panel-group" id="accordion">				
<?php foreach((array)DOFactory::GetModel(strtolower('Module'))->Find() as $key_0=>$item_0) : ?>
<?php $item_0=(array)$item_0; ?>

        <div class="panel panel-default">
          <div class="panel-heading">
            <h4 class="panel-title">
              <a data-parent="#accordion" href="javascript:void(0)">
                <?php echo $item_0['name']?>
              </a>
            </h4>
          </div>
          <div id="collapse<?php echo $item_0['id']?>" class="panel-collapse collapse in">
            <div class="panel-body">
                <div >								
<?php foreach((array)DOFactory::GetModel(strtolower('Rolepermission'))->GetOperationPermission($item_0['id'],2) as $key_1=>$item_1) : ?>
<?php $item_1=(array)$item_1; ?>

                 <input type="checkbox" class="btn" name="action[]" value="<?php echo $item_1['module_id']?>_<?php echo $item_1['oid']?>" <?php echo $item_1['checked']?>><label><?php echo $item_1['oname']?></label>
               		
<?php endforeach;?>
</div>
            </div>
          </div>
        </div>
    		
<?php endforeach;?>
</div>
     <div class="pull-right">		<?php
		 $pager = DOFactory::GetWidget('paginate','default', DOFactory::GetModel(strtolower('Module'))->GetTotal(),DO_LIST_ROWS);
		 echo $pager->Render();
		 ?></div>
 </div>
 <input type="hidden" id="__token" name="__token" value="c4543a684197928acad8694a9a35408f"/>
 <input type="hidden" name="role_id" value="2"/>
</form>