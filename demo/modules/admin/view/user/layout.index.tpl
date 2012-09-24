<?php !defined('DO_ACCESS') AND DIE("Go Away!"); ?>
<?php 
$searchIndex = "DOSearch.".DORouter::GetPageIndex();
$session     = DOFactory::GetSession();
$searchs     = $session->Get($searchIndex);
?>
<div class="well">
	<form class="form-inline" id="Afm" method="post">
		<div class="row-fluid span6">
			<input type="text" name="DO[search][user_name]" id="user_name" class="span5" 
				   placeholder="<?php echo L('Name');?>"
				   value="<?php echo $searchs['user_name'];?>"
			/>
		</div>
	<div class="row-fluid pull-right span3">
	  <button class="btn btn-success" onclick="jQuery('#Afm').submit()">
	  	<i class="icon-search icon-white"></i>
	  	<?php echo L('Search');?>
	  </button>
	  <button class="btn btn-warning" onclick="jQuery('#user_name').val('');jQuery('#Afm').submit()">
	  	<i class="icon-refresh icon-white"></i>
	  	<?php echo L('Reset');?>
	  </button>
	</div>
	</form>
</div>
<table class="table table-striped table-bordered">
	<thead>
		<tr>
			<th width="5%"><?php echo L('Id');?></th>
			<th width="20%"><?php echo L('Name');?></th>
			<th width="20%"><?php echo L('Password');?></th>
			<th><?php echo L('Actions');?></th>
		</tr>
	</thead>
	<tbody:loop=Model|User.Find class="adminTable">
		<tr>
			<td>{#user_id}</td>
			<td>{#user_name}</td>
			<td>{#user_pass}</td>
			<td>
				<a class="icon-edit" href="<?php echo Url(DO_ADMIN_INTERFACE.'/user/edit@id=');?>{#user_id}">
				</a>
			</td>
		</tr>
	</tbody:loop>
</table>
<?php
echo M('user')->Count();
?>