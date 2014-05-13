<form action="http://localhost:81/dothing/demo/index.php/autocrud/Update/permission" method="post" id="Afm" name="Afm" class="form-horizontal">
<div class="row well">
	<div class="col-lg-8">
          
	</div>
	<div class="col-lg-4 text-right">
		  <button class="btn btn-sm btn-success" id="submitForm">
	  		<i class="glyphicon glyphicon-ok glyphicon-white"></i>
	  		保存	  	</button>
	</div>
</div>
<div class="row">
        	
    <div class="masonry">				
<?php foreach((array)\Dothing\Lib\Factory::GetModel(strtolower('Module'))->Find() as $key_0=>$item_0) : ?>
<?php $item_0=(array)$item_0; ?>

        <div class="box">
              <div class="panel panel-warning">
                  <div class="panel-heading"><?php echo $item_0['name']?>(<?php echo $item_0['interface']?>)</div>
                    <table class="table table-striped table-bordered table-hover">
                          <thead>
                            <tr>
                              <th width="5%">#</th>
                              <th width="30%">Operation</th>
                              <th>Ineterface</th>
                            </tr>
                          </thead>
                          <tbody class="adminTable">								
<?php foreach((array)\Dothing\Lib\Factory::GetModel(strtolower('Permission'))->GetOperationPermissionSetting($item_0['id']) as $key_1=>$item_1) : ?>
<?php $item_1=(array)$item_1; ?>

                                <tr>
                                          <td><input type="checkbox" class="btn" name="action[]" value="<?php echo $item_0['id']?>_<?php echo $item_1['oid']?>" <?php echo $item_1['checked']?> /></td>
                                           <td><?php echo $item_1['oname']?></td>
          	                    		     <td><input type="text" class="form-control" name="action_interface[<?php echo $item_0['id']?>_<?php echo $item_1['oid']?>]" value="<?php echo $item_1['url_pattern']?>" placeholder="Link..."/></td>
          	                    	</tr>
                              </li>
                            		
<?php endforeach;?>
</tbody>
                  </table>
              </div>
         </div>
    		
<?php endforeach;?>
</div>
     <div class="pull-right">		<?php
		 $pager = \Dothing\Lib\Factory::GetWidget('paginate','default', \Dothing\Lib\Factory::GetModel(strtolower('Module'))->GetTotal(),DO_LIST_ROWS);
		 echo $pager->Render();
		 ?></div>
 </div>
 <input type="hidden" id="__token" name="__token" value="2597c161352ada13bcb790ef03305fa5"/>
</form>