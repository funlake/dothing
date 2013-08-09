<?php 
!defined('DO_ACCESS') AND DIE("Go Away!"); 
$searchIndex = "DOSearch/".DORouter::GetPageIndex();
$searchs     = SG($searchIndex);
?>
<div class="row well">
	<form class="form-horizontal" id="Afm" method="post">
		<div class="col-lg-5">
			<input type="text" name="DO[search][name]" id="group_name_search" 
			placeholder="<?php echo L('Name');?>"
			value="<?php echo $searchs['name'];?>" class="form-control "
			/>
		</div>
		<div class="btn-group col-lg-4">
			<button class="btn  btn-success" onclick="jQuery('#Afm').submit()">
				<i class=" glyphicon glyphicon-search glyphicon-white"></i>
				<?php echo L('Search');?>
			</button>
			<button class="btn btn-warning" onclick="jQuery('#group_name_search').val('');jQuery('#Afm').submit()">
				<i class="glyphicon glyphicon-refresh glyphicon-white"></i>
				<?php echo L('Reset');?>
			</button> 
		</div>
		<div class="btn-group  col-lg-3">
			<span class="btn btn-danger"><i class="glyphicon glyphicon-wrench glyphicon-white"></i> <?php echo L('Action');?></span>
			<a class="btn btn-danger dropdown-toggle" data-toggle="dropdown" href="#"><span class="caret"></span></a>
			<ul class="dropdown-menu">
				<li><a href='javascript:void(0)' onclick="location.href='<?php echo Url(DO_ADMIN_INTERFACE.'/user/addgroup','');?>'"><i class="glyphicon glyphicon-plus"></i> <?php echo L('Add');?></a></li>
				<!-- 	    <li class="divider"></li> -->
				<!-- 	    <li><a href="#"><i class="i"></i> Make admin</a></li> -->
			</ul>
		</div>
	</form>
</div>
<div class="row">
<div class="masonry">
         <div class="box">
		<div class="panel panel-info">
		  <div class="panel-heading">User</div>
			<ul class="list-group">
			  <li class="list-group-item">Access</li>
			  <li class="list-group-item">Add</li>
			  <li class="list-group-item">Update</li>
			  <li class="list-group-item">Remove</li>
			  <li class="list-group-item">Assign</li>
			</ul>
		</div>
         </div>
         <div class="box">
             <div class="article">
                <img alt="Jaipure picture" class="thumbnail" src="img/Jaipur-2.JPG">
                  <h4>Jaipur picture 02</h4>
                  <p>Donec id elit non mi porta gravida at eget metus. Fusce
        dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut
        fermentum massa justo sit amet risus. Etiam porta sem malesuada magna
        mollis euismod. Donec sed odio dui. <a class="" href="#">Read more »</a></p>
             </div>
         </div>
         <div class="box">
             <div class="article">
                <img alt="Jaipure picture" class="thumbnail" src="img/Jaipur-3.JPG">
                  <h4>Jaipur picture 03</h4>
                  <p>Donec id elit non mi porta gravida at eget metus. Fusce
        dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut
        fermentum massa justo sit amet risus. Etiam porta sem malesuada magna
        mollis euismod. Donec sed odio dui. <a class="" href="#">Read more »</a></p>
             </div>
         </div>
         <div class="box">
             <div class="article">
                <img alt="Jaipure picture" class="thumbnail" src="img/Jaipur-4.JPG">
                  <h4>Jaipur picture 04</h4>
                  <p>Donec id elit non mi porta gravida at eget metus. Fusce
        dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut
        fermentum massa justo sit amet risus. Etiam porta sem malesuada magna
        mollis euismod. Donec sed odio dui. <a class="" href="#">Read more »</a></p>
             </div>
         </div>
         <div class="box">
             <div class="article">
                <img alt="Jaipure picture" class="thumbnail" src="img/Jaipur-5.JPG">
                  <h4>Jaipur picture 05</h4>
                  <p>Donec id elit non mi porta gravida at eget metus. Fusce
        dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut
        fermentum massa justo sit amet risus. Etiam porta sem malesuada magna
        mollis euismod. Donec sed odio dui. <a class="" href="#">Read more »</a></p>
             </div>
         </div>
         <div class="box">
             <div class="article">
                <img alt="Jaipure picture" class="thumbnail" src="img/Jaipur-6.JPG">
                  <h4>Jaipur picture 06</h4>
                  <p>Donec id elit non mi porta gravida at eget metus. Fusce
        dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut
        fermentum massa justo sit amet risus. Etiam porta sem malesuada magna
        mollis euismod. Donec sed odio dui. <a class="" href="#">Read more »</a></p>
             </div>
         </div>
      </div> <!-- /container -->
 </div>