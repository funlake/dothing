<?php
class DOHelper
{
	public static function GetDataLimit()
	{
		$page = self::GetCurPage();
		if(defined('DO_LIST_ROWS'))
		{
			$offset = DO_LIST_ROWS;
		}
		else
		{
			$offset = 20;
		}
		return array(($page-1) * $offset , $offset);
	}

	public static function GetCurPage()
	{
		$params = DORouter::GetParams();
		if(defined('DO_PAGE_INDEX'))
		{
			$page = $params[DO_PAGE_INDEX];
		}
		else
		{
			$page = $_REQUEST['page'];
		}
		$page = max((int)$page,1);
		return $page;		
	}
}