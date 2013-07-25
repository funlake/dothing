<?php
return array(
	"template" => array(
		"admin" => "bootstrap"
	),
	"layout" => array(
		"admin/user/login" => "blank",
		'#^admin/[^/]+/(edit|add).*$#is' => "edit"
	)
);