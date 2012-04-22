<?php
$f[0] = array(
	'@field_id'=>'INTEGER',
	'#model_id'=>'INTEGER',
	'field_name'=>'VARCHAR(50)',
	'show_name'=>'VARCHAR(50)',
	'field_type'=>'VARCHAR(255)',
	'field_view'=>'VARCHAR(50)',
	'field_options'=>'VARCHAR(255)',
	'tips'=>'VARCHAR(255)',
	'check_pattern'=>'VARCHAR(255)',
	'check_error'=>'VARCHAR(255)',
	'is_key'=>'TINYINT',
	'is_main'=>'TINYINT',
	'is_basic'=>'TINYINT',
	'state'=>'TINYINT',
	'ordering'=>'INTEGER',
);
$f[1] = array(
	'model.model_id' => true,
);
return $f;
?>