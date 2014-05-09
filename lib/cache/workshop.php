<?php 
namespace Dothing\Lib\Cache;
class Workshop
{	
	/** Cache handler,default by 'file' **/
	public static $cacheHandler;
	/** Instance of cache handler **/
	public static $engine;
	
	function __construct()
	{
		$drive		  		= DO_CACHEHANDLER ;
		self::$cacheHandler = '\Dothing\Lib\Cache\Drivers\\'.ucwords(strtolower($drive));
		if( self::CheckEngine( $drive ))
		{
			self::LoadEngine();
		}
	}
	
	function CheckEngine( $drive )
	{
		//\Dothing\Lib\Loader::Import('lib.cache.drivers.'.$drive); 
		if( class_exists(self::$cacheHandler) )
		{
			return true;
		}
		return false;
	}
	
	function LoadEngine( )
	{
		$handler 	  = self::$cacheHandler;
		/** Initial class**/
		self::$engine = new $handler();
	}
	
	function GetEngine()
	{
		return self::$engine;
	}
}
?>