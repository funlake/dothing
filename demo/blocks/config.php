<?php
!defined('DO_ACCESS') AND die("How can you see me?");
return array(
	'mainmenu' => array(
		'admin:*' 	=> 'admin.menu'
	)
   ,'sidebar' => array(
   		'admin:*' 	=> 'admin.leftmenu'
   	)
   ,'message' => array(
   		'*' 		=> 'message'
   	)
);
