<?php
!defined('DS') && define( 'DS'	, DIRECTORY_SEPARATOR );
/** Framework directory **/
define('FRAMEWORK_ROOT' ,realpath( dirname(__FILE__) ) );
/** Load loader first **/
include FRAMEWORK_ROOT.DS.'lib'.DS.'Loader.php';
/** Set autoload ,So those lib class can use directly**/
spl_autoload_register(array('DOLoader','AutoLoadLib'));
spl_autoload_register(array('DOLoader','AutoLoadException'));
/** Include common functions **/
include FRAMEWORK_ROOT.DS.'include'.DS.'function.php';
/** Shutdown event **/
register_shutdown_function(array('DOHook','HangPlugin'),'shutdown',array());
?>