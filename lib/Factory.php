<?php
/**
 * factory 
 *
 */
class DOFactory extends DOBase
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
		static $tables = array();
		DOLoader::Import('lib.database.database');
		DOLoader::Import('lib.database.table');
		if( !is_object(self::$_load['tables'][$table] ) )
		{
			self::$_load['tables'][$table]  = new DOTable( $table,$key,$db);
		}
		return self::$_load['tables'][$table] ;
	}
	/**
	***Get pagenate handler
	***/
	function GetPaginate( )
	{
		$params = func_get_args();
		DOLoader::Import('lib.paginate.workshop');
		self::$_load['page'] = new DOPaginateWS( $params[0] );
		@array_shift( $params );
		return self::$_load['page']->GetEngine( $params );
	}
	/**
	 * Create Database interface
	 *
	 * @return object
	 */
	function GetDatabase( )
	{
		DOLoader::Import('lib.database.workshop');
		$params = func_get_args();
		//init 
		self::$_load['dbo'] = new DODatabaseWS( DO_DBDRIVE ,$params);
		return self::$_load['dbo']->GetEngine();
	}
	
	 /**
	 * Create Database interface
	 *
	 * @return object
	 */
	function GetSession( )
	{
		DOLoader::Import('lib.session.session');
		self::$_load['session'] = new DOSession();
		return self::$_load['session']->GetEngine();
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
			$component 	= 'DO'.ucwords($cn[1]);
			$ref		= new ReflectionClass( $component );
			$tools[$class] 	= call_user_func(array($ref,'newInstanceArgs'),$args);
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
