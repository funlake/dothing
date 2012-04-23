<?php
$f[0] = array(
	'@credit_id'=>'INTEGER',
	'#user_id'=>'INTEGER',
	'start_date'=>'DATE',
	'end_date'=>'DATE',
	'hours'=>'INTEGER',
	'title'=>'TINYTEXT',
	'created_by'=>'INTEGER',
	'is_note'=>'TINYINT',
	'publisher'=>'VARCHAR(50)',
	'training_address'=>'TINYTEXT',
	'traning_org'=>'TINYTEXT',
	'exam_score'=>'VARCHAR(10)',
	'self_score'=>'VARCHAR(10)',
	'org_score'=>'VARCHAR(10)',
	'remark'=>'TINYTEXT',
);
$f[1] = array(
	'user.user_id' => true,
);
return $f;
?>