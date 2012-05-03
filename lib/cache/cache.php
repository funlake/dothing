<?php
define('DOCACHE_ERROR_NOTSET',null);
/**
*
*Curd cache class
*/
class DOCache
{
	#create cache
	public function Create($hashkey){}
	#update cache
	public function Set($hashkey,$content){}
	#read cache
	public function Get($hashkey){}
	#delete cache
	public function Delete($hashkey){}
	public function GetTime($object){}
	public function SetTime($time){}
	public function IfExpire($object){}
	public function GetCache($type)
	{
		return $this->Get($name.".".$type);
	}
	public function Save( $type ){}
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
