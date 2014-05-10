<?php 
namespace Dothing\Lib\Session;
ini_set('session.use_cookies',1);
ini_set('session.use_only_cookies',1);
ini_set('session.auto_start',0);
use \Dothing\Lib\Loader as Loader;
class Workshop
{	
	/** Session handler,default by 'file' **/
	public static $sessionHandler;
	/** What drive we using **/
	public static $drive;
	/** Engine **/
	public static $engine;
	function __construct( )
	{
		self::$drive		  = DO_SESSHANDLER;
		self::$sessionHandler = '\Dothing\Lib\Session\Drivers\\'.ucwords(self::$drive);
	
		if( self::CheckEngine( self::$drive ))
		{
			self::LoadEngine();
		}
	}
	
	function CheckEngine( $drive )
	{
		return Loader::Import('lib.session.drivers.'.$drive); 
	}
	
	function LoadEngine( )
	{
		$handler = self::$sessionHandler;
		$drive	 = self::$drive;	
		if( $drive != 'files')
		{
			ini_set('session.save_handler',$drive);
			session_set_save_handler(
			array($handler,"open")
			   ,array($handler,"close")
			   ,array($handler,"read")
			   ,array($handler,"write")
			   ,array($handler,"destroy")
			   ,array($handler,"gc")
			);
		}

	}
	
	function GetEngine()
	{
		if(!self::$engine)
		{
			//$handler = '\Dothing\Lib\Session\Drivers\\'.ucwords(self::$drive);
			self::$engine = new \Dothing\Lib\Session\Session(self::$drive);
		}
		return self::$engine;
	}
	
}

?>