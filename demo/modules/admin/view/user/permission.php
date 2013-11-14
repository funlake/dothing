<?php 
!defined('DO_ACCESS') AND DIE("Go Away!"); 
$searchIndex = "DOSearch/".DORouter::GetPageIndex();
$searchs     = SG($searchIndex);
?>
<div class="row well">
	<form class="form-horizontal" id="Afm" method="post">
		<div class="col-lg-5">
			<input type="text" name="DO[search][name]" id="name_search" 
			placeholder="<?php echo L('Name');?>"
			value="<?php echo $searchs['name'];?>" class="form-control "
			/>
		</div>
		<div class="btn-group col-lg-4">
			<button class="btn  btn-success" onclick="jQuery('#Afm').submit()">
				<i class=" glyphicon glyphicon-search glyphicon-white"></i>
				<?php echo L('Search');?>
			</button>
			<button class="btn btn-warning" onclick="jQuery('#module_name_search').val('');jQuery('#Afm').submit()">
				<i class="glyphicon glyphicon-refresh glyphicon-white"></i>
				<?php echo L('Reset');?>
			</button> 
		</div>
	</form>
</div>
<div class="row">
	<table class="table table-striped table-bordered table-hover">
		<thead>
			<tr>
				<th width="30%"><?php echo DOMakeSortHead('name',L('Name'));?></th>
				<th><?php echo L('Actions');?></th>
			</tr>
		</thead>
		<tbody:loop=Model|Module.Find class="adminTable">
		<tr >
			<td data-toggle="tooltip" title="{#description}"s><a  href="<?php echo Url(DO_ADMIN_INTERFACE.'/user/editoperation','id=');?>{#id}">{#name}</a></td>
			<td>
				<ul:loop=Model|Operation.Select class="list-group">
					<li class="list-group-item"><input type="checkbox"/>{#name}</li>
				</ul:loop>
			</td>
		</tr>
	</tbody:loop>
</table>
<div:paginate=Model|Module.GetTotal class="pull-right"/>
</div>
<!--
<div class="row">
    <?php
      $titleStyle = array(
          'panel-warning','panel-primary'
      );
    ?>
    <div:loop=Model|Module.Find class="masonry">
        <div class="box">
              <div class="panel {#admin_title_class}">
                  <div class="panel-heading">{#name}({#interface})</div>
                  <ul class="list-group">
                    <li class="list-group-item">Access</li>
                    <li class="list-group-item">Add</li>
                    <li class="list-group-item">Update</li>
                    <li class="list-group-item">Remove</li>
                    <li class="list-group-item">Assign</li>
                  </ul>
              </div>
         </div>
    </div:loop>
     <div:paginate=Model|Module.GetTotal class="pull-right"/>
 </div>-->