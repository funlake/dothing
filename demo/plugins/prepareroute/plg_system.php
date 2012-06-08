<?php
/**
** A defualt plugin added by generator,so we call it system plugin.
** Do not remove this plugin file unless you know what to do.
**/
class DOPlgSystemPrepareroute extends DOPlugin
{
	public function Trigger($mca = null)
	{
		if(false !== ($cacheContent = $this->GetCache($mca)))
		{
			exit($cacheContent);
		}
		$request = DOFactory::GetTool('http.request');
		/** Strip slash since we using pdo **/
		if(get_magic_quotes_gpc())
		{
			/** Gpc strip slashes **/
			$_GET 		= DOStripslashes($_GET	  );
			$_POST  	= DOStripslashes($_POST	  );
			$_REQUEST   = DOStripslashes($_REQUEST);
			$_COOKIE  	= DOStripslashes($_COOKIE );
		}
		/** 
		** Content type for most of pages would be text/html 
		** So we treat it as a default content-type here.
		** If people want to orverride this,like goint to generate http download headers,
		** should do that with [beforeRequest] event in controller.
		**/
		$response = DOFactory::GetTool('http.response');
		$response->SetHeader("Content-type","text/html;charset=".DO_CHARSET);
	}

	public function GetCache($mca)
	{
		$cache 	= DOFactory::GetCache(); 
		if(!($cacheModule = $cache->Get('page_cache_'.$mca[0])))
		{
			$cacheModule = include APPBASE.DS.'cache'.DS.'cache.config.php';
			$cacheModule = serialize($cacheModule);
			$cache->Set('page_cache_'.$mca[0],$cacheModule,time()+3600);
		}
		$cacheModule = unserialize($cacheModule);
		/** Page need to be cache? **/
		if($cacheModule[$mca[0]][$mca[1].":".$mca[2]])
		{
			return $cache->GetPageCache($mca,'page');
		}
		return false;
	}
}
?>