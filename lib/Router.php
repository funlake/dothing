<?php
class DORouter extends DOBase
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
	
	function DORouter(){}
	public static function Dispatch()
	{
		self::Prepare();
		#self::hasMap(DOUri::GetPathInfo());
		/** Trigger plugin before all module route**/
		DOHook::HangPlugin('prepareRoute',array());
		/**Initiate controller object **/
		DOLoader::Import('mvc.controller');
		
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
				    'beforeRequest' => array(self::$params)
				)
			);
			ob_start();
			call_user_func_array(array($CTR,$method),self::$params);
			DOTemplate::SetModule($content = ob_get_clean());
 			DOHook::TriggerEvent(
				array(
				    'afterRequest' => array($content)
				)
			);
		}
		else 
		{
			throw new DORouterException("Unknown controller::action", 404);
		}
		DOHook::HangPlugin('afterRoute',array());
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
	public static function Prepare()
	{
		$pathinfo			= DOUri::GetPathInfo();
		self::$module	  	= DOUri::GetModule();
		self::$controller 	= DOUri::GetController();
		self::$action     	= DOUri::GetAction();
		self::$params	 	= DOUri::GetParams();
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
							self::${$mk} = $mv; 
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
}
?>
