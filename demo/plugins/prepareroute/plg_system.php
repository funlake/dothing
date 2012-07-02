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
		** If people want to orverride this,like goint to generate http download headers,
		** should do that with [beforeRequest] event in controller.
		**/
		$response = DOFactory::GetTool('http.response');
		$response->SetHeader("Content-type","text/html;charset=".DO_CHARSET);
		$this->AdminProcess();
	}
	/** Do something when we go to admin page **/
	public function AdminProcess()
	{
		/** Hide admin interface ? **/
		if(DO_ADMIN_INTERFACE)
		{
			switch(DORouter::$module)
			{
				case  'admin':
					throw new DORouterException("Page Not Found!", 404);
				break;

				case DO_ADMIN_INTERFACE :
					DORouter::$module = 'admin';
				break;
			}
		}
		/** Set Template for admin interface **/
		if(DORouter::$module === 'admin')
		{
			DOTemplate::SetTemplate(DO_ADMIN_TEMPLATE);
		}		
	}
}
?>