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
	
	function DOSessionWS( )
	{
		self::$drive		  = DO_SESSHANDLER;
		self::$sessionHandler = 'DOSession'.ucwords(strtolower($drive));
	
		if( self::CheckEngine( $drive ))
		{
			self::LoadEngine();
		}
	}
	
	function CheckEngine( $drive )
	{

		DOLoader::Import('lib.session.'.$drive.'.sess_'.$drive); 
		
		if( class_exists(self::$sessionHandler) )
		{
			return true;
		}
		return false;
	}
	
	function LoadEngine( )
	{
		$handler = self::$sessionHandler;
		$drive	 = self::$drive;			
		if( $drive != 'file')
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
		return DOFactory::GetTool('session',self::$drive);
	}
	
}

?>