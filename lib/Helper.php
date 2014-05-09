<?php
namespace Dothing\Lib;
class Helper
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
		$params = \Dothing\Lib\Router::GetParams();
		if(defined('DO_PAGE_INDEX'))
		{
			$page = isset($params[DO_PAGE_INDEX]) ? $params[DO_PAGE_INDEX] : null ;
		}
		else
		{
			$page = $_REQUEST['page'];
		}
		$page = max((int)$page,1);
		return $page;		
	}
}