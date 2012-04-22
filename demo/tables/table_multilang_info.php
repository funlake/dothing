<?php
$f[0] = array(
	'multilang_table_id'=>'INTEGER',
	'key_id'=>'INTEGER',
	'#language_id'=>'INTEGER',
	'content'=>'TINYTEXT',
	'value'=>'TINYTEXT',
);
$f[1] = array(
	'multilang_table.multilang_table_id' => true,
	'language.language_id' => true,
);
return $f;
?>