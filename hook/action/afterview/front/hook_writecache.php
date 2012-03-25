<?php
class hookWritecache extends DOHook
{
	function onAfterview()
	{
		$args = func_get_args();
		$isAdmin = DOBase::get('backend');
		if(!$isAdmin)
		{
			echo parent::$env['arguments']['main'];	
		}
	}
}

?>
