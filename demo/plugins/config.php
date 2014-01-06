<?php
return array(
	'afterpagerender'	=> array(
		'system'	=> 1
	)
   ,'afterroute'		=> array(
   		'system'	=> 1
   	)
   ,'prepareroute'		=> array(
   		'system'	=> 1,'authorize' => true,'accesscheck'=>true
   	)
   ,'preparesql'		=> array(
   		'system'	=> 1
   	)
   ,'shutdown'			=> array(
   		'system'	=> 1
   	)
);