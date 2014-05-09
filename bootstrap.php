<?php
!defined('DS') && define( 'DS'	, DIRECTORY_SEPARATOR );
/** Framework directory **/
define('FRAMEWORK_ROOT' ,realpath( dirname(__FILE__) ) );
/** Load loader first **/
include FRAMEWORK_ROOT.DS.'lib'.DS.'loader.php';
/** Set autoload ,So those lib class can use directly**/
spl_autoload_register(array('\Dothing\Lib\Loader','AutoLoadLib'));
spl_autoload_register(array('\Dothing\Lib\Loader','AutoLoadException'));
/** Include common functions **/
include FRAMEWORK_ROOT.DS.'include'.DS.'function.php';

/** Shutdown event **/
//register_shutdown_function(array('\Dothing\Lib\Hook','HangPlugin'),'shutdown',array());
?>