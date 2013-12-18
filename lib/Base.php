<?php
class DOBase
{
	public static $_mark = array();
	public static $_vars = array();
	
	public function __construct()
	{
		//$this->Mark( get_class($this) );
		
		// if(version_compare(phpversion(),'5.0.0','<') && method_exists($this,'__destruct'))
		// {
		// 	register_shutdown_function(array($this,'__destruct'));
		// }
	}

	/**
	 * Set Token
	 */
	public static function SetToken()
	{
		$tokens = self::GenToken();
		$sess   = DOFactory::GetSession();
		$sess->Set('__token',$tokens);
		//setcookie('__token',$tokens,time()+60);
		return $tokens;
	}
	/**
	 * Get token
	 */
	public static function GetToken()
	{
		$sess   = DOFactory::GetSession();
		return $sess->Get('__token');
		//return $_COOKIE['__token'];
	}
	/**
	 * Gen token
	 *
	 * @return string
	 */
	public static function GenToken()
	{
		return md5(DO_SITECIPHER.uniqid( rand(),true ) );
	}
	public static function Set($p,$v)
	{
		self::$vars[$p] = $v;
	}
	
	public static function Get( $p ,$object='')
	{
		if(!is_object( $object ))
		{
			$object = $this;
		}
		return self::$vars[$p] ? self::$vars[$p] : false;	
	}
	
	/**
	 * read command 
	 *
	 * @param unknown_type $command
	 */
	function Command( $command )
	{
		$cmd = preg_match_all('#(-[a-z]+)(?:\s+([^\s]*)|$)#is',$command,$match);

		foreach( $match[1] as $k=>$v )
		{
			$fn = preg_replace('#^-+#','_',$v);
			$pa = $match[2][$k];
			$this->$fn( $pa );
		}
	}
	/**
	 * run command
	 *
	 * @param string $command
	 * @param array $args
	 */
	function Run( $command ,$args = array() )
	{
		self::Command( $command );
		/**
		 * call handler.
		 */
		call_user_func_array(array($this,$this->handler),$args);
	}

	
	public function Alia($alia,$class)
	{
		!defined($alia,$class) OR define($alia,$class);
	}
}
?>
