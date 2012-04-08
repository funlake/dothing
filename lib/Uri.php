<?php
class DOUri
{
	public $project;
	private static $module	   = 'welcome';
	private static $controller = 'index';
	private static $action     = 'index';
	private static $params = array();
	private function DOUri(){}
	
	/**
	 * Url parse 
	 */
	public static function Parse()
	{
		if( DO_SEO )
		{/** Parsing path info if we use customized url**/
			return self::ParsePathInfo();
		}
		/** Normal url parsing**/
		return self::ParseNormal();
	}
	/**
	 * path info parsing
	 *
	 */
	function ParsePathInfo()
	{
		$pinfo 	= self::GetPathInfo();
		$pinfo 	= ltrim($pinfo,'/');
		$ps    	= explode('/',$pinfo);
		self::$params			= array_slice(self::SafeValue( $ps ),3);
		self::$module	  		= $ps[0];
		self::$controller 		= $ps[1] ? $ps[1] : 'index';
		self::$action     		= $ps[2] ? $ps[2] : 'index';
		return true;
		//return compact('module','controller','action','params');
	}
	public function ParseNormal()
	{
		/** Prevent user parse same key as DOC_CKEY we configured */
		$parsed = false;
		/** Get pramse from either POST or GET **/
		foreach( $_GET as $key=>$val)
		{
			if( $key == DO_CKEY && !$parsed )
			{
				list(self::$module,$controller,$action) = explode('-',$val);
				if($controller == '') self::$controller = 'index';
				if($action     == '') self::$action	  = 'index';
				$parsed = true;
			}
			else
			{
				self::$params[ $key ] = self::SafeValue( $val );
			}
		}
		return true;
		//return compact('module','controller','action','params');
	}	

	public function SafeValue( $value )
	{
		$filter = DOFactory::GetFilter();
		return $filter->process( $value );
	}
	function GetPathInfo()
	{
		$dirname = str_replace(self::GetScheme().'://'.self::GetHost(),'',self::GetRoot());
		if($_SERVER['PATH_INFO'])
		{
			$pinfo = $_SERVER['PATH_INFO'];
			//$pinfo = preg_replace('#^/admin#i','',$pinfo);
		}
		elseif( $_SERVER['REQUEST_URI'])
		{
			$srul  = urldecode( $_SERVER['REQUEST_URI'] );
			$pinfo = $srul;
			$pinfo = preg_replace('#^'.$dirname.'#i','',$pinfo);
		}
		elseif( $_SERVER['REDIRECT_URL'] )
		{
			
			$pinfo = $_SERVER['REDIRECT_URL'];
			$pinfo = preg_replace('#^/'.$dirname.'#i','',$pinfo);
			$pinfo = preg_replace('#^admin#i','',$pinfo);
		}
		else 
		{
			$pinfo = $_SERVER['PHP_SELF'];
			$parry = explode('index.php',$pinfo,2);
			$pinfo = $parry[1];
		}
		return $pinfo;
	}
	/**
	 * Get live site root.
	 *
	 * @return unknown
	 */
	function GetRoot()
	{
		static $root;
		if(!$root)
		{
			$protocol = self::GetScheme();
			
			$host     = self::GetHost();
			
			if(DO_SEO) 
			{
				$info 	  = $_SERVER['REQUEST_URI'] ? $_SERVER['REQUEST_URI'] : $_SERVER['REDIRECT_URL'];
				$info	  = preg_replace('#\?.*$#','',$info);//remove any unSEO params string
	            		/**
				**path_info sometimes would lack of the first path..
				**(when path was http://project/index.php/index)
	            		**/
				$mca	  = str_replace('%2F','/',urlencode($_SERVER['PATH_INFO']));
				$info 	  = preg_replace('#'.preg_quote($mca).'$#','',$info);
				$info     = preg_replace('#/index$#','',$info);
			}
			else 
			{
				$info = $_SERVER['SCRIPT_NAME'] ? $_SERVER['SCRIPT_NAME'] : $_SERVER['PHP_SELF'];
				
				$info     = preg_replace('#/index\.php$#','',$info);
			}
			$root     = $protocol.'://'.$host.$info;
		}

		return $root;
	}
	public static function GetScheme( )
	{
		if(isset($_SERVER['HTTPS']) && !empty($_SERVER['HTTPS']) && strtolower( $_SERVER['HTTPS'] ) != 'off')
		{
			$http = 'https';
		}
		else $http = 'http';
		
		return $http;
	}
	
	public static function GetHost()
	{
		return $_SERVER['HTTP_HOST'];
	}
	public static function GetPort()
	{
		return $_SERVER['SERVER_PORT'];
	}
	/**
	 * use if multi projects.
	 *
	 * @return unknown
	 */
	function GetModule()
	{
		return self::$module;
	}
	/**
	 * get controllers name
	 *
	 * @return unknown
	 */
	function GetController()
	{
		return self::$controller;
	}
	
	/**
	 * get action's name
	 *
	 * @return unknown
	 */
	function GetAction()
	{
		return self::$action;	
	}
	/**
	 * get params
	 *
	 * @return unknown
	 */
	function GetParams()
	{
		return self::$params;
	}
	
	function Redirect($url,$msg='')
	{
		if(headers_sent())
		{
			echo "<script type='text/javascript'>location.href='{$url}';</script>";
		}
		else
			header('Location:'.$url);
	}
	/**
	 * Format seo url.
	 *
	 * @param unknown_type $url
	 * @return unknown
	 */
	function Format( $url )
	{
		if(DO_SEO)
		{
			$url = ltrim($url,'?');
			$url = preg_replace('#(?<=&)\w+\=([^&]*)#i','$1',$url);
			$url = preg_replace('#&(?!amp;)|=#','/',$url);
			$url = preg_replace('#\b'.DO_CKEY.'/([^/]+)#ie','str_replace("_","/","$1");',$url);
/*			//parse_str($url,$outUrl);
			print_r($url);
			$ck = $ul  = '';
			
			foreach($outUrl as $k=>$v)
			{
				if($k == DO_CKEY)
				{
					$ck = str_replace('_','/',$v);
				}
				else 
				{
					$ul .= '/'.$k.'/'.$v;
				}
			}
			$url = $ck.$ul;*/
		}
		
		return $url;
	}
	/**
	 * build url ,only need pass into controller,action,params.
	 *
	 * @param string $controller
	 * @param string $action
	 * @param string $params
	 * @return string
	 */
	function buildQuery($module,$controller,$action,$params='')
	{
		if(is_array($params))
		{
			$params = str_replace('&amp;','&',http_build_query($params));
		}
		if(!DO_CUSTOMIZED_ROUTE)
		{
			$link = '?'.DO_CKEY.'='.$module.'_'.$controller.'_'.$action.($params ? '&'.$params : '');

			return self::RealUrl($link);
		}
		else 
		{
			$link = '?'.DO_CKEY.'='.$module.'_'.$controller.'_'.$action.($params ? '&'.$params : '');

			return self::RealUrl($link);
			//DORouter::;
		}
	}
	
	/**
	 * build the real path url.
	 *
	 * @param unknown_type $query
	 * @return unknown
	 */
	function RealUrl( $query )
	{
		$query = self::Format($query);
		
		//echo $url;exit;
		if(strpos($query,'admin') !== 0 && (parent::get('backend') == 'admin') )
		{
			$query = 'admin/'.$query;
		}
		return self::GetRoot()."/".$query;
	}
	/**
	 * handle _GET params in path info url.
	 * 
	 * take care some complex urls like /index/welcome/array[][]/2/array[][]/3
	 * it will generate a php array  like : $array = array(array(0=>2,1=>3)) 
	 *
	 * @param string $key
	 * @param string $value
	 */
	function SetParams( $key,$value)
	{
		$filter = & DOFactory::get( 'class',array('filter') );
		//filter
		$value  = $filter->process( $value );
		if(preg_match('#^([a-z0-9_-]+)(\[([^\[\]]*)\])+$#',$key,$m))
		{
			if(isset($this->params[$m[1]]) && !is_array($this->params[$m[1]])) unset($this->params[$m[1]]);
			parse_str($m[0].'='.$value);
			$arr 	= $$m[1];
			$arrk 	= key($arr);
			if($arrk === 0)
			{
				$this->params[ $m[1] ][] =  $arr[$arrk];
			}
			$this->params[ $m[1] ][$arrk] =  $arr[$arrk];

		}
		else
		{
			$this->params[$key] = $value;
		}
		if(!$_GET && $this->params)
		{
			$_GET = $this->params;
		}
	}
	
	function SetParam($v)
	{
		$this->params[] = $v;
	}
	
}
?>
