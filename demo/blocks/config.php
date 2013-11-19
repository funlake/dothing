<?php
!defined('DO_ACCESS') AND die("How can you see me?");
return array(
	'mainmenu' => array(
		'!admin/user/login' 	=> 'admin.menu',
              // 'admin.menu' => array('#(?!^admin/user/login)#i')
	)
   ,'sidebar' => array(
   	'^admin/(?!user/login)(?:[^\/]*/(?:(?!edit)[a-zA-Z])+)$' 	=> 'admin.leftmenu'
   	)
   ,'message' => array(
   		'^admin' 		=> 'message'
   	)
   ,'bottom'  => array(
   	  //  '.*'  => 'profiler'
   	)
   ,'debug'  => array(
          '.*'  => 'profiler'
      )
);
