<?php
$f[0] = array(
	'#user_id'=>'INTEGER',
	'department_id'=>'INTEGER',
);
$f[1] = array(
	'department.department_id' => true,
	'user.user_id' => true,
);
return $f;
?>