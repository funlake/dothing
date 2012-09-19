<?php
class DOUri
{
	public $project;
	/** MVC separator **/
	private static $separator  = ':';
	private static $module	   = DO_MODULE;
	private static $controller = 'index';
	private static $action     = 'index';
	private static $params 	   = array();
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
	public static function ParsePathInfo()
	{
		$pinfo 	= self::GetPathInfo();
		$pinfo 	= ltrim($pinfo,'/');
		$ps    	= explode('@',$pinfo,2);
		list(,$param) = $ps;
		$ps  	= explode('/',$ps[0]);
		//$param  = array_slice(self::SafeValue( $ps ),3);
		if(!empty($param))
		{
			parse_str($param,$params);
			self::$params		=  $_GET = $params;
		}
		$_REQUEST 				= array_merge($_REQUEST,$_GET);
		self::$module	  		= $ps[0] ? $ps[0] : self::$module;
		self::$controller 		= $ps[1] ? $ps[1] : self::$controller;
		self::$action     		= $ps[2] ? $ps[2] : self::$action;
		return array(self::$module,self::$controller,self::$action,self::$params);
	}
	public static function ParseNormal()
	{
		/** Prevent user parse same key as DOC_CKEY we configure before */
		$parsed = false;
		/** Set default module **/
		if(!$_GET)
		{
			$parsed = true;
		}
		/** Get pramse from either POST or GET **/
		foreach( $_GET as $key=>$val)
		{
			if( $key == DO_CKEY && !$parsed )
			{
				list(self::$module,$controller,$action) = explode(self::$separator,$val);
				if($controller != '') self::$controller = $controller;
				if($action     != '') self::$action	    = $action;
				$parsed = true;
			}
			else
			{
				self::$params[ $key ] = self::SafeValue( $val );
			}
		}
		if(!$parsed) 
		{
			throw new DOUriException("Did not find param '".DO_CKEY."' in uri",'000');
		}
		return array(self::$module,self::$controller,self::$action,self::$params);
	}	

	public static function SafeValue( $value )
	{
		return $value;
		//$filter = DOFactory::GetFilter();
		//return $filter->process( $value );
	}
	public static function GetPathInfo()
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
	public static function GetRoot()
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
				$mca	  = str_replace('%2F','/',$_SERVER['PATH_INFO']);
				$info 	  = preg_replace('#'.preg_quote($mca).'$#','',$info);
				//$info     = preg_replace('#/index(\.php)?$#','',$info);
			}
			else 
			{
				$info = $_SERVER['SCRIPT_NAME'] ? $_SERVER['SCRIPT_NAME'] : $_SERVER['PHP_SELF'];
				//$info     = preg_replace('#/index\.php$#','',$info);
			}
			$root     = $protocol.'://'.$host.$info;
		}

		return $root;
	}

	public static function GetBase()
	{
		return preg_replace('#/index\.php$#i','',self::GetRoot());
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
	public static function GetModule()
	{
		return !empty($_POST['__M']) ? $_POST['__M'] : self::$module;
	}
	/**
	 * get controllers name
	 *
	 * @return unknown
	 */
	public static function GetController()
	{
		return !empty($_POST['__C']) ? $_POST['__C'] : self::$controller;
	}
	
	/**
	 * get action's name
	 *
	 * @return unknown
	 */
	public static function GetAction()
	{
		return !empty($_POST['__A']) ? $_POST['__A'] : self::$action;	
	}
	/**
	 * get params
	 *
	 * @return unknown
	 */
	public static function GetParams()
	{
		return self::$params;
	}
	
	public static function Redirect($url,$msg='',$type=0)
	{
		if(!empty($msg))
		{
			$session = DOFactory::GetSession();
			$session->Set("__DOMSG"			,$msg);
			$session->Set("__DOMSG_TYPE"	,$type);
		}
		//setcookie("__DOMSG",$msg,time()+20);
		//setcookie("__DOMSG_TYPE",$type,time()+20);
		if(headers_sent())
		{
			echo "<script type='text/javascript'>location.href='{$url}';</script>";
		}
		else
		{
			$response = DOFactory::GetTool('http.response');
			$response->SetHeader('Location',$url);
		}
		//we have to do this before redirection.
		exit;
	}
	/**
	 * Format seo url.
	 *
	 * @param unknown_type $url
	 * @return unknown
	 */
	public static function Format( $url )
	{
		if(DO_SEO)
		{
			$url = preg_replace('#\?'.DO_CKEY.'=([^&]+&?)#ie','strtr("$1",":&","//");',$url,1);
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
	public static function BuildQuery($module,$controller='index',$action='index',$params='')
	{
		if(is_array($params))
		{
			$params = str_replace('&amp;','&',http_build_query($params));
		}
		if(!DO_SEO)
		{
			$link = '?'.DO_CKEY.'='.implode(self::$separator,array($module,$controller,$action))
				    .(!empty($params) ? '&'.$params : '');
		}
		else
		{
			$link = '/'.implode('/',array($module,$controller,$action))
				  . (!empty($params)?('@'.$params):'');
		}
		return self::RealUrl($link);
	}
	
	/**
	 * build the real path url.
	 *
	 * @param unknown_type $query
	 * @return unknown
	 */
	public static function RealUrl( $query )
	{
		//$query = self::Format($query);
		return self::GetRoot().$query;
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
	public static function SetParams( $key,$value)
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
	
	public static function SetParam($v)
	{
		$this->params[] = $v;
	}
	
}
?>
