<?php
/**
**Template render class
**@author lake
**/

class DOTemplate
{
	public static $params 	= array();
	public static $template	= DO_TEMPLATE;
	public static function SetPrams($params)
	{
		foreach($params as $key=>$val) self::SetParam($key,$val);
	}
	
	public static function SetParam($key,$val)
	{
		$key = strtolower($key);
		self::$params[$key] = $val;
	}
	public static function SetTemplate( $template )
	{
		self::$template = $template ;
	}
	public static function SetTemplateUriPath($template)
	{
		!defined('DO_URI_BASE') AND define('DO_URI_BASE',DOUri::GetBase());
	 	!defined('DO_THEME_BASE') AND define('DO_THEME_BASE',DO_URI_BASE.'/templates/'.$template);	

	 	!defined('DO_THEME_DIR') AND define('DO_THEME_DIR',TEMPLATEROOT.DS.$template);	
	}
	public static function GetTemplate()
	{
		return self::$template;
	}
	public static function LoadTemplate( )
	{
		$template = self::GetTemplate();
		ob_start();
		$parsedFile	= TEMPLATEROOT.DS.$template.DS.'index.tpl.php';
		if(file_exists($parsedFile))
		{
			include $parsedFile;
			$content = ob_get_clean();

		}
		else
		{
			include TEMPLATEROOT.DS.$template.DS.'index.design.php';
			$content = ob_get_clean();
			$content = self::ParseTemplate($content,$parsedFile);
		}
		return $content;
	}

	public static function ParseTemplate($content,$path = '')
	{
		$content = self::Replace($content);
		if(!empty($path))
		{//write to parse file.
			file_put_contents($path,$content);
			ob_start();
			include $path;
			$content = ob_get_clean();
		}
		return $content;
	}

	public static function Replace($content)
	{
		return $content;
		return preg_replace(
			array(
				'#<(module|block)[^>]*(type\s*=\s*"([^"]+)")[^>]*/>#is'
			   ,'~#(\w+)#~'
			)
		   ,array(
		   		'<?php echo DOTemplate::_("\1","\3");?>'
		   	   ,'<?php echo \1;?>'
		   	)
		   ,$content
		);
	}
	/**
	**Core function,use to hook all elements we want to display in template
	**/
	public static function _()
	{
		$args 	= func_get_args();
		$type	= strtolower(array_shift($args));
		echo call_user_func_array(array(self,'Get'.ucwords($type)),$args);
	}
	public static function SetTitle( $title )
	{
		self::$params['title'] = $title;
	}

	public static function SetModule($module)
	{
		self::$params['module'] = $module;
	}
	public static function GetBlock( $pos )
	{
		$pos = strtolower( $pos );
		/**We probably need to adjust specific block in a controller**/
 		DOHook::TriggerEvent(
			array(
				'beforeRenderBlock'.ucwords($pos) => array(self::$params)
			)
		);
		/** Display blocks according to related position **/
		ob_start();	
		DOBlocks::Show($pos);
		$blockContent = ob_get_clean();
 		self::$params["blocks"][$pos] .= $blockContent;
 		/**We probably need to adjust specific block in a controller**/
		DOHook::TriggerEvent(
			array(
				'afterRenderBlock'.ucwords($pos) => array($blockContent)
			)
		);
		return self::$params['blocks'][$pos];
	}
	
	public static function GetModule()
	{
		return self::$params['module'];
	}
	
	public static function GetTitle()
	{
		return self::$params['title'];
	}
	public static function ParseHtml($file,$variables = array())
	{
		if(!!$variables)
		{//What variables we want to pass to tpl 
			extract($variables);
		}
		ob_start();
		include_once $file;
		return self::Parse(ob_get_clean(),null,$variables);
	}
	public static function Parse($content,$innerData = array(),$variables)
	{
		return preg_replace(
			array('#<(\w+):loop=([^>]+)>((?:((?![^<]+:loop).)|(?R))*)</\1:loop>#ise')
		   ,array('self::LoopParse("\2","\3",$innerData,"\1",$variables)')
		,$content);
	}
	public static function LoopParse($attr,$content,$innerData = array(),$tag,$variables)
	{
		list($source,$attrs) = preg_split("#\s+#",$attr,2);
		$innerData 			 = (array)$innerData;
		$html = array();
		if(!empty($source))
		{
			if(!empty($innerData))
			{
				$data = $innerData[$source];
			}
			else
			{
				$data = self::GetSource($source,$variables);
			}
			foreach((array)$data as $item)
			{
				$template = $content;
				if(strpos($template,":loop=") !== false)
				{
					$template = self::Parse($template,$item,$variables);
				}
				$item 	= (array)$item;
				$html[] = preg_replace('~{#([^@}]+)(@)?(?(2)(\w+))}~e','\3($item["\1"])',$template);
			}
		}
		if(count($html))
		{
			return stripslashes("<".$tag." ".$attrs.">".implode("",$html)."</".$tag.">");
		}
		return "";
	}
	public static function GetSource($source,$variables)
	{
		if(strpos($source,".") !== false)
		{//Read data from outside
			list($type,$core,$action) = sscanf($source,"%[^|]|%[^.].%s");
			$_method 			  = "Get".ucwords(strtolower($type))."Constant";
			$handler			  = call_user_func(array(__CLASS__,$_method),$core);
			return $handler->$action();
		}
		else
		{
			return $variables[trim($source,'{$}')];
		}
	}

	public static function GetModelConstant($model)
	{
		return DOFactory::GetModel(strtolower($model));
	}

	public static function GetBlockConstant($pos)
	{
		$pos = array_map('strtolower',explode("/",$pos));
		$pos = implode(".",$pos);
		return DOBlocks::GetBlock($pos);
	}
}
?>
