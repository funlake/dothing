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
	 * getter
	 *
	 * @return initObj
	 */
	function & get( $tool ,$params = array() )
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
	}
	/**
	 * Create Single Table Handler 
	 *
	 * @param String $table
	 * @param String $key
	 * @return object
	 */
	function &_createTable( $table , $key = '' , $db= '')
	{
		static $tables = array();
		if(!class_exists('DODatabase') || !class_exists('DOTable') )
		{
			DOLoader::import('lib.database.database');
			DOLoader::import('lib.database.table');
		}
		if( !is_object(self::$_load['tables'][$table] ) )
		{
			self::$_load['tables'][$table]  = new DOTable( $table,$key,$db);
		}
		return self::$_load['tables'][$table] ;
	}

	function &_createPage( )
	{
		$params = func_get_args();
		if(!class_exists('DOPaginateWS'))
		{
			DOLoader::import('lib.paginate.workshop');
		}
		self::$_load['page'] = new DOPaginateWS( $params[0] );
		@array_shift( $params );
		return self::$_load['page']->GetEngine( $params );
	}
	/**
	 * Create Database interface
	 *
	 * @return object
	 */
	function &_createDBO( )
	{
		if(!class_exists('DODatabaseWS'))
		{
			DOLoader::import('lib.database.workshop');
		}
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
	function &_createSession( )
	{
		if(!class_exists('DOSession'))
		{
			DOLoader::import('lib.session.session');
		}
		$params = func_get_args();
		self::$_load['session'] = new DOSession( $params[0] );
		return self::$_load['session']->getEngine();
	}
	/**
	 * microtime
	 *
	 * @return unknown
	 */
	function &_createTime()
	{
		$time = explode(' ',microtime() );
		
		return $time[0] + $time[1];
	}
	/**
	 * create class
	 *
	 * @return unknown
	 */
	function &_createClass( )
	{
		static $classes = array();
		$args 			= func_get_args();
		$class          = $args[0];
		if( ! $classes[$class]  )
		{
			DOLoader::load_class($class);
			@array_shift( $args );
			$class           = 'DO'.ucwords($class);
			$classes[$class] = new $class( $args );
		}
		return $classes[$class];
	}
	/**
	 * create component classes interface
	 *
	 * @return unknown
	 */
	function &_createCom()
	{
		static $com = array();
		$args 			= func_get_args();
		$class          = $args[0];
		if( ! $com[$class]  )
		{
			$cn 		= explode('_',$class,2);
			if(!$cn[1]) $cn[1] = $cn[0];
			DOLoader::import('lib.'.$cn[0].'.'.$cn[1] );
			@array_shift( $args );
			$component 	= 'DO'.ucwords($cn[1]);
			$ref		= new ReflectionClass( $component );
			$com[$class] 	= call_user_func(array($ref,'newInstanceArgs'),$args);
		}
		return $com[$class];
	}
	
	function &_createExtjs()
	{
		static $ext = array();
		$args 			= func_get_args();
		$class          = $args[0];
		if( ! $ext[$class]  )
		{
			$cn 		= explode('_',$class,2);
			if(!$cn[1]) $cn[1] = $cn[0];
			DOLoader::import('include.extjs.'.$cn[1]);
			@array_shift( $args );
			$component 	= 'DOExt'.ucwords($cn[1]);
			$ext[$class] = new $component( $args );
		}
		return $ext[$class];
	}
}
?>
