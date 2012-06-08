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
	public function Set($hashkey,$content,$expire){}
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
	public function SetTplCache($mca,$content,$dir = '.')
	{
		$mca[3] 	= str_replace('&amp;','&',http_build_query($mca[3]));
		$pageName 	= implode("_",$mca);  
		$cachePath  = CACHEROOT.DS.$dir.DS.$pageName.'.html';
		$fp = fopen($cachePath,'w+');
		fwrite($fp,$content);
		fclose($fp);
	}

	public function GetTplCache($mca,$dir='.')
	{
		$mca[3] 	= str_replace('&amp;','&',http_build_query($mca[3]));
		$pageName 	= implode("_",$mca); 
		$cachePath  = CACHEROOT.DS.$dir.DS.$pageName.'.html';
		if(file_exists($cachePath))
		{
			ob_start();
			include $cachePath;
			return ob_get_clean();
		}
		return false;
	}

	public function SetControllerCache($mca,$content)
	{
		$cacheModule = $this->GetPageCacheConfig($mca);
		/** Controller need to be cache? **/
		if(isset($cacheModule[$mca[0]][$mca[1].":".$mca[2]]))
		{
			return $this->SetTplCache($mca,$content,'controller') ;
		}
		return false;
	}

	public function GetControllerCache($mca)
	{		
		$cacheModule = $this->GetPageCacheConfig($mca);
		/** Controller need to be cache? **/
		if(isset($cacheModule[$mca[0]][$mca[1].":".$mca[2]]))
		{
			return $this-> GetTplCache($mca,'controller') ;
		}
		return false;
	}

	public function SetPageCache($mca,$content)
	{
		$cacheModule = $this->GetPageCacheConfig($mca);
		/** Page need to be cache? **/
		if($cacheModule[$mca[0]][$mca[1].":".$mca[2]])
		{
			return $this->SetTplCache($mca,$content,'page') ;
		}
		return false;
	}

	public function GetPageCache($mca)
	{
		$cacheModule = $this->GetPageCacheConfig($mca);
		/** Page need to be cache? **/
		if($cacheModule[$mca[0]][$mca[1].":".$mca[2]])
		{
			return $this->GetTplCache($mca,'page') ;
		}	
		return '';
	}
	public function GetPageCacheConfig($mca)
	{
		static $cacheModule = null;
		if(!$cacheModule)
		{
			$cacheModule = include APPBASE.DS.'cache'.DS.'cache.config.php';
		}
		return $cacheModule;
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
