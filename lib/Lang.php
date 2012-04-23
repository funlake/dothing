<?php 
class DOLang 
{
	public static function Get($text,$default)
	{
		if(!empty($text))
		{
			return $text;
		}
		return $default;
	}	
}
?>