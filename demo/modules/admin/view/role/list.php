<?php
!defined('DO_ACCESS') AND Die("404");
?>
<table class="data display">
	<thead>
		<tr>
			<th>#</th>
			<th><?php echo DOLang::Get('Role');?></th>
			<th><?php echo DOLang::Get('Description');?></th>
			<th><?php echo DOLang::Get('Status');?></th>
		</tr>
	</thead>
	<tbody>
		<?php foreach((array)$data['roles'] as $key=>$role) :?>
			<tr>
					<td><?php echo $key+1;?></td>
					<td><?php echo $role->user_name;?></td>
					<td><?php echo $role->password;?></td>
					<td><?php echo $role->status;?></td>
			</tr>
		<?php endforeach;?>	
	</tbody>
	</table>