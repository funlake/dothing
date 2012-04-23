<?php
$f[0] = array(
	'user_id'=>'INTEGER',
	'#department_id'=>'INTEGER',
	'#role_id'=>'INTEGER',
);
$f[1] = array(
	'user.user_id' => true,
	'department.department_id' => true,
	'role.role_id' => true,
);
return $f;
?>