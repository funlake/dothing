<?php
/**
** A defualt plugin added by generator,so we call it system plugin.
** Do not remove this plugin file unless you know what to do.
**/
use \Dothing\Lib\Factory as Factory;
use \Dothing\Lib\Router as Router;
use \Dothing\Lib\Uri as Uri;
use \Dothing\Lib\Template;
class DOPlgSystemPrepareroute extends \Dothing\Lib\Plugin
{
	public function Trigger($params = array())
	{	
		$mca = $params[0];
		$cache = Factory::GetCache();
		//print_r($cache);
		if(false !== ($cacheContent = $cache->GetPageCache($mca)))
		{
			//Template::SetContent($cacheContent);
			exit($cacheContent);
		}
		else
		{
			$request = new \Dothing\Lib\Http\Request();
			/** Strip slash since we're using pdo **/
			if(get_magic_quotes_gpc())
			{
				/** Gpc strip slashes **/
				$_GET 	= DOStripslashes($_GET	  );
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
			$response = new \Dothing\Lib\Http\Response();
			$response->SetHeader("Content-type","text/html;charset=".DO_CHARSET);

			/** Template Set **/
			$this->TemplateLayoutUse();

			/** Search handler **/
			$this->ListPrepare($mca);

			/** Set some session variables **/
			$this->SetPageState();
		}
	}
	/** See what template/layout should current page use **/
	public function TemplateLayoutUse()
	{
		if(file_exists(TEMPLATE_ROOT.DS.'usage.php'))
		{
			$usage = include TEMPLATE_ROOT.DS.'usage.php';
			if($template = $usage['template'][Router::GetModule()])
			{
				Template::SetTemplate($template);
			}
			if(isset($usage['layout'][Router::GetPageIndex()]) and ($layout 	= $usage['layout'][Router::GetPageIndex()]) )
			{
				Template::SetLayout($layout);
			}
			else
			{
				$layouts = array_keys($usage['layout']);
				foreach($layouts as $lyt)
				{
					//small bug in php 5.3.1
					//echo $lyt;
					if(@preg_match($lyt,Router::GetPageIndex()))
					{
						Template::SetLayout($usage['layout'][$lyt]);
						break;
					}
				}
			}
			//echo 
		}
	}
	/** Prepare some session things for listing page**/
	public function ListPrepare($mca)
	{
		//If people searching somthing?
		$urlQuery 			= $mca;
		array_pop($urlQuery);
		$urlQuery['params'] = null;
		$pagekey 			= implode('/',$urlQuery);
		$pagekey 			= rtrim($pagekey,"/");
		$searchKey 			= "DOSearch/".$pagekey;
		//$limitKey   		= "DOLimit/".$mca['module'];
		if(isset($_REQUEST['DO']['search']))
		{
			if(!empty($_REQUEST['DO']['search']))
			{
				SS($searchKey,$_REQUEST['DO']['search']);
			}
			else
			{
				//Clean session
				SS($searchKey,null);
			}
		}
	}
	public function SetSortState()
	{
		
	}
	public function SetPageState()
	{
		/** paginate initialize **/
		if(defined('DO_PAGE_INDEX'))
		{
			$pageindex = DO_PAGE_INDEX;
		}
		else
		{
			$pageindex = "page";
		}
		$page   = Uri::GetModule()."/".Uri::GetController()."/".Uri::GetAction();
		$params = \Dothing\Lib\Request::Get();
		$session = Factory::GetSession();
		//if people search something,then page will rewind to 1.
		if(isset($_REQUEST['DO']['search']))
		{
			$session->Set($page."_p",1);
		}
		else 
		{
			if(!empty($params[$pageindex]))
			{
				$session->Set($page."_p",$params[$pageindex]);
			}
			else
			{
				if(!$session->Get($page."_p") )
				{
					$session->Set($page."_p",1);
				}
			}
		}

	}
}
?>