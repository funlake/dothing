<?php
/**Cache handler**/
DOLoader::Import('lib.cache.cache');
/**File handler **/
DOLoader::Import('lib.file.file');
class DOCacheFileEntity
{
	public $obj;
	public function __construct( $obj )
	{
		$this->obj = (array)$obj;
	}
	public function Update( $var , $content)
	{
		$this->obj[$var]		  = new stdClass();
		$this->obj[$var]->content = $content;
	}
	public function Read( $var = '' )
	{
		if(!empty($var))
		{
			if(!$this->obj[$var])
			{
				/** Did not set **/
				trigger_error("Cache [$var] did not set",E_USER_WARNING);
				return DOCACHE_ERROR_NOTSET; 
			}
			return $this->obj[$var]->content;
		}
		return $this->obj;
	}
	public function Delete( $var )
	{
		$this->obj[$var] = null;
	}
	public function Get($var)
	{
		return $this->obj[$var];
	}
	public function Clean()
	{
		return $this->obj = null;
	}
}
class DOCacheFile extends DOCache
{
	private static $entity;
	private static $expire = 3600;
	/**
	*get cache operation class
	*/
	public function GetCache($type='system')
	{
		$ck = $type ? $type : 'system';
		if(!self::$entity[$ck])
		{
			$file = CACHEROOT.DS.$type.".cache";
			if(!file_exists( $file) )
			{
				self::Create($file);
			}
			$vars = file_get_contents( $file );
			if(!empty( $vars )) $obj  = json_decode( $vars );
			else $obj = array();
			self::$entity[$ck] = new DOCacheFileEntity($obj);	
		}
		return self::$entity[$ck];
	}
	/**
	*save cache file
	*/
	public function Save($type = 'system')
	{
		$file = CACHEROOT.DS.$type.".cache";
		$fp   = fopen($file,"w+");
		if(flock($fp,LOCK_EX))
		{
			fwrite($fp,json_encode(self::$entity[$type]->obj));
			flock($fp,LOCK_UN);
		}
		fclose($fp);
	}
	/**
	* Hashkey here should be a string formated like:
	*============================================
	* $varname.system/module/plugin/event...
	*============================================
	*/
	public function Create( $file )
	{
		DOFile::MakeFile( $file ,0777);	
	}
	
	/**
	* Hashkey here should be a string formated like:
	*============================================
	* $varname.system/module/plugin/event...
	*============================================
	*/
	public function Set( $hashkey , $content)
	{
		list($var,$type) 	= explode('.',$hashkey);
		$type				= !empty($type) ? $type : 'system';
		self::GetCache($type)->Update($var,$content);
		return self::Save($type);
		#DOEvent::trigger('onDestry',)
	}
	/**
	* Hashkey here should be a string formated like:
	*============================================
	* $varname.system/module/plugin/event...
	*============================================
	*/
	public function Get( $hashkey = '' )
	{
		list($var,$type) = explode('.',$hashkey);
		return self::GetCache($type)->Read( $var );
	}
	/**
	* Hashkey here should be a string formated like:
	*============================================
	* $varname.system/module/plugin/event...
	*============================================
	*/
	public function Delete( $hashkey )
	{
		list($var,$type) = explode('.',$hashkey);
		self::GetCache($type)->Delete($var);
		return self::Save($type);
	}
	/**
	*remove a cache file
	*/
	public function Clean( $type )
	{
		self::GetCache($type)->Clean();	
		return self::Save($type);
	}
	
	public function Destroy( $type )
	{
		$file = CACHEROOT.DS.$type.".cache";
		return @unlink($file);
	}
	public function GetTime( $file )
	{
		return fileatime( $file );
	}

	public function SetTime( $file){}

	public function IfExpire($type = 'system')
	{
		$file = CACHEROOT.DS.$type.".cache";
		return filemtime( $file ) + self::$expire > time();
	}
	
	public function GC($type = 'system')
	{
		if( mt_rand(1,1000) == 1)
		{
			return self::IfExpire(null,$type) && self::Destroy($type);
		}
	}
}
?>
