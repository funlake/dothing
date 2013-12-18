<?php 
!defined('DO_ACCESS') AND DIE("Go Away!"); 
$searchIndex = "DOSearch/".DORouter::GetPageIndex();
$searchs     = SG($searchIndex);
?>
<form action="<?php echo Url('autocrud/Add/rolepermission');?>" method="post" id="Afm" name="Afm" class="form-horizontal">
<div class="row well">
	<div class="col-lg-8">
       <h4> <?php echo $data->name;?></h4>
	</div>
	<div class="col-lg-4 text-right">
        <button class="btn btn-danger" id="backlink" onclick="location.href='<?php echo Url('admin/user/role');?>';return false;">
        <i class="glyphicon glyphicon-chevron-left glyphicon-white"></i>
        <?php echo L('Back');?>
      </button>
		  <button class="btn btn-success" id="submitForm">
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
    	
    <div:loop=Model|Module.Find class="panel-group" id="accordion">
        <div class="panel panel-default">
          <div class="panel-heading">
            <h4 class="panel-title">
              <a data-parent="#accordion" href="javascript:void(0)">
                {#name}
              </a>
            </h4>
          </div>
          <div id="collapse{#id}" class="panel-collapse collapse in">
            <div class="panel-body">
                <div:loop=Model|Rolepermission.GetOperationPermission({#[id]},<?php echo $roleId;?>)>
                  <div class="checkbox-inline">
                  <input type="checkbox" class="btn" name="action[]" value="{#module_id}_{#oid}" {#checked}/><label>{#oname}</label>
                  </div>
               </div:loop>
            </div>
          </div>
        </div>
    </div:loop>
     <div:paginate=Model|Module.GetTotal class="pull-right"/>
 </div>
 <input type="hidden" id="__token" name="__token" value="<?php echo DOBase::SetToken()?>"/>
 <input type="hidden" name="role_id" value="<?php echo $_GET['id'];?>"/>
</form>