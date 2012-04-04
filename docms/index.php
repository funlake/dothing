<?php
error_reporting( ~E_NOTICE & ~E_STRICT );
ini_set('display_errors',true);
define('DS'		,DIRECTORY_SEPARATOR ); 
define('SYSTEM_NAME'	,'docms');
define('SYSTEM_ROOT'	,realpath(dirname(__FILE__)));
define('APPBASE'	,'modules');
define('HOOKBASE'	,SYSTEM_ROOT.DS.'plugins'.DS);
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
DOHook::Hook('router','beforeRoute');

DORouter::Dispatch();

DOHook::Hook('router','afterRoute');

?>
