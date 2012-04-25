<?php 
class DOLang 
{
	private static $loadGlobal 	= false;
	private static $moudleLang 	= array();
	private static $ctrLang 	= array();
	public static function Get($text)
	{
		/** Module language text **/
		$moduleLang = self::GetModuleLang();
		if(isset($moduleLang[$text])) return $moduleLang[$text];
		/** Controller language text **/
		$ctrlLang	= self::GetControllerLang();
		if(isset($ctrlLang[$text])) return $ctrlLang[$text];
		
		return $text;
		
	}	
	/** Module level language **/
	public static function GetModuleLang()
	{
		$lang = array();
		/** Load global language file **/
		if(!self::$moudleLang)
		{
			$globalLangFile = SYSTEM_ROOT.DS.'languages'.DS.self::GetLangCode().DS.DORouter::$module.'.ini';
			if(file_exists($globalLangFile))
			{
				self::$moudleLang = parse_ini_file($globalLangFile);
			}
		}
		return self::$moudleLang;
	}
	/** Controller level language **/
	public static function GetControllerLang()
	{
		$lang = array();
		/** Load global language file **/
		if(!self::$ctrLang[DORouter::$controller])
		{
			$ctrLangFile = SYSTEM_ROOT.DS.'languages'
							  .DS.self::GetLangCode().DS
							  .DORouter::$module.'.'.DORouter::$controller.'.ini';
			if(file_exists($ctrLangFile))
			{
				self::$ctrLang[DORouter::$controller] = parse_ini_file($ctrLangFile);
			}
		}
		return self::$ctrLang[DORouter::$controller];
	}
	/** Get language code **/
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