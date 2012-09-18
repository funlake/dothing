<?php !defined('DO_ACCESS') AND DIE("Go Away!"); ?>
<div class="well">
	<table class="table table-striped">
		<thead>
			<tr>
				<th width="5%"><?php echo DOLang::Get('Id');?></th>
				<th width="20%"><?php echo DOLang::Get('Name');?></th>
				<th width="20%"><?php echo DOLang::Get('Password');?></th>
				<th><?php echo DOLang::Get('Actions');?></th>
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
</div>