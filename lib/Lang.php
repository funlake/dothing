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
		$textkey	= preg_replace(array('#\s+#','#[[:punct:]]#'),array('_',''),$text);
		if(isset($moduleLang[$textkey])) return $moduleLang[$textkey];
		/** Controller language text **/
		$ctrlLang	= self::GetControllerLang();
		if(isset($ctrlLang[$textkey])) return $ctrlLang[$textkey];
		
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
		if(!isset(self::$ctrLang[DORouter::$controller]))
		{
			$ctrLangFile = SYSTEM_ROOT.DS.'languages'
							  .DS.self::GetLangCode().DS
							  .DORouter::$module.'.'.DORouter::$controller.'.ini';
			if(file_exists($ctrLangFile))
			{
				self::$ctrLang[DORouter::$controller] = parse_ini_file($ctrLangFile);
			}
			else
			{
				self::$ctrLang[DORouter::$controller] = null;
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