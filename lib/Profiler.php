<?php
/**
**@description
**We need to have profiles to see what things need to be improved.
**/
class DOProfiler
{
	public static $_loader = array();
	/**It would mark before a chunks of codes**/
	public static function MarkStart($name)
	{
		$_loader[$name]['start'] 	= DOUnit::GetTime();
		$_loader[$name]['memory'] 	= DOUnit::GetMemory();
	}
	/**It would mark after a chunks of codes**/
	public static function MarkEnd($name)
	{
		$_loader[$name]['end'] 		= DOUnit::GetTime();
		$_loader[$name]['memory'] 	= DOUnit::GetMemory();
	}
	public static function GetSpentTime() 
	{
		return "";
	}
	public static function Display()
	{
		
	}
}
?>