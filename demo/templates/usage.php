<?php
return array(
	"template" => array(
		"admin" => "bootstrap",
		"debug" => "bootstrap"
	),
	"layout" => array(
		"#admin/user/login#" => "blank",
		'#^admin/[^/]+/(edit|add|rolepermission).*$#is' => "edit",
		"#debug/index/index#" => "edit"
	)
);