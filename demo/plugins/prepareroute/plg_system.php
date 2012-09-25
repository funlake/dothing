<?php
/**
** A defualt plugin added by generator,so we call it system plugin.
** Do not remove this plugin file unless you know what to do.
**/
class DOPlgSystemPrepareroute extends DOPlugin
{
	public function Trigger($mca = null)
	{	
		$cache = DOFactory::GetCache();
		if(false !== ($cacheContent = $cache->GetPageCache($mca)))
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
		** If people want to orverride this,like going to generate http download headers,
		** should do that by [beforeRequest] event with controller.
		**/
		$response = DOFactory::GetTool('http.response');
		$response->SetHeader("Content-type","text/html;charset=".DO_CHARSET);
		/** Template Set **/
		if(DORouter::GetModule() == 'admin')
		{
			DOTemplate::SetTemplate(DO_ADMIN_TEMPLATE);
		}
		/** Search handler **/
		$this->SearchPrepare($mca);
	}

	public function SearchPrepare($mca)
	{
		//params were useless here
		if(isset($_POST['DO']['search']))
		{
			array_pop($mca);
			$mca['params'] = null;
			$session = DOFactory::GetSession();
			$pagekey = "DOSearch.".implode('/',$mca);
			$pagekey = rtrim($pagekey,"/");
			if(!empty($_POST['DO']['search']))
			{
				$session->Set($pagekey,$_POST['DO']['search']);
			}
			else
			{
				$session->Clean($pagekey,$_POST['DO']['search']);
			}
		}
	}
}
?>