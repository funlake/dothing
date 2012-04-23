<?php
/**
* Database Work Shop
*/
class DODatabaseWS
{
	private static $engine;
    private static $syntax;	
	function DODatabaseWS( $drive ,$params=array())
	{
		if( self::checkEngine( 'pdo' ))
		{
			self::loadEngine( 'pdo_'.$drive , $params);
		}
	}
	
	function CheckEngine( $drive )
	{
		static $loader;
		
		$p    = explode('_',$drive,2);
		$r    = $p[0];
		$e    = $p[1] ? $p[1] : $p[0];
		
		$path = FRAMEWORK_ROOT.DS.'lib'.DS."database".DS.$r.DS."class.".$e.".php";

		if(!$loader[$path] && file_exists( $path ) )
		{
			$loader[$path] = true;
			require_once($path);
		}
		if($loader[$path]) 
		{
			return true;
		}
		return false;
	}
	
	function LoadEngine( $drive,$parmas=array() )
	{
		$e     = explode('_',$drive,2);
		$drive = "DO".$e[0]."_".ucwords($e[1] ? $e[1] : $e[0]);
		if(!!$parmas)
		{
			self::$engine = new $drive($parmas[0],$parmas[1],$parmas[2],$parmas[3]);
		}
		else self::$engine = new $drive(DO_DBHOST,DO_DBUSER,DO_DBPASS,DO_DATABASE);	
	}
	
	function GetEngine()
	{
		return self::$engine;
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
