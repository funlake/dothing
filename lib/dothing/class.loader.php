<?php
/**
 * loader
 */
class DOLoader
{
	var $item;
	
	function load_class($className,$component='lib')
	{
		$dclass = '';
		if(strpos($className,".") !== FALSE)
		{
			$path 		= explode('.',$className);
			$dclass		= DS.$path[0].DS.$path[1];
			$filename 	= FRAMEWORK_ROOT.DS.$component.$dclass.DS.'class.'.$path[1].'.php';
		}
		else
		{
			$filename = FRAMEWORK_ROOT.DS.$component.DS.'dothing'.DS.'class.'.$className.'.php';
		}
		if(file_exists($filename))
		{
			require_once($filename);
			return true;
		}
		return false;
	}
	
	function load_function($functionName)
	{
		$filename = SYSTEM_ROOT.DS.'lib'.DS.'func.'.$functionName.'.php';
		if(file_exists($filename))
		{
			require_once($filename);
			return true;
		}
		return false;
	}
	function Autoload($class)
	{
		include_once FRAMEWORK_ROOT.DS
			    .'lib'.DS
			    .str_replace('_',DS,$class).".php";
	}
	/**
	 * multiple require.
	 *
	 * @return unknown
	 */
	function  import()
	{
		static $files = array();
		
		$args  = func_get_args();
		if($args[0] == '') return;
		foreach($args as $file)
		{
			if( !$files[ $file ] )
			{
				if(strpos($file,'.') !== false)
				{
					$f  = str_replace('.',DS,$file);
					
					$fs = FRAMEWORK_ROOT.DS.$f.'.php';

					if( file_exists($fs) )
					{
						require_once($fs);
					}
					else 
					{
						return false;
					}
				}
				else 
				{
					self::load_class($file) && self::load_function($file);
				}
				$files[ $file ] = true;
			}
			else continue;
		}
		return true;
	}
	
	
}
?>
