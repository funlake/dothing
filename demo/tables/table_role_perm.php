<?php
$f[0] = array(
	'role_id'=>'INTEGER',
	'#model_id'=>'INTEGER',
	'#model_op_id'=>'INTEGER',
);
$f[1] = array(
	'role.role_id' => true,
	'model.model_id' => true,
	'model_op.model_op_id' => true,
);
return $f;
?>