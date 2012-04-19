<?php

class DORequest extends DOBase
{
	public static $serverVars = array('_get','_post','_request','_env','_server','_files','_cookie','_session');
	public static $requestVar = array('_post','_get','_cookie');
	public static $params;
	
	function DORequest(){}
	#
	#[Warning] Do not call twice in a same process(page)!!!
	#
	function Clean()
	{
		$DO_GET    		= $_GET;
		$DO_POST   		= $_POST;
		$DO_REQUEST   		= $_REQUEST;
		$DO_FILES   		= $_FILES;
		$DO_COOKIE  		= $_COOKIE;
		/** Strip any unsafe variables**/ 
		foreach( $GLOBALS as $k=>$v)
		{
			if($k != 'GLOBALS') unset( $GLOBALS[$k] );
		}
<<<<<<< HEAD
		$_GET			= self::StripVar($DO_GET);
		$_POST			= self::StripVar($DO_POST);
		$_REQUEST		= self::StripVar($DO_REQUEST);
		$_COOKIE		= self::StripVar($DO_COOKIE);
		$_FILES			= self::StripVar($DO_FILES);
=======
		$_GET		= $this->StripVar($DO_GET);
		$_POST		= $this->StripVar($DO_POST);
		$_COOKIE	= $this->StripVar($DO_COOKIE);
		$_FILES		= $this->StripVar($DO_FILES);
>>>>>>> 210e8fa2ec129c52655dc14c9dea66ba20b4ea41
	}
	/**
	 * strip dangerous request variables
	 *
	 * @param unknown_type $sv
	 */
	public static function StripVar( $sv )
	{
		foreach( (array)$sv as $k=>$v)
		{
			$key = strtolower( $k );
			if(in_array( $key,self::$serverVars))
			{
				unset( $sv[$k] );
			}
			elseif(is_array( $v ) )
			{
				self::StripVar( $sv[$k] );
			}
		}
		return $sv;
	}
	/**
	 * Filter use requested variables,we dont trust any inputs from any visitor.
	 * @param unknown_type $sv
	 */
	static function Filter( &$sv )
	{
		$filter = DOFactory::GetFilter();
		return array_map(array($filter,'process'),$sv);
	}
	
	function Get( $var='',$gvar='get',$type='')
	{
		//1 get value from gvar(get,post,cookie....)
		$GV = ${'_'.strtoupper($var)};
		
		if( !empty($var) )
		{
			if($type) $type = strtolower($type);
			/** Return specify type we want **/
			return call_user_func(array(self,"To".ucwords($type)),$GV[$var]);
		}
		else 
		{
			/** Return all if we don't set the first param**/
			return $GV;
		}
		
	}
	
	public static function ToInt( $var )
	{
		return (int)$var;
	}
	
	public static function ToFloat($var)
	{
		return (float)$var;
	}
	
	public static function ToString( $var )
	{
		return (string)$var;
	}
	
	public static function ToArray( $var )
	{
		return (array)$var;
	}
}
?>
