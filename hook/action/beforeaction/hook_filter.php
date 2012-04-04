<?php
class hookFilter extends DOHook
{
	function onbeforeAction()
	{
		$isAdmin	 = DOBase::get('backend');
		$file 		 = parent::$env['module'].'_'.parent::$env['controller'].'_'.parent::$env['action'];
		DOLoader::import('hook.filter.'.($isAdmin ? ($isAdmin.'.') : '').$file);
	}
}
?>
