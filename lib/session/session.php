<?php
class DOSession
{	
	private static $savePath = array(
		'files' 		=> '/Applications/MAMP/htdocs/tmp'
	   ,'memcache'	=> 'tcp://127.0.0.1:11211'
	);
	private static $called = false;
	function DOSession($drive)
	{
		$this->drive = $drive;
		$this->Start();
	}
	/**
	 * session start
	 *
	 */
	function Start()
	{
		if( !headers_sent() && !self::$called)
		{	
			self::$called = true;
			//session name 
			session_name( md5(SYSTEM_NAME) );
			//session id
			if( ini_get('session.use_trans_sid') )
			{
				$sid 	 = 0;
				$request = & DOFactory::GetTool('http.request');
				if( $sid == $request->Get(session_name()))
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
	function Get( $var = '' )
	{
		if(empty($var)) return $_SESSION;
		return isset($_SESSION[ $var ]) ? $_SESSION[ $var ] : null;
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
		$drive 		= $this->drive;
		$savePath	= self::$savePath[$drive];

		if(!empty($savePath))
		{
			switch($drive)
			{
				case 'files':

					if(!is_dir( $savePath ))
					{
						$fileHandler =  DOFactory::GetTool('file.basic');

						$fileHandler->makeDir($savePath);
					}
				break;
	
				case 'memcache':
							
				break;
			}
			session_save_path( $savePath );
		}
	}
	
	public function GetName(){return md5(SYSTEM_NAME);}
	public function GetId(){return session_id();}
	/** Close session handler **/
	public function __destruct()
	{
		$this->End();
	}
}
?>
