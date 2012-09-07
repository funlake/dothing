<?php !defined('DO_ACCESS') AND DIE("Go Away!"); ?>
<div class="panel-wrapper fixed">
	<div class="panel">
		<div class="title">
			<h4>
				Users
			</h4>
		</div>
		<table>
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
					<td><a href="/{#user_id}"><?php echo DOLang::Get('edit');?></a></td>
				</tr>
			</tbody:loop>
		</table>
	</div>
</div>