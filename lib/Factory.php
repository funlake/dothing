<?php
namespace Dothing\Lib;
/**
 * Classes Factory 
 * @author lake
 *
 */
use \Dothing\Lib\Loader as Loader;
class Factory
{
	
	public static $crateEveryTime = array('time'=>true);
	
	public static $_load = array();
	
	/**
	 * Create Single Table Handler 
	 *
	 * @param String $table
	 * @param String $key
	 * @return object
	 */
	public static function GetTable( $table , $key = '' , $db= '')
	{
		Loader::Import('lib.database.database');
		Loader::Import('lib.database.table');
		$table = preg_replace('~^#__~i', DO_TABLEPRE, $table);
		if( !isset(self::$_load['tables'][$table] ) )
		{
			if(Loader::Import('lib.database.tables.'.DO_DBDRIVE.'_table'))
			{
				$class = 'DO'.ucwords(DO_DBDRIVE).'Table';
				self::$_load['tables'][$table]  = new $class( $table,$key,$db);
			}
		}
		return self::$_load['tables'][$table] ;
	}
	public static function GetWidget($widget,$type)
	{
		$params = func_get_args();
		if(!isset(self::$_load["widget_".$widget]))
		{
			$file = SYSTEM_ROOT.DS.'widgets'.DS.$widget.DS.$type.".php";
			if(file_exists($file))
			{
				include $file;
			}
			else
			{
				include FRAMEWORK_ROOT.DS.'widgets'.DS.$widget.DS.$type.".php";
			}
			self::$_load["widget_".$widget] = true;
		}
		$wigClass = "DOWidget".ucwords(strtolower($widget)).ucwords(strtolower($type));
		return call_user_func_array(
				array(new \ReflectionClass( $wigClass ),'newInstance'),  array_slice($params, 2)
		);

	}
	/**
	 * Get model
	 * @param string $table
	 */
	public static function GetModel($table)
	{
		$table = preg_replace('~^#__~i', DO_TABLEPRE, $table);
		if(!isset(self::$_load['models'][$table]))
		{
			// if(!file_exists(MODELBASE.DS.$table.'.php'))
			// {
			// 	throw new DOException("Unkonw model:".$table, 121);
			// 	return false;
			// } 
			// include_once MODELBASE.DS.$table.'.php';
			$modelClass = '\Application\Models\\'.$table;
			self::$_load['models'][$table] = new $modelClass();
		}
		return self::$_load['models'][$table];
	}
	/**
	***Get pagenate handler
	***/
	public static function GetPaginate( )
	{
		$params = func_get_args();
		Loader::Import('lib.paginate.workshop');
		if(!self::$_load['page'])
		{
			self::$_load['page'] = new DOPaginateWS( $params[0] );
		}
		@array_shift( $params );
		return self::$_load['page']->GetEngine( $params );
	}
	/**
	 * Create Database interface
	 *
	 * @return object
	 */
	public static function GetDatabase($driver = null)
	{
		//Loader::Import('lib.database.workshop');
		if(!$driver)
		{
			$driver = DO_DBDRIVE;
		}
		$params = func_get_args();
		/**Get rid off driver **/
		array_shift($params);
		//init 
		$key = 'pdo'.serialize( $params );
		if(!isset(self::$_load[$key]))
		{
			self::$_load[$key] = new \Dothing\Lib\Database\Workshop( $driver ,$params);
		}
		return self::$_load[$key]->GetEngine();
	}
	
	 /**
	 * Create Database interface
	 *
	 * @return object
	 */
	public static function GetSession( )
	{
		Loader::Import('lib.session.workshop');
		if(!isset(self::$_load['session']))
		{
			self::$_load['session'] = new \Dothing\Lib\Session\Workshop();
		}
		return self::$_load['session']->GetEngine();
	}
	/**
	 * Get php mailer
	 * @return mailer Object
	 */
	public static function GetMailer()
	{
		return self::GetTool('phpmailer');
	}
	/**
	 * Get cache handler
	 */
	public static function GetCache()
	{
		Loader::Import('lib.cache.workshop');
		if(!isset(self::$_load['cache']))
		{
			self::$_load['cache'] = new \Dothing\Lib\Cache\Workshop();
		}
		return self::$_load['cache']->GetEngine();
	}

	public static function GetJson()
	{
		if(!self::$_load['json'])
		{
			self::$_load['json'] = new \Dothing\Lib\Json();
		}
		return self::$_load['json'];		
	}
	/**
	 * microtime
	 *
	 * @return unknown
	 */
	public static function GetTime()
	{
		$time = explode(' ',microtime() );
		
		return (float)($time[0] + $time[1]);
	}
	/**
	 * Get http request filter
	 */
	public static function GetFilter()
	{
		if(!isset(self::$_load['filter']))
		{
			self::$_load['filter'] = new \Dothing\Lib\Filter();
		}
		return self::$_load['filter'];
	}

	public static function GetFileHandler()
	{
		if(!isset(self::$_load['filehd']))
		{
			self::$_load['filehd'] = new \Dothing\Lib\File\Basic();
		}
		return self::$_load['filehd'];		
	}
	/**
	 * create component classes interface
	 *
	 * @return unknown
	 */
	public static function GetTool()
	{
		static $tools = array();
		$args 			= func_get_args();
		$class          = $args[0];
		$tools[$class]  = false;
		if( ! $tools[$class]  )
		{
			$cn 		= explode('.',$class,2);
			if(!isset($cn[1])) $cn[1] = $cn[0];
			\Dothing\Lib\Loader::Import('lib.'.$cn[0].'.'.$cn[1] );
			@array_shift( $args );
			$component 		= 'DO'.ucwords($cn[0]).ucwords($cn[1]);
			if(!class_exists($component))
			{
				$component = 'DO'.ucwords($cn[1]);
			}
 			/** Create instace with arguments **/
			$tools[$class] 	= call_user_func_array(
					array(new \ReflectionClass( $component ),'newInstance')
				   ,$args
			); 
		}
		return $tools[$class];
	}
}
?>
