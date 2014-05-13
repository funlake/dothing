<?php
namespace Dothing\Lib;
class Util
{
	public static $clock;
	public static function TimeStart()
	{
		$time = explode(' ',microtime() );
		self::$clock = (float)($time[0] + $time[1]);
	}

	public static function TimeEnd()
	{
		$time = explode(' ',microtime() );
		$time = (float)($time[0] + $time[1]);
		return round($time - self::$clock,2);
	}
}
?>