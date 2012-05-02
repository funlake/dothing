<?php
/**
* Database Work Shop
*/
class DODatabaseWS
{
	private static $engine = array();
    private static $syntax;	
    private static $loader;
	function DODatabaseWS( $drive ,$params=array())
	{
		if( self::checkEngine( $drive ))
		{
			self::loadEngine($drive,$params);
		}
	}
	
	function CheckEngine( $driver )
	{
		$path = FRAMEWORK_ROOT.DS.'lib'.DS."database".DS.'drivers'.DS.$driver.".php";

		if(!self::$loader[$path] && file_exists( $path ) )
		{
			self::$loader[$path] = true;
			require_once($path);
		}
		if(self::$loader[$path]) 
		{
			return true;
		}
		return false;
	}
	
	function LoadEngine( $driver,$parmas=array() )
	{
		$driver = "DODatabase".ucwords(strtolower($driver));
		/** If we dont pass any params,then use default driver && params **/
		if(!$parmas)
		{
			$params = array(DO_DBHOST,DO_DBUSER,DO_DBPASS,DO_DATABASE);
		}
		/** Database initial **/
		self::$engine[] =  call_user_func_array(
				array(new ReflectionClass( $driver ),'newInstance')
				,$params
		);
	}
	
	function GetEngine()
	{
		return end(self::$engine);
	}
	
	function GetSyntax()
	{
		if(!self::$syntax)
		{	
			DOLoader::import('lib.database.syntax');
			$eg = ucwords( DO_DBDRIVE ) . "Syntax";
			self::$syntax = new $eg();
		}			
		return self::$syntax;
	}
}
?>
