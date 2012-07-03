<?php
abstract class DOViewAdapater
{
	abstract public function Grid($config);
	abstract public function Tree($config);
	abstract public function MenuList($config);
	abstract public function GridTree($config);
	abstract public function TableList($config);
}
class DOView
{
	public function __construct($type)
	{

	}
	function display()
	{
		
	}
	
	function loadExtJs()
	{
		$root = DOUri::getRoot();
		echo <<<js
<script type='text/javascript' src='{$root}/resources/js/ext/adapter/ext/ext-base.js'></script>
<script type='text/javascript' src='{$root}/resources/js/ext/ext-all.js'></script>
<script type='text/javascript'>
Ext.BLANK_IMAGE_URL = '{$root}/resources/js/ext/resources/images/default/s.gif';
</script>
js;
	}
	function loadExtPlg()
	{
		$plgs = func_get_args();
		$root = DOUri::getRoot();
		foreach((array)$plgs as $v)
		{//ux/TabCloseMenu.js
			$scripts[] = "<script type='text/javascript' src='{$root}/resources/js/ext/ux/{$v}.js'></script>";
		}
		if(!!$scripts)
		{
			echo implode('',$scripts);
		}
	}
	function loadCalendarJs()
	{
		
	}

	public function _table()
	{

	}
	
}
?>