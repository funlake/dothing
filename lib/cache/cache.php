<?php
define('DOCACHE_NOTSET'		 , null);
define('DOCACHE_EXPIRED'	 , null);
/**
*
*Curd cache class
*/
class DOCache
{
	#create cache
	public function Create($hashkey){}
	#update cache
	public function Set($hashkey,$content,$expire=0){}
	#read cache
	public function Get($hashkey=''){}
	#delete cache
	public function Delete($hashkey){}
	public function GetTime($object){}
	public function SetTime($time){}
	public function IfExpire($object='system'){}
	public function GetCache($type)
	{
		return $this->Get($name.".".$type);
	}
	public function SetTplCache($mca,$content,$dir = '.')
	{
		$mca[3] 	= str_replace('&amp;','&',http_build_query($mca[3]));
		$pageName 	= implode("_",$mca);  
		$cachePath  = CACHEROOT.DS.$dir.DS.$pageName.'.html';
		if(!file_exists($cachePath))
		{
			$fp = fopen($cachePath,'w+');
			fwrite($fp,$content);
			fclose($fp);
		}

		//$this->Set('page.'.$pageName,$content);
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
		return $this->MvcSetCache($mca,$content,'controller');
	}

	public function GetControllerCache($mca)
	{		
		return $this->MvcGetCache($mca,'controller');
	}

	public function SetPageCache($mca,$content)
	{
		return $this->MvcSetCache($mca,$content,'page');
	}

	public function GetPageCache($mca)
	{
		return $this->MvcGetCache($mca,'page');
	}

	public function MvcSetCache($mca,$content,$type = 'page')
	{
		$cacheModule = $this->GetMvcCacheConfig($mca);
		$ifCache	 = false;
		switch($type)
		{
			case 'page':
				/** Page need to be cache? **/
				$ifCache = $cacheModule[$mca[0]][$mca[1].":".$mca[2]];
			break;

			case 'controller':
				/** controller need to be cache? **/
				$ifCache = (isset($cacheModule[$mca[0]][$mca[1].":".$mca[2]]) AND ($cacheModule[$mca[0]][$mca[1].":".$mca[2]] == false));

			break;
		}
		if($ifCache) return $this->SetTplCache($mca,$content,$type) ;
		return false;		
	}

	public function MvcGetCache($mca,$type = 'page')
	{
		$cacheModule = $this->GetMvcCacheConfig($mca);
		$ifCache	 = false;
		switch($type)
		{
			case 'page' :
				/** Find page cache file? **/
				if(isset($cacheModule[$mca[0]][$mca[1].":".$mca[2]]))
				{
					$ifCache = $cacheModule[$mca[0]][$mca[1].":".$mca[2]];
				}
			break;

			case 'controller':
				/** Find controller cache file? **/
				$ifCache = isset($cacheModule[$mca[0]][$mca[1].":".$mca[2]]);
			break;	
		}
		if($ifCache) return $this->GetTplCache($mca,$type) ;
		return false;		
	}
	public function GetMvcCacheConfig($mca)
	{
		static $cacheModule = null;
		if(!$cacheModule)
		{
			$cacheModule = @include APPBASE.DS.'cache'.DS.'cache.config.php';
		}
		return $cacheModule;
	}
	public function Save( $type ='system'){}
}
?>
