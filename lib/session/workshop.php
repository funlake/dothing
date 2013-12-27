<?php 
ini_set('session.use_cookies',1);
ini_set('session.use_only_cookies',1);
ini_set('session.auto_start',0);
class DOSessionWS
{	
	/** Session handler,default by 'file' **/
	public static $sessionHandler;
	/** What drive we using **/
	public static $drive;
	/** Engine **/
	public static $engine;
	function DOSessionWS( )
	{
		self::$drive		  = DO_SESSHANDLER;
		self::$sessionHandler = 'DOSession'.ucwords(strtolower(self::$drive));
	
		if( self::CheckEngine( self::$drive ))
		{
			self::LoadEngine();
		}
	}
	
	function CheckEngine( $drive )
	{
		return DOLoader::Import('lib.session.drivers.sess_'.$drive); 
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
			self::$engine = DOFactory::GetTool('session',self::$drive);
		}
		return self::$engine;
	}
	
}

?>