<?php
$f[0] = array(
	'@multilang_translate_id'=>'INTEGER',
	'#language_id'=>'INTEGER',
	'##multilang_content_id'=>'INTEGER',
	'content'=>'TINYTEXT',
	'updated_by'=>'INTEGER',
	'updated_time'=>'DATETIME',
);
$f[1] = array(
	'language.language_id' => true,
	'multilang_content.multilang_content_id' => true,
);
return $f;
?>