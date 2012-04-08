<?php
error_reporting( ~E_NOTICE & ~E_STRICT );
ini_set('display_errors',true);
define( 'DS'		, DIRECTORY_SEPARATOR );
define('SYSTEM_NAME'	,'docms');
define('SYSTEM_ROOT'	,realpath(dirname(__FILE__)));
define('APPBASE'	,'modules');
define('PLGBASE'	,SYSTEM_ROOT.'/plugins/');
/** Where we put templates and related files**/
define('TEMPLATEROOT'	,SYSTEM_ROOT.DS.'templates');
define('IMAGEDIR'	,TEMPLATEROOT.DS.'images');
define('JSDIR'		,TEMPLATEROOT.DS.'js');
define('CSSDIR'		,TEMPLATEROOT.DS.'css');
/** Where we put files for system **/
define('FILEROOT',SYSTEM_ROOT.DS.'data'.DS.'files');
/** Where we put cachees files **/
define('CACHEROOT',SYSTEM_ROOT.DS.'data'.DS.'cache');
include '../dothing/bootstrap.php';
include 'config.php';
/**
*@mainframe
*
*Main::SafeCheck();
*Main::GetCache();
*Main::GetBlocks();
*Main::GetdModule()
*Main::Display();
*
*/
//before router,should set the template.
//DOHook::Hook('router','beforeRoute');
$Request 	= DOFactory::GetTool('http.request');
$Request->Clean();
DOUri::Parse();
/**$C = new DOCache();
$C->GetCache( $params );
DOBlcoks::Prepare();
**/
DORouter::Dispatch();

$Response	= DOFactory::GetTool('http.response');
$Response->Response();
//DOHook::Hook('router','afterRoute');
?>
