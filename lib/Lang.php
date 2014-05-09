<?php 
namespace Dothing\Lib;
use \Dothing\Lib\Router as Router;
class Lang 
{
	private static $loadGlobal 	= false;
	private static $moudleLang 	= array();
	private static $ctrLang 	= array();
	private static $moduleLang = array();
	public static function Get($text)
	{
		/** Module language text **/
		$moduleLang = self::GetModuleLang();
		$textkey	= preg_replace(array('#\s+#','#[[:punct:]]#'),array('_',''),strtoupper($text));
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
			$globalLangFile = SYSTEM_ROOT.DS.'languages'.DS.self::GetLangCode().DS.Router::$module.'.ini';

			if(file_exists($globalLangFile))
			{
				self::$moudleLang = parse_ini_file($globalLangFile,true);
			}
		}
		//echo $globalLangFile;
		//print_r(self::$moduleLang);
		return self::$moudleLang;
	}
	/** Controller level language **/
	public static function GetControllerLang()
	{
		$lang = array();
		/** Load global language file **/
		if(!isset(self::$ctrLang[Router::$controller]))
		{
			$ctrLangFile = SYSTEM_ROOT.DS.'languages'
							  .DS.self::GetLangCode().DS
							  .Router::$module.'.'.Router::$controller.'.ini';
			if(file_exists($ctrLangFile))
			{
				self::$ctrLang[Router::$controller] = parse_ini_file($ctrLangFile,true);
			}
			else
			{
				self::$ctrLang[Router::$controller] = null;
			}
		}
		return self::$ctrLang[Router::$controller];
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