<?php
/**
 * loader
 */
class DOLoader
{
	private static $loaded = array();
	/**
	 * Load lib class
	 * @param string $class //class name
	 */
	public static function AutoLoadLib($class)
	{
		if(!preg_match('#(?<!Do)Exception$#i',$class))
		{
			@include_once FRAMEWORK_ROOT.DS
			    .'lib'.DS
			    .str_replace('_',DS,preg_replace('#^DO#','',$class)).".php";
		}
	}
	/**
	 * Load exception class
	 * @param string $exception //class name
	 */
	public static function AutoLoadException($exception)
	{
		if(preg_match('#exception$#i',$exception))
		{
			include_once FRAMEWORK_ROOT.DS.''
			.'lib'.DS
			.'exception'.DS.strtolower($exception).'.php';
		}
	}
	/**
	 * multiple files load.
	 *
	 * @return true if loaded successfully,or false.
	 */
	public static function Import()
	{
		$args  	= func_get_args();
		if($args[0] == '') return;
		foreach($args as $file)
		{
			if( !self::$loaded[ $file ] )
			{
				$f  = str_replace('.',DS,$file);
				
				$fs = FRAMEWORK_ROOT.DS.$f.'.php';

				if( file_exists($fs) )
				{
					include $fs;
				}
				else 
				{
					return false;
				}
				self::$loaded[ $file ] = true;
			}
			else continue;
		}
		return true;
	}
}
?>
