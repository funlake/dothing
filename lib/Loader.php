<?php
namespace Dothing\Lib;
/**
 * loader
 */
class Loader
{
	private static $loaded = array();
	/**
	 * Load lib class
	 * @param string $class //class name
	 */
	public static function AutoLoadLib($class)
	{
		//echo $class."<br/>";
		// echo "<pre/>";
		// print_r(debug_backtrace());
		if(!array_key_exists($class,self::$loaded))
		{
			if(strpos($class,'Dothing') === 0 )
			{
				$path = str_replace(array('\\','dothing/'),array('/',FRAMEWORK_ROOT.'/'),strtolower($class)).".php";

				//$class = explode('\\',$class);

				//$class = array_pop($class);
			}
			if(strpos($class,'Application') === 0)
			{
				$path = str_replace(array('\\','application/'),array('/',SYSTEM_ROOT.'/'),strtolower($class)).".php";				
			}
			// if(!preg_match('#(?<!Do)Exception$#i',$class))
			// {
			// 	$file = FRAMEWORK_ROOT.DS
			// 	    .'lib'.DS
			// 	    .str_replace('_',DS,preg_replace('#^DO#','',$class)).".php";

			// 	file_exists($file) and include_once $file ;
			// 	self::$loaded[$file] = true;
			// }
			//echo $path."<br/>";

			if(file_exists($path))
			{
				include_once $path;
				if(class_exists($class))
				{
					self::$loaded[$class] = true;
				}

			}
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
			$exception = preg_replace(array('#^DO#','#exception$#i'),array('','_\0'), $exception);
			
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
			if( !isset(self::$loaded[ $file ] ))
			{
				$f  = str_replace('.',DS,$file);
				$ef = SYSTEM_ROOT.DS.'lib'.$f.'.php';
				$fs = FRAMEWORK_ROOT.DS.$f.'.php';
				if(file_exists($ef))
				{
					include_once $ef;
				}
				else if( file_exists($fs) )
				{
					include_once $fs;
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
