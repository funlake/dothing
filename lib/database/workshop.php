<?php
/**
* Database Work Shop
*/
class DODatabaseWS
{
	private static $engine = array();
    private static $syntax;	
    private static $loader;
    private $handlerKey = '';
	function DODatabaseWS( $driver ,$params=array())
	{
		/** Build a key for handler **/
		$this->handlerKey = $driver."_".serialize($params);
		/** Check if we have implegment this driver **/
		if( self::checkEngine( $driver ))
		{
			self::loadEngine($driver,$params);
		}
		
	}
	/** Check if we have this driver **/
	public function CheckEngine( $driver )
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
	/** Load and initial **/
	public function LoadEngine( $driver,$parmas=array() )
	{
		$driver = "DODatabase".ucwords(strtolower($driver));
		/** If we dont pass any params,then use default driver && params **/
		if(!$parmas)
		{
			$params = array(DO_DBHOST,DO_DBUSER,DO_DBPASS,DO_DATABASE);
		}
		/** Database initial **/
		self::$engine[$this->handlerKey] =  call_user_func_array(
			array(new ReflectionClass( $driver ),'newInstance')
		   ,$params
		);
	}
	/** Get specify dirver **/
	public function GetEngine()
	{
		return self::$engine[$this->handlerKey];
	}
	/** Get syntax with driver **/
	public static function GetSyntax($driver)
	{
		if(!self::$syntax)
		{	
			DOLoader::import('lib.database.syntax');
			DOLoader::import('lib.database.syntax.'.$driver);
			$eg = ucwords( $driver ) . "Syntax";
			self::$syntax = new $eg();
		}			
		return self::$syntax;
	}
}
?>
