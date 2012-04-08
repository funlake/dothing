<?php
class DOTemplate
{
	public static $params = array();
	
	public static function SetPrams($params)
	{
		foreach($params as $key=>$val) self::SetParam($key,$val);
	}
	
	public static function SetParam($key,$val)
	{
		$key = strtolower($key);
		self::$params[$key] = $val;
	}
	
	public static function LoadTemplate( $template )
	{
			ob_start();
			include TEMPLATEROOT.DS.$template.DS.'index.php';
			$content = ob_get_contents();
			ob_end_clean();
			return $content;
	}
	/**Core function,use to set hook all elements we want to display in template**/
	public static function _()
	{
		$args 	= func_get_args();
		$type	= strtolower(array_shift($args));
		echo call_user_func_array(array(self,'GET'.ucwords($type)),$args);
	}
	public static function SetTitle( $title )
	{
		self::$params['title'] = $title;
	}
	public static function GetBlocks( $pos )
	{
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