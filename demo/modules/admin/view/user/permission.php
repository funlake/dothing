<?php 
!defined('DO_ACCESS') AND DIE("Go Away!"); 
$searchIndex = "DOSearch/".DORouter::GetPageIndex();
$searchs     = SG($searchIndex);
?>
<form action="<?php echo Url('autocrud/Update/permission');?>" method="post" id="Afm" name="Afm" class="form-horizontal">
<div class="row well">
	<div class="col-lg-8">
          
	</div>
	<div class="col-lg-4 text-right">
		  <button class="btn btn-sm btn-success" id="submitForm">
	  		<i class="glyphicon glyphicon-ok glyphicon-white"></i>
	  		<?php echo L('Save');?>
	  	</button>
	</div>
</div>
<div class="row">
    <?php
      $titleStyle = array(
          'panel-warning','panel-primary'
      );
    ?>
    	
    <div:loop=Model|Module.Find class="masonry">
        <div class="box">
              <div class="panel panel-warning">
                  <div class="panel-heading">{#name}({#interface})</div>
                    <table class="table table-striped table-bordered table-hover">
                          <thead>
                            <tr>
                              <th width="5%">#</th>
                              <th width="30%"><?php echo L("Operation");?></th>
                              <th><?php echo L('Ineterface');?></th>
                            </tr>
                          </thead>
                          <tbody:loop=Model|Permission.GetOperationPermissionSetting({#[id]}) class="adminTable">
                                <tr>
                                          <td><input type="checkbox" class="btn" name="action[]" value="{#@item_0['id']}_{#oid}" {#checked} /></td>
                                           <td>{#oname}</td>
          	                    		     <td><input type="text" class="form-control" name="action_interface[{#@item_0['id']}_{#oid}]" value="{#url_pattern}" placeholder="Link..."/></td>
          	                    	</tr>
                              </li>
                            </tbody:loop>
                  </table>
              </div>
         </div>
    </div:loop>
     <div:paginate=Model|Module.GetTotal class="pull-right"/>
 </div>
 <input type="hidden" id="__token" name="__token" value="<?php echo DOBase::SetToken()?>"/>
</form>