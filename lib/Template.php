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
		!defined('DO_THEME_BASE') AND
		define('DO_THEME_BASE',DOUri::GetRoot().'/templates/'.$template);
		
	}
	public static function GetTemplate()
	{
		return self::$template;
	}
	public static function LoadTemplate( )
	{
		$template = self::GetTemplate();
		//Set URI base for template file
		self::SetTemplateUriPath($template);
		ob_start();
		$parsedFile	= TEMPLATEROOT.DS.$template.DS.'index.tpl.php';
		if(file_exists($parsedFile))
		{
			include $parsedFile;
			return ob_get_clean();
		}
		else
		{
			include TEMPLATEROOT.DS.$template.DS.'index.design.php';
			return self::ParseTemplate(ob_get_clean(),$parsedFile);
		}
		
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
		return preg_replace(
			array(
				'#<(module|block)[^>]*(type="([^"]+)")?[^>]*/>#i'
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
		$blockContent = ob_get_contents();
		ob_clean();
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
}
?>
