<?php
namespace Dothing\Lib;
class Unit
{
	public static function GetTime()
	{
		$time = explode(' ',microtime() );
		return (float)($time[0] + $time[1]);
	}

	public static function GetMemory()
	{

	}
}
?>