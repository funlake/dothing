<?php
namespace Dothing\Lib;
use \Dothing\Lib\Uri;
use \Dothing\Lib\Hook;
use \Dothing\Lib\Template;
use \Dothing\Lib\Factory;
use \Dothing\Lib\Profiler;
class Router
{
	static $sep 		= ':';
	static $maps 		= array();
	static $proj		= '';
	static $module      = '';
	static $controller  = '';
	static $action      = '';
	static $params      = '';
	static $format      = array();
	static $mvcHash 	= array(
		 ':module'		=>'#[a-z]+#i'	
		,':controller'	=>'#[a-z]+#i'
		,':action'		=>'#[a-z]+#i'	
	);
	static $mom = array();
	static $queryPath      = array();
	/**Contents of specific controller**/
	static $content      = null;
	
	public static function Dispatch(array $mca = null)
	{
		self::Prepare();
		#self::hasMap(Uri::GetPathInfo());
		/** Trigger plugin before all module route**/
		Hook::HangPlugin('prepareRoute',array(self::GetMca()));
		if( ! ($CTR = \Dothing\Lib\Controller::GetController()) )
		{
			throw new \Dothing\Lib\Exception("Unknown page://detail:".Uri::GetPageIndex(), 404);
		}
		//Whether controller class exist
		$method = self::$action.'Action';

		//Action exist
		if( method_exists($CTR,$method) )
		{
 			Hook::TriggerEvent(
				array(
				    'beforeRequest' => array(self::GetMca())
				)
			);
			Profiler::MarkStartTime("Controller:".self::GetPageIndex());
			/** Set some constants for template usage**/
			Template::SetTemplateUriPath(Template::GetTemplate());
			/** No cache then update cache **/
			if(!Template::GetModule() )
			{
				ob_start();
				$cache = Factory::GetCache();
				if(false !== ($cacheContent = $cache->GetControllerCache($mca)))
				{
					echo $cacheContent;
				}
				else
				{
					$CTR->$method((object)array(
						'get'		=> self::$params
					   ,'post'  	=> $_POST
					   ,'cookie'	=> $_COOKIE
					   ,'session'	=> $_SESSION
					));
				}
				Template::SetModule(ob_get_clean());
			}
			Profiler::MarkEndTime("Controller:".self::GetPageIndex(),__FILE__);
 			Hook::TriggerEvent(
				array(
				    'afterRequest' => array(self::GetMca(),Template::GetModule())
				)
			);
		}
		else 
		{
			throw new \Dothing\Lib\Exception("Unknown page://detail:".Uri::GetPageIndex(), 404);
		}
		Hook::HangPlugin('afterRoute',array(self::GetMca()));
	}

	public static function Map()
	{
		$args   = func_get_args();
		$regexp = @$args[0];
		$target = @$args[1];
		//$format = @$args[2];
		if(!$regexp || !$target) 
		{
			
		}
		else 
		{
			//$pathInfo   = $this->uri->getPathInfo();
			self::$maps[$regexp] 	= $target;
			self::$format[$target]  	= $regexp;
		}
	}
	public static function FormatSeoLink($link,$params)
	{	
		if(!array_key_exists($link, self::$format))
		{
			return null;
		}
		else
		{
			$query = array();
			if(is_array($params))
			{
				$query = $params;
			}
			else if(!empty($params))
			{
				parse_str($params,$query);
			}
			return preg_replace_callback("#:([^/\-\|]+)#",function($match) use($query){
				return array_key_exists($match[1], $query) ? $query[$match[1]]  : '';
			},self::$format[$link]);
		}
	}
	public static function ModuleMap($original,$target)
	{
		self::$mom['positive'][$original] 	= $target;
		self::$mom['negative'][$target]		= $original;
	}
	/**
	 * Maybe we has customize route?
	 *
	 * @param unknown_type $pathinfo
	 */
	public static function Prepare(array $mca = null)
	{
		$pathinfo			= Uri::GetPathInfo();

		self::$module	  	= Uri::GetModule();
		self::$controller 	= Uri::GetController();
		self::$action     	= Uri::GetAction();
		self::$params	 	= Uri::GetParams();
		
		//Wanna hide the admin interface?
		// if(DO_ADMIN_INTERFACE)
		// {
		// 	if(DO_ADMIN_INTERFACE == self::$module)
		// 	{
		// 		self::$module   = 'admin';
		// 	}
		// 	elseif("admin" == self::$module)
		// 	{
		// 		throw new DORouterException("Page Not Found!", 404);
		// 	}
		// }

		if(DO_SEO and file_exists(SYSTEM_ROOT.'/router.php'))
		{
			include SYSTEM_ROOT.'/router.php';
			if(array_key_exists(self::$module, self::$mom['negative']))
			{
				self::$module = self::$mom['negative'][self::$module];
			}
			foreach((array)self::$maps as $k=>$v)
			{
				$rule = preg_replace(
						array('#:([^/\-\|]+)#'
						     ,'#(?<!\.)\*#'
						     ,'#`#'
				                )
						,array('(?P<\1>[^/\-\|]+)'
							  ,'(.*)'
							  ,'\`'
						),$k);
				//echo $rule;exit;
				$matches = array();
				if(preg_match('`^'.$rule.'$`',$pathinfo,$matches))
				{
					//print_r($matches);
					//self::$proj 		= $v['P'];
					// self::$module  		= $v['M'];
					// self::$controller   = $v['C'];
					// self::$action  		= $v['A'];
					list(self::$module,self::$controller,self::$action) = explode("/",$v);
					//echo self::$module."/".self::$controller."/".self::$action;exit;
					@array_shift($matches);
					
					//set $_GET params
					foreach( $matches as $mk=>$mv)
					{
						if(!!$ignoreNextLoop) {$ignoreNextLoop = false ; continue;}
						//match mvc string in url
						if(self::$mvcHash[':'.$mk])
						{
							self::${$mk} 	= $mv; 
							$ignoreNextLoop = true;
						}
						//params format
						if(null != ($kf = self::$format[$k][$mk]))
						{
							$mv = sprintf($kf,$mv);
						}
						//set $_GET
						if(!is_numeric($mk))
						{
							//Uri::SetParams($mk,$mv);
							//self::$params[$mk] = $mv;
							$pas[$mk] = $mv;
 						}
 						//else $pas[] = $mv;
					}
					if(preg_match('#'.preg_quote('(.*)').'$#',$rule))
					{
						self::$params = explode('/',$pas[0]);
					}
					else  
					{
						self::$params       =  $pas;
					}
					break;
				}
			}
			if( isset(self::$maps[$pathinfo.'/*']) and $myroute = self::$maps[$pathinfo.'/*'])
			{
				list(self::$module,self::$controller,self::$action) = explode("/",$v);
			}
			if(isset($v))
			{
				self::$queryPath[serialize(
					array(
						self::$proj,self::$module,self::$controller,self::$action,self::$params
					)
				)] = $v;
			}
		}
	}
	
	public static function GetPageIndex()
	{
		return Router::$module.'/'.self::$controller.'/'.self::$action;
	}

	public static function GetSearchIndex()
	{
		return "DOSearch/".self::GetPageIndex();
	}
	public static function GetLimitIndex()
	{
		return "DOLimit/".self::GetPageIndex();
	}
	public static function GetMca()
	{
		return array(self::$module,self::$controller,self::$action,self::$params);
	}

	public static function GetModule()
	{
		return self::$module;
	}

	public static function GetController()
	{
		return self::$controller;
	}

	public static function GetAction()
	{
		return self::$action;
	}

	public static function GetParams()
	{
		return self::$params;
	}
}
?>
