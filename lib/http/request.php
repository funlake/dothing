<?php

class DORequest extends DOBase
{
	public $serverVars = array('_get','_post','_request','_env','_server','_files','_cookie','_session');
	public static $requestVar = array('_post','_get','_cookie');
	public static $params;
	
	function DORequest(){}
	#
	#[Warning] Do not call twice in a same process(page)!!!
	#
	function clean()
	{
		$DO_GET    	= $this->filter($_GET);
		$DO_POST   	= $this->filter($_POST);
		$DO_REQUEST	= $this->filter($_REQUEST);
		$DO_ENV     = $_ENV;
		$DO_SERVER  = $_SERVER;
		$DO_FILES   = $_FILES;
		$DO_COOKIE  = $_COOKIE;
		$DO_SESSION = $_SESSION;
		foreach( $GLOBALS as $k=>$v)
		{
			if($k != 'GLOBALS') unset( $GLOBALS[$k] );
		}
		$_REQUEST	= $this->filter($this->stripVar($DO_REQUEST));
		$_GET		= $this->filter($this->stripVar($DO_GET));
		$_POST		= $this->filter($this->stripVar($DO_POST));
		$_COOKIE	= $this->filter($this->stripVar($DO_COOKIE));
		$_FILES		= $this->stripVar($DO_FILES);
		$_ENV 		= $this->stripVar($DO_ENV);
		$_SERVER 	= $this->stripVar($DO_SERVER);
		$_SESSION   = $this->filter($this->stripVar($DO_SESSION));
	}
	/**
	 * strip dangerous request variables
	 *
	 * @param unknown_type $sv
	 */
	function stripVar( $sv )
	{
		foreach( (array)$sv as $k=>$v)
		{
			$key = strtolower( $k );
			if(in_array( $key,$this->serverVars))
			{
				unset( $sv[$k] );
			}
			elseif(is_array( $v ) )
			{
				$this->stripVar( $sv[$k] );
			}
		}
		return $sv;
	}
	
	//should use ubb in frontend.
	function stripXss( &$sv )
	{
			//....
	}
	
	function filter( &$sv )
	{
		//return htmlspecialchars( $sv ,ENT_QUOTES);
		$DOFilter = & DOFactory::get('class',array('filter'));
		foreach( (array)$sv as $k=>$v)
		{
			if(!preg_match('#^DOEditor__#i',$k))
			{
				$sv[$k] = @$DOFilter->process( $sv[$k] );
			}
			else 
			{
				$sv[$k] = @$DOFilter->encode( $sv[$k] );
			}
		}
		return $sv;
	}
	
	function get( $gvar='',$var='')
	{
		//1 get value from gvar(get,post,cookie....)
		if( $gvar )
		{
			switch ($gvar )
			{
				case 'get':
					$gloablVar = $_GET;
				break;
				
				case 'post':
					$gloablVar = $_POST;
				break;
				
				case 'request':
					$gloablVar = $_REQUEST;
				break;
				
				case 'server':
					$gloablVar = $_SERVER;
				break;
				
				case 'env':
					$gloablVar = $_ENV;
				break;
				
				case 'cookie':
					$gloablVar = $_COOKIE;
				break;
				
				case 'session':
					$gloablVar = $_SESSION;
				break;
				
				case 'files':
					$gloablVar = $_FILES;	
				break;
				
				default:
					
				break;
			}
			if( $var )
			{
				return $gloablVar[$var];
			}
			else 
			{
				return $gloablVar;
			}
		}
	}
	
	function safeSql( $val )
	{
		$DOFilter = & DOFactory::get('class',array('filter'));
		
		return $DOFilter->safeSql( $val );
	}
	
}
?>
