<?php 
class DOLang 
{
	private static $loadGlobal = false;
	private static $moudleLang = array();
	private static $ctrLang = array();
	public static function Get($text)
	{
		return $text;
		/** Module language text **/
		$moduleLang = self::GetModuleLang();
		if(isset($moduleLang[$text])) return $moduleLang[$text];
		/** Controller language text **/
		$ctrlLang	= self::GetControllerLang();
		if(isset($ctrlLang[$text])) return $ctrlLang[$text];
		
		return $text;
		
	}	
	
	public static function GetModuleLang()
	{
		/** Load global language file **/
		if(!self::$moudleLang)
		{
			$globalLangFile = SYSTEM_ROOT.DS.'languages'.DS.self::GetLangCode().DS.DORouter::$module.'.php';
			if(file_exists($globalLangFile))
			{
				self::$moudleLang = include $globalLangFile;
			}
			self::$moudleLang = true;
		}
		return self::$moudleLang;
	}
	
	public static function GetControllerLang()
	{
		/** Load global language file **/
		if(!self::$ctrLang[DORouter::$controller])
		{
			$ctrLangFile = SYSTEM_ROOT.DS.'languages'
							  .DS.self::GetLangCode().DS
							  .DORouter::$module.'.'.DORouter::$controller.'.php';
			if(file_exists($ctrLangFile))
			{
				self::$ctrLang[DORouter::$controller] = include $ctrLangFile;
			}
		}
		return self::$ctrLang[DORouter::$controller];
	}
	public static function GetLangCode()
	{
		if(!defined('DO_LANG'))
		{
			define('DO_LANG','en-GB');		
		}
		return DO_LANG;
	}
}
?>