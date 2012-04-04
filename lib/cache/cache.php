<?php
/**
*
*Curd cache class
*/
interface DOCache_interface  
{
	#create cache 
	public function create($hashkey);
	#update cache
	public function update($hashkey,$content,$expire);
	#read cache
	public function read($hashkey) ;
	#delete cache
	public function delete($hashkey);
}

class DOCache
{
	public function getTime($object){}
	public function setTime($object,$time){}
	public function ifExpire($object){}
	public function getCache( $type,$name){}
	public function save( $type , $name){}
}
DOLoader::import('lib.file.file');
class DOCache_file_entity
{
	private $obj;
	public function __construct( $obj )
	{
		$this->obj = (array)$obj;
	}
	public function update( $var , $content , $expire)
	{
		$this->obj[$var]->content = $content;
		$this->obj[$var]->expire  = $expire;	
	}
	public function read( $var = '' )
	{
		return !empty($var) ? $this->obj[$var]->content : $this->obj;
	}
	public function delete( $var )
	{
		$this->obj[$var] = null;
	}
	public function get()
	{
		return $this->obj;
	}
}
class DOCache_file extends DOCache implements DOCache_interface
{
	private static $entity;
	/**
	*get cache operation class
	*/
	public function getCache( $type , $name)
	{
		$ck = $type."_".$name;
		if(!self::$entity[$ck])
		{
			$file = CACHE_ROOT.DS.$type.DS.$name.".cache";
			if(!file_exists( $file) )
			{
				self::create($file);
				throw new Exception("[{$type}.".DS."{$name}]Cache file has been builded.");
			}
			$vars = file_get_contents( $file );
			if(!empty( $vars )) $obj  = json_decode( $vars );
			else $obj = array();
			self::$entity[$ck] = new DOCache_file_entity($obj);	
		}
		return self::$entity[$ck];
	}
	/**
	*save cache file
	*/
	public function save( $type , $name)
	{
		$file = CACHE_ROOT.DS.$type.DS.$name.".cache";
		file_put_contents($file,json_encode(self::$entity[$type."_".$name]->obj));
	}
	/**
	* Hashkey here should be a string formated like:
	*============================================
	* module.$module_name
	*============================================
	*/
	public function create( $file )
	{
		if(file_exists( $file )) return;
		DOFile::makeFile( $file ,0777);	
	}
	
	/**
	* Hashkey here should be a string formated like:
	*============================================
	* module.$module_name.$var_name
	*============================================
	*/
	public function update( $hashkey , $content , $expire)
	{
		list($type,$name,$var) = sscanf($hashkey,"%[^.].%[^.].%s");
		return self::getCache($type,$name)->update($var,$content,$expire);
		#DOEvent::trigger('onDestry',)
	}
	/**
	* Hashkey here should be a string formated like:
	*============================================
	* module.$module_name.$var_name
	*============================================
	*/
	public function read( $hashkey = '' )
	{
		list($type,$name,$var) = explode('.',$hashkey);
		return self::getCache($type,$name)->read( $var );
		#DOEvent::trigger('onDestry',)
	}
	/**
	* Hashkey here should be a string formated like:
	*============================================
	* module.$module_name.$var_name
	*============================================
	*/
	public function delete( $hashkey)
	{
		list($type,$name,$var) = split('.',$hashkey);
		
		return !empty($var) ? self::getCache($type,$name)->delete($var) : self::clear($type,$name);
		#DOEvent::trigger('onDestry',)
	}
	/**
	*remove a cache file
	*/
	public function clear( $type,$name)
	{
		$file = CACHE_ROOT.DS.$type.DS.$name.".cache";
		return @unlink($file);
	}
	public function getTime( $file )
	{
		return fileatime( $file );
	}

	public function setTime( $file){}

	public function ifExpire( $hashkey )
	{
		list($type,$name,$var) = split('.',$hashkey);
		if( !empty($var) )
		{
			return self::getCache($type,$name)
			       	->read($var)
				->expire < time();
		}
		else
		{
			$file = $type.DS.$name;
			return getTime( $file ) < time();
		}
	}
}
/*
class DOCache extends DOBase
{
	public function write( $content )
	{#error_reporting(E_ALL);ini_set('display_errors',true);
		$isAdmin 	= parent::get('backend');
		$uri	 	= & DOFactory::get('com',array('uri'));
		$cachePath	= CACHE_ROOT.DS.($isAdmin ? $isAdmin.DS : '');	
		$params 	= strtr(http_build_query( $uri->params ),'=&','__');
		$realPath       = $cachePath.implode('_',array($uri->getModule(),$uri->getController(),$uri->getAction(),$params));
		file_put_contents( $realPath.".html",$content);
	}

	public function read()
	{
		
	}

	public function delete()
	{
		
	}


	public function clean()
	{
	
	}
}*/

?>
