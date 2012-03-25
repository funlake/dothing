<?php
class DORouter extends DOBase
{
	public $sep 		= '-';
	static $maps 		= array();
	static $proj		= '';
	static $module      = '';
	static $controller  = '';
	static $action      = '';
	static $params      = '';
	static $format      = array();
	static $mvcHash 	= array(
		 ':proj'		=> '#[a-z]+#i'
		,':module'		=>'#[a-z]+#i'	
		,':controller'		=>'#[a-z]+#i'
		,':action'		=>'#[a-z]+#i'	
	);
	static $queryPath      = array();
	
	function DORouter()
	{
		parent::__construct();
		
		$this->uri = & DOFactory::get('class',array('uri'));
	}
	function run( $admin='',$proj='')
	{

		$project   	= basename($proj);

		self::hasMap($this->uri->getPathInfo());

		if( $admin ) 
		{
			$ap = $this->setAdmin().'.';
		}

		$_404Page  = $this->page_404();
		//load fail
		//whether controller file exist
		if(self::$proj)
		{
			$appPath = implode('.',array(
				'proj',self::$proj,self::$module,self::$controller
			));
		}
		else 
		{
			$appPath = implode('.',array(
				APPBASE,self::$module,self::$controller
			));
		}
		if( ! DOController::loadController( $appPath ) )
		{
			//echo $_404Page;exit;
			//DOUri::redirect($_404Page);
		}
			
		$C   = 'DO'.ucwords(self::$controller);

		//whether controller class exist
		if( @class_exists($C))
		{
			$ctl = new 	$C();
		}
		else 
		{
			//DOUri::redirect($_404Page);
		}
		
		$method = self::$action.'Action';
		//action not exist
		if( @method_exists($ctl,$method) )
		{
			//hook beforeaction
			#$hook = & DOFactory::get('class',array('hook'));
			#$hook->on('beforeaction',self::$module,self::$controller,self::$action);
			//$ctl->$method( );

			call_user_func_array(array($ctl,$method),self::$params);
			#$hook->on('afteraction',self::$module,self::$controller,self::$action);
			return;
		}
		else 
		{
			//DOUri::redirect($_404Page);
		}
	}
	
	function setAdmin( )
	{
		$this->set('backend','admin');
		return $this->isAdmin();
	}
	function isAdmin( )
	{
		return parent::get('backend');
	}
	
	function page_404( )
	{
		$module		= $this->uri->getModule();
		$controller = $this->uri->getController();
		$action     = $this->uri->getAction();
		$params		= $this->uri->getParams();
		$p = array(
			    'error'			=> '404'
			   ,'module'		=> $module
			   ,'controller'	=> $controller
			   ,'action'		=> $action
		);
		//uniqe parames
		$u = array_merge($p,$params);
		//generate url string
		$_404Page = DOUri::buildQuery('error','error','index',$u);
		
		return $_404Page;
	}
	
	public static function map()
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
	 * get mvc from customized router.
	 *
	 * @param unknown_type $pathinfo
	 */
	function hasMap( $pathinfo  )
	{
		self::$module	  	= $this->uri->getModule();
		self::$controller 	= $this->uri->getController();
		self::$action     		= $this->uri->getAction();
		self::$params	 	= $this->uri->getParams();

		if(DO_CUSTOMIZED_ROUTE)
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
								     )
									,$k
				);
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
						if($ignoreNextLoop) {$ignoreNextLoop = false ; continue;}
						//match mvc string in url
						if(self::$mvcHash[':'.$mk])
						{
							self::${$mk} = $mv; 
							$ignoreNextLoop = true;
						}
						//params format
						if($kf = self::$format[$k][$mk])
						{
							$mv = sprintf($kf,$mv);
						}
						//set $_GET
						if(!is_numeric($mk))
						{
							$this->uri->setParams($mk,$mv);
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
				self::$proj		 	= $myroute['P'];
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
	//seo route
	public function _( $seolink )
	{
		return DOUri::getRoot().'/'.$seolink;
	}
}
?>
