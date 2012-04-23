<?php 
class DOCacheWS
{	
	/** Cache handler,default by 'file' **/
	public static $cacheHandler;
	/** Instance of cache handler **/
	public static $engine;
	
	function DOCacheWS( )
	{
		$drive		  		= DO_CACHEHANDLER ;
		self::$cacheHandler = 'DOCache'.ucwords(strtolower($drive));
	
		if( self::CheckEngine( $drive ))
		{
			self::LoadEngine();
		}
	}
	
	function CheckEngine( $drive )
	{
		DOLoader::Import('lib.cache.'.$drive.'.cache_'.$drive); 
		
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