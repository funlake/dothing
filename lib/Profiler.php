<?php
/**
**@description
**We need to have profiles to see what things need to be improved.
**/
class DOProfiler
{
	public static $_timer = array();
	public static $_ordering = 0;
	/**It would mark before a chunks of codes**/
	public static function MarkStartTime($name)
	{
		self::$_timer[$name] = array();
		self::$_timer[$name]['start'] 	= DOUnit::GetTime();
		self::$_timer[$name]['ordering']	= ++self::$_ordering;
		//$_timer[$name]['memory'] 	= DOUnit::GetMemory();
	}
	/**It would mark after a chunks of codes**/
	public static function MarkEndTime($name,$file='')
	{
		self::$_timer[$name]['spent'] 		= round(DOUnit::GetTime() - self::$_timer[$name]['start'],5);
		self::$_timer[$name]['file'] 		= $file;

		//$_timer[$name]['memory'] 	= DOUnit::GetMemory();
	}
	public static function GetTimer() 
	{
		return self::$_timer;
	}
}
?>