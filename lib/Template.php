<?php
class DOTemplate
{
	public static $params 	= array();
	public static $template	= '';
	public static function SetPrams($params)
	{
		foreach($params as $key=>$val) self::SetParam($key,$val);
	}
	
	public static function SetParam($key,$val)
	{
		$key = strtolower($key);
		self::$params[$key] = $val;
	}
	public static function SetTemplate( $template = '')
	{
		self::$template = $template ? $template : DO_TEMPLATE;
	}
	
	public static function GetTemplate()
	{
		return self::$template;
	}
	public static function LoadTemplate( )
	{
		$template = self::GetTemplate();
		
		if(!defined('MYROOT'))
		{
			define('MYROOT',DOUri::GetRoot().'/templates/'.$template);
		}
		ob_start();
		include TEMPLATEROOT.DS.$template.DS.'index.php';
		$content = ob_get_contents();
		ob_end_clean();
		return $content;
	}
	/**Core function,use to set hooks for all elements we want to display in template**/
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
	public static function GetBlocks( $pos )
	{
		$pos = strtolower( $pos );
 		DOHook::TriggerEvent(
			array(
				'beforeRenderBlock'.ucwords($pos) => array(self::$params)
			)
		);
		/** Display blocks according to related position **/
		ob_start();	
		DOBlocks::Show($pos);
		$blockContent = ob_get_contents();
 		self::$params["blocks"][$pos] .= $blockContent;
		ob_end_clean();
 		
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
