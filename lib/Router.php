<?php
class DORouter
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
	static $queryPath      = array();
	/**Contents of specific controller**/
	static $content      = null;
	
	public static function Dispatch(array $mca = null)
	{
		self::Prepare($mca);

		#self::hasMap(DOUri::GetPathInfo());
		/** Trigger plugin before all module route**/
		DOHook::HangPlugin('prepareRoute',array(self::GetMca()));
		
		if( ! ($CTR = DOController::GetController()) )
		{
			throw new DORouterException("Unknown controller::action", 404);
		}
		//Whether controller class exist
		$method = self::$action.'Action';
		//Action exist
		if( method_exists($CTR,$method) )
		{
 			DOHook::TriggerEvent(
				array(
				    'beforeRequest' => array(self::GetMca())
				)
			);
			/** Set some constants for template usage**/
			DOTemplate::SetTemplateUriPath(DOTemplate::GetTemplate());
			/** No cache then update cache **/
			if(!DOTemplate::GetModule() )
			{
				ob_start();
				call_user_func(array($CTR,$method),(object)array(
					'get'		=> self::$params
				   ,'post'  	=> $_POST
				   ,'cookie'	=> $_COOKIE
				   ,'session'	=> $_SESSION
				));
				DOTemplate::SetModule(ob_get_clean());
			}
 			DOHook::TriggerEvent(
				array(
				    'afterRequest' => array(self::GetMca(),DOTemplate::GetModule())
				)
			);
		}
		else 
		{
			throw new DORouterException("Unknown controller::action", 404);
		}
		DOHook::HangPlugin('afterRoute',array(self::GetMca()));
	}

	public static function Map()
	{
		$args   = func_get_args();
		$regexp = $args[0];
		$target = $args[1];
		$format = $args[2];
		if(!$regexp || !$target) 
		{
			
		}
		else 
		{
			//$pathInfo   = $this->uri->getPathInfo();
			self::$maps[$regexp] 	= $target;
			self::$format[$regexp]  = $format;
		}
	}
	/**
	 * Maybe we has customize route?
	 *
	 * @param unknown_type $pathinfo
	 */
	public static function Prepare(array $mca = null)
	{
		$pathinfo			= DOUri::GetPathInfo();
		if(!!$mca)
		{
			list(self::$module,self::$controller,self::$action,self::$params) = $mca;
		}
		else
		{
			self::$module	  	= DOUri::GetModule();
			self::$controller 	= DOUri::GetController();
			self::$action     	= DOUri::GetAction();
			self::$params	 	= DOUri::GetParams();
		}
		//Wanna hide the admin interface?
		if(DO_ADMIN_INTERFACE)
		{
			if(DO_ADMIN_INTERFACE == self::$module)
			{
				self::$module   = 'admin';
			}
			elseif("admin" == self::$module)
			{
				throw new DORouterException("Page Not Found!", 404);
			}
		}
		if(DO_SEO)
		{
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
				//echo $rule."<br/>";
				$matches = array();
				if(preg_match('`^'.$rule.'$`',$pathinfo,$matches))
				{
					self::$proj 		= $v['P'];
					self::$module  		= $v['M'];
					self::$controller   = $v['C'];
					self::$action  		= $v['A'];
					
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
							DOUri::SetParams($mk,$mv);
 						}
 						else $pas[] = $mv;
					}
					if(preg_match('#'.preg_quote('(.*)').'$#',$rule))
					{
						self::$params = explode('/',$pas[0]);
					}
					else  
					{
						self::$params       = $pas;
					}
					break;
				}
			}
			if( $myroute = self::$maps[$pathinfo.'/*'])
			{
				self::$module  		= $myroute['M'];
				self::$controller   = $myroute['C'];
				self::$action  		= $myroute['A'];
			}
			self::$queryPath[serialize(
				array(
					self::$proj,self::$module,self::$controller,self::$action,self::$params
				)
			)] = $v;
		}
	}
	
	public static function GetPageIndex()
	{
		return DORouter::$module.'/'.self::$controller.'/'.self::$action;
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

	}
}
?>
