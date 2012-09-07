<?php
!defined('DO_ACCESS') AND DIE("Go Away!");
return array(
	'setting' => array(
		'save' => array(
			'action' => "jQuery('#DOAdminForm').submit()"
		   ,'icon'   => 'tasks'
		   ,'class'  => 'save-action'
		)
	   ,'cancel' => array(
			'action' => ''
		   ,'icon'   => 'profile'
		   ,'class'  => 'cancel-action'	   		
	   	)
	)

);