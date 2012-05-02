<?php
/**
 * Classes Factory 
 *
 */
class DOFactory
{
	
	public static $crateEveryTime = array('time'=>true);
	
	public static $_load = array();
	
	/**
	 * 
	 *
	 * @return initObj
	 */
/* 	public function & Get( $tool ,$params = array() )
	{
		static $tools;
		
		$p 	  = $tool;
		//if get classes..
		if( $params[0] ) 
		{
			$p .= $params[0];
		}
		if(!isset( $tools[$p] ) || self::$crateEveryTime[$tool] )
		{
			$t 			= ucfirst( $tool );
			$tools[$p] 		= & call_user_func_array(array(__CLASS__,"_create{$t}"),$params);
		}
		return $tools[$p];
	} */
	/**
	 * Create Single Table Handler 
	 *
	 * @param String $table
	 * @param String $key
	 * @return object
	 */
	function GetTable( $table , $key = '' , $db= '')
	{
		DOLoader::Import('lib.database.database');
		DOLoader::Import('lib.database.table');
		$table = preg_replace('~^#__~i', DO_TABLEPRE, $table);
		if( !is_object(self::$_load['tables'][$table] ) )
		{
			self::$_load['tables'][$table]  = new DOTable( $table,$key,$db);
		}
		return self::$_load['tables'][$table] ;
	}
	/**
	 * Get model
	 * @param string $table
	 */
	public function GetModel($table)
	{
		static $modelLoaded = false;
		if(!$modelLoaded)
		{
			DOLoader::Import('mvc.model');
			$modelLoaded = true;
		}
		$table = preg_replace('~^#__~i', DO_TABLEPRE, $table);
		//echo $table;
		if(!self::$_load['models'][$table])
		{
			if(!file_exists(MODELBASE.DS.$table.'.php')) return false;
			include MODELBASE.DS.$table.'.php';
			$modelClass = 'DOModel'.ucwords(strtolower($table));
			self::$_load['models'][$table] = new $modelClass();
		}
		return self::$_load['models'][$table];
	}
	/**
	***Get pagenate handler
	***/
	function GetPaginate( )
	{
		$params = func_get_args();
		DOLoader::Import('lib.paginate.workshop');
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
	function GetDatabase($driver = null)
	{
		DOLoader::Import('lib.database.workshop');
		if(!$driver)
		{
			$driver = DO_DBDRIVE;
		}
		$params = func_get_args();
		/**Get rid off driver **/
		array_shift($params);
		//init 
		$key = 'pdo'.serialize( $params );
		if(!self::$_load[$key])
		{
			self::$_load[$key] = new DODatabaseWS( $driver ,$params);
		}
		return self::$_load[$key]->GetEngine();
	}
	
	 /**
	 * Create Database interface
	 *
	 * @return object
	 */
	function GetSession( )
	{
		DOLoader::Import('lib.session.workshop');
		if(!self::$_load['session'])
		{
			self::$_load['session'] = new DOSessionWS();
		}
		return self::$_load['session']->GetEngine();
	}
	
	/**
	 * Get php mailer
	 * @return mailer Object
	 */
	function GetMailer()
	{
		return self::GetTool('phpmailer');
	}
	/**
	 * Get cache handler
	 */
	function GetCache()
	{
		DOLoader::Import('lib.cache.workshop');
		if(!self::$_load['cache'])
		{
			self::$_load['cache'] = new DOCacheWS();
		}
		return self::$_load['cache']->GetEngine();
	}
	/**
	 * microtime
	 *
	 * @return unknown
	 */
	function GetTime()
	{
		$time = explode(' ',microtime() );
		
		return $time[0] + $time[1];
	}
	/**
	 * Get http request filter
	 */
	public function GetFilter()
	{
		if(!self::$_load['filter'])
		{
			DOLoader::Import('lib.dothing.filter');
			self::$_load['filter'] = new DOFilter();
		}
		return self::$_load['filter'];
	}
	/**
	 * create component classes interface
	 *
	 * @return unknown
	 */
	function GetTool()
	{
		static $tools = array();
		$args 			= func_get_args();
		$class          = $args[0];
		if( ! $tools[$class]  )
		{
			$cn 		= explode('.',$class,2);
			if(!$cn[1]) $cn[1] = $cn[0];
			DOLoader::Import('lib.'.$cn[0].'.'.$cn[1] );
			@array_shift( $args );
			$component 		= 'DO'.ucwords($cn[1]);
			/** Create instace with arguments **/
			$tools[$class] 	= call_user_func(
					array(new ReflectionClass( $component ),'newInstance')
				   ,$args
			);
		}
		return $tools[$class];
	}
	
/* 	function GetExtjs()
	{
		static $ext = array();
		$args 			= func_get_args();
		$class          = $args[0];
		if( ! $ext[$class]  )
		{
			$cn 		= explode('_',$class,2);
			if(!$cn[1]) $cn[1] = $cn[0];
			DOLoader::Import('include.extjs.'.$cn[1]);
			@array_shift( $args );
			$component 	= 'DOExt'.ucwords($cn[1]);
			$ext[$class] = new $component( $args );
		}
		return $ext[$class];
	} */
}
?>
