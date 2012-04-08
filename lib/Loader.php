<?php
/**
 * loader
 */
class DOLoader
{
	private static $loaded = array();
	public static function AutoLoad($class)
	{
		include_once FRAMEWORK_ROOT.DS.''
			    .'lib'.DS
			    .str_replace('_',DS,preg_replace('#^DO#','',$class)).".php";
	}
	/**
	 * multiple files load.
	 *
	 * @return true if loaded successfully,or false.
	 */
	function Import()
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
