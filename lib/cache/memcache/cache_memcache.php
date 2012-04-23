<?php 
/**Cache handler**/
DOLoader::Import('lib.cache.cache');
class DOCacheMemcache extends DOCache
{
	/** Instance of memcache class**/
	public static $MI;
	private static $keys = array();
	public function __construct()
	{
		/** User OO calling type that make things more readable **/
		self::$MI = new Memcached();
		/** 
		 * We can set different servers in different system 
		 * examples :
		 * ===============================================================
		 * define(DO_MEMSERVERS,'127.0.0.1,11211,50;192.11.22.33,11211,50');
		 *  
		 **/
		if(defined(DO_MEMSERVERS) && DO_MEMSERVERS)
		{
			foreach(explode(';',DO_MEMSERVERS) as $server)
			{
				call_user_func_array(array(self::$MI,"addServer"),explode(','));
			}
		}	
		else
		{
			/** Add a common server **/
			self::$MI->addServer('127.0.0.1',11211);
		}
	}
	/**
	 * @see DOCache::Set()
	 */
	public function Set($var,$content = '')
	{
		/**
		 * Convert it to array,so we can call setMulti later,
		 * it can make codes consistently,we dont need too much ugly if..else.. statements.
		 *
		 **/
		if(is_string($var))
		{
			$var 	= array($var=>$content);
		}
		$sets = array();
		foreach(array_keys($var) as $key)
		{
			$okey 	  = $key;
			if(strpos($key,'.') === false)
			{
				$key .= ".system";
			}
			$sets[$key] 		= $var[$okey];
		}
	 	return self::$MI->setMulti($sets,0);
	}
	/**
	 * @see DOCache::Get()
	 */
	public function Get($var)
	{
		/** Prepare for what datatype we return later **/
		$single 	= 0;
		/** 
		 * Convert it to array,so we can call setMulti later,
		 * it can make codes consistently,we dont need too much ugly if..else.. statements.
		 *
		 **/
		if(is_string($var))
		{			
			$single	= 1;
			$var = array($var);
		}
		$keys = array();
		foreach($var as $key)
		{
			if(strpos($key,'.') === false)
			{
				$key .= ".system";
			}
			$keys[] = $key;
		}
		$rs = self::$MI->getMulti($keys);
		/** Keep return value simple as what user thought **/
		if($single)
		{
			return $rs[$keys[0]];
		}
		else return $rs;
	}
	
	public function Delete($var,$timeout = 0)
	{
		self::$MI->delete($var,$timeout);
	}
	
	public function Clean($type =  null)
	{
		 self::$MI->flush();
	}
	
	public function GC()
	{
		
	}
	
	/** All extra method call should redirect to memcached object **/
	public function __call($name,$args)
	{
		return call_user_func_array(array(self::$MI,$name), $args);
	}
}
?>