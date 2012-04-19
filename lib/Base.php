<?php
class DOBase
{
	public static $_mark;
	private static $vars = array();
	
	public function __construct()
	{
		$this->mark( get_class($this) );
		
		if(version_compare(phpversion(),'5.0.0','<') && method_exists($this,'__destruct'))
		{
			register_shutdown_function(array($this,'__destruct'));
		}
	}
	public function Mark( $class )
	{
		if(!self::$_mark[ $class ])
		{
			self::$_mark[ $class ] = DOFactory::Get('time');
		}
	}
	
	public function Profile()
	{
		foreach( self::$_mark as $k=>$v)
		{
			self::$_mark[$k] = DOFactory::Get('time') - $v;
		}
		//print_r( self::$_mark );
	}
	
	public function Set($p,$v)
	{
		self::$vars[$p] = $v;
	}
	
	public function Get( $p ,$object='')
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
		parent::Command( $command );
		/**
		 * call handler.
		 */
		call_user_func_array(array($this,$this->handler),$args);
	}
	/**
	 * gen id
	 *
	 * @return unknown
	 */
	function GenId()
	{
		return md5( uniqid( rand(),true ) );
	}
	
	public function Alia($alia,$class)
	{
		!defined($alia,$class) OR define($alia,$class);
	}
}
?>
