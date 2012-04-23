<?php
$f[0] = array(
	'user_id'=>'INTEGER',
	'#group_id'=>'INTEGER',
);
$f[1] = array(
	'user.user_id' => true,
	'group.group_id' => true,
);
return $f;
?>