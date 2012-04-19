<?php
class DOSession
{
	private static $engine;
	
	public static $sessionHandler;
	public static $drive;
	
	private static $savePath = array(
		'file' 		=> '/var/www/dothing/data/sess'
	   ,'memcache'	=> 'tcp://127.0.0.1:11211'
	);
	function DOSession( )
	{
		self::$drive		  = DO_SESSHANDLER;
		self::$sessionHandler = 'DOSession_'.$drive;
<<<<<<< HEAD
		if( self::CheckEngine( $drive ))
		{
			self::LoadEngine();
=======
		
		parent::__construct();
	
		if( self::CheckEngine( $drive ))
		{
			self::LoadEngine( );
>>>>>>> 210e8fa2ec129c52655dc14c9dea66ba20b4ea41
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
	/**
	 * session start
	 *
	 */
	function Start()
	{
		if( !headers_sent() )
		{	
			//session name 
			session_name( md5(SYSTEM_NAME) );
			//session id
			if( ini_get('session.use_trans_sid') )
			{
				$request = & DOFactory::GetTool('http.request');
<<<<<<< HEAD
				if( $sid = $request->Get(session_name()))
=======
				if( $sid = $request->Get(session_name() ))
>>>>>>> 210e8fa2ec129c52655dc14c9dea66ba20b4ea41
				{
					session_id( $sid );
				}
			}
			//session path
			self::SetSavePath();
			//ini_set('session.cookie_lifetime',...)';
			session_set_cookie_params( 0 );
			session_start();
		}
		
	}
	/**
	 * write close
	 *
	 * @return unknown
	 */
	function End()
	{
		return session_write_close();
	}
	function GetEngine()
	{
		return $this;
	}
	/**
	 * set session value
	 *
	 * @param unknown_type $var
	 * @param unknown_type $val
	 * @return unknown
	 */
	function Set( $var , $val)
	{
		$_SESSION[ $var ]  = $val;
		return $val;
	}
	function Get( $var )
	{
		return $_SESSION[ $var ];
	}
	/**
	 * clean single var or all vars
	 *
	 * @param string $var
	 */
	function Clean( $var='')
	{
		if(!$var)
		{
			session_unset();
			session_destroy();
			setcookie(session_name(),null,time()-3600);
		}
		else 
		{
			unset( $_SESSION[ $var ] );
		}
	}

	function SetSavePath()
	{
		$drive 		= self::$drive;
		$savePath	= self::$savePath[$drive];
		if(!empty($savePath))
		{
<<<<<<< HEAD
			switch($drive)
			{
				case 'file':
					if(!is_dir( $savePath ))
					{
						$fileHandler = & DOFactory::GetTool('file');
						$fileHandler->makeDir($savePath);
					}
				break;
	
				case 'memcache':
							
				break;
			}
			session_save_path( $savePath );
=======
			case 'file':
				if(!is_dir( $savePath ))
				{
					$fileHandler = & DOFactory::GetTool('file');
					$fileHandler->makeDir($savePath);
				}
			break;

			case 'memcache':
						
			break;
>>>>>>> 210e8fa2ec129c52655dc14c9dea66ba20b4ea41
		}
	}
	
	public function GetName(){return md5(SYSTEM_NAME);}
	public function GetId(){return session_id();}
}
?>
