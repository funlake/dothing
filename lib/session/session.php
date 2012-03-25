<?php
class DOSession extends DOBase 
{
	private static $engine;
	
	public static $sessionHandler;
	public static $drive;
	
	private static $savePath = array(
		'file' 		=> '/var/www/dothing/data/sess'
	   ,'memcache'	=> 'tcp://127.0.0.1:11211'
	);
	function DOSession( $drive ,$params=array())
	{
		self::$drive		  = $drive;
		self::$sessionHandler = 'DOSession_'.$drive;
		
		parent::__construct();
	
		if( self::checkEngine( $drive ))
		{
			self::loadEngine( );
		}
	}
	
	function checkEngine( $drive )
	{

		DOLoader::import('lib.session.'.$drive.'.sess_'.$drive); 
		
		if( class_exists(self::$sessionHandler) )
		{
			return true;
		}
		return false;
	}
	
	function loadEngine( )
	{
		$handler = self::$sessionHandler;
		$drive	 = self::$drive;			
		ini_set('session.save_handler',$drive);	
		if( $drive == 'mysql')
		{
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
	function start()
	{
		if( !headers_sent() )
		{
			//session name 
			session_name( md5(SYSTEM_NAME) );
			//session id
			if( ini_get('session.use_trans_sid') )
			{
				$request = & DOFactory::get( 'com',array('http_request') );
				if( $sid = $request->get( 'get',session_name() ))
				{
					session_id( $sid );
				}
			}
			//session path
			self::setSavePath();
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
	function end()
	{
		return session_write_close();
	}
	function getEngine()
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
	function set( $var , $val)
	{
		$_SESSION[ $var ]  = $val;
		return $val;
	}
	function get( $var )
	{
		return $_SESSION[ $var ];
	}
	/**
	 * clean single var or all vars
	 *
	 * @param string $var
	 */
	function clean( $var='')
	{
		if(!$var)
		{
			session_unset();
			session_destroy();
		}
		else 
		{
			unset( $_SESSION[ $var ] );
		}
	}

	function setSavePath()
	{
		$drive 		= self::$drive;
		$savePath	= self::$savePath[$drive];
		switch($drive)
		{
			case 'file':
				if(!is_dir( $savePath ))
				{
					$fileHandler = & DOFactory::get('com',array('file'));
					$fileHandler->makeDir($savePath);
				}
			break;

			case 'memcache':
						
			break;
		}
		session_save_path( $savePath );
	}
}
?>
