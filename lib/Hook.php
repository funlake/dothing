<?php
class DOHook extends DOBase 
{
	static $container 	= array();
	public static $env 	= array();
	public $hookRoot;
	private static $pls 	= array();
	public function Hook()
	{
		$args 	= func_get_args();
		$type	= $args[0];
		$func   = $args[1];
		$param  = $args[2] ? $args[2] : array();
		if(!self::$pls[$type])
		{
			$cfg = include HOOKBASE . $type . DS . 'config.php';
			foreach( $cfg as $plg=>$enable)
			{
				if($enable)
				{
					include HOOKBASE . $type . DS . $plg .'.php';
					$class 			= 'DOPlg'.ucwords( $plg );
					self::$pls[$type]  	= new $class();
				}
			}
		}
		return method_exists(self::$pls[$type],$func)
		       ? call_user_func_array(array(self::$pls[$type],$func),$param)
		       : null;
	}	
	public function on()
	{
		$args 		= func_get_args();
		$type 		= $args[0];

		switch ( $type )
		{
			case 'beforeaction'	:
			case 'afteraction' 	:
			case 'afterview'	:	
				self::$env['module']		= $args[1];
				self::$env['controller']	= $args[2];
				self::$env['action']		= $args[3];
				self::$env['arguments']  	= $args[4] ? $args[4] : array();
				//self::$container[$type] = true;
				//check if backend
				$aof 	= parent::get('backend');
				//plg path
				$root 	= SYSTEM_ROOT.DS."hook"
						  .DS."action"
				 		  .DS.$type;
				 		  
				$folder.= $root . ($aof ? DS.$aof : DS.'front');
						  
				$plgs   = $folder.DS.implode('_',array(self::$env['module'],self::$env['controller'],self::$env['action']));
				#echo $root."-".$foler."-".$plgs."<br/>";		
				$this->fetchHooks( $root   , $type  , self::$env['arguments']);	
				$this->fetchHooks( $folder , $type  , self::$env['arguments']);
				$this->fetchHooks( $plgs   , $type  , self::$env['arguments']);
				break;
		}
	}
	
	function invoke( $path , $method , Array $args)
	{
		$k = md5( $path );
		$n = basename( $path,'.php');
		$n = str_replace(' ','',ucwords( str_replace('_',' ',$n) ));
		if(!self::$container[ $k ])
		{
			include_once( $path );
			self::$container[$k] = $n;
			$m 					 = 'on'.ucwords($method);
			if( method_exists(self::$container[$k],$m) )
			{
				#echo self::$container[$k].$m."<br/>";
				call_user_func_array(array(self::$container[$k],$m),$args);
			}
		}
		return self::$container[$k];
	}
	/**
	 * sort & invoke
	 *
	 * @param unknown_type $paths
	 * @param unknown_type $method
	 * @param array $args
	 * @param unknown_type $ordering
	 */
	function stepByStep( $paths , $method, Array $args ,$ordering = '')
	{
		if( !$paths ) return ; 
		foreach( $paths as $v)
		{
			$name = basename($v,'.php');
			$order[] = $ordering[ $name ];
		}

		array_multisort( (array)$order , SORT_ASC , $paths);
		
		foreach( $paths as $v)
		{
			$this->invoke( $v , $method , $args );
		}
	}
	
	function fetchHooks( $folder , $type ,$arguments )
	{
		if($folder == '') return;
		foreach(glob($folder.DS.'*.*') as $v)
		{

			$name = basename( $v,'.php');
			if( $name == 'ordering' ) 
			{
				include_once($v);
				continue;
			}
			$paths[] = $v;
			
		}
		$this->stepByStep( $paths , $type , $arguments , $hookOrdering);
	}
	
	function getPath( )
	{
		return parent::get('hookpath');
	}
	
	function loadHookView( $hook )
	{
		$file = self::getPath().DS.'view'.DS.$hook;
		
		if(file_exists( $file ))
		{
			include_once( $file );
		}
	}
}

?>
