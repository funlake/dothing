<?php
return array(
	"template" => array(
		"admin" 	=> "bootstrap",
		"debug" 	=> "bootstrap",
		"install"	=> "bootstrap"
	),
	"layout" => array(
		"#admin/user/login#" => "blank",
		"#^install#"                 => "blank",
		'#^admin/[^/]+/(edit|add|rolepermission).*$#is' => "edit",
		"#^debug/index/nopermission$#" => "blank",
		"#^debug/index#" => "edit",


	)
);