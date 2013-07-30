<?php
!defined('DS') && define( 'DS'	, DIRECTORY_SEPARATOR );
/** Framework directory **/
define('FRAMEWORK_ROOT' ,realpath( dirname(__FILE__) ) );
/** Some base paths for project,project must define SYSTEM_ROOT**/
define('APPBASE'        		,SYSTEM_ROOT.DS.'modules');
define('VIEWBASE'    		,SYSTEM_ROOT.DS.'views'	 );
define('PLGBASE'        		,SYSTEM_ROOT.DS.'plugins');
define('WIGBASE'      		,SYFSTEM_ROOT.DS.'widgets');
//define('EVTBASE'        ,SYSTEM_ROOT.DS.'events' );
define('BLKBASE'        		,SYSTEM_ROOT.DS.'blocks' );
/** Where we put templates and related files**/
define('TEMPLATE_ROOT'   	,SYSTEM_ROOT.DS.'templates');

define('IMAGEDIR'       		,TEMPLATE_ROOT.DS.'images'  );
define('JSDIR'          		,TEMPLATE_ROOT.DS.'js'      );
define('CSSDIR'         		,TEMPLATE_ROOT.DS.'css'     );
/** Where we put files for system **/
define('FILEROOT'		,SYSTEM_ROOT.DS.'data'.DS.'files' );
/** Where we put cachees files **/
define('CACHEROOT'		,SYSTEM_ROOT.DS.'data'.DS.'cache');
/** Where we put tables files **/
define('TABLEBASE'		,SYSTEM_ROOT.DS.'tables');
/** Where we put models files **/
define('MODELBASE'		,SYSTEM_ROOT.DS.'models');
/** Load loader first **/
include FRAMEWORK_ROOT.DS.'lib'.DS.'Loader.php';
/** Set autoload ,So those lib class can use directly**/
spl_autoload_register(array('DOLoader','AutoLoadLib'));
spl_autoload_register(array('DOLoader','AutoLoadException'));
/** Include common functions **/
include FRAMEWORK_ROOT.DS.'include'.DS.'function.php';
/**
 * User custom error handler 
 * We should close this function in live enviroment
 **/
/* error_reporting(E_ALL);
if(error_reporting() AND ini_get('display_errors'))
{
	$errorRef = new DOError();
	set_error_handler(array($errorRef,'Capture'));
} */
/** Shutdown event **/
register_shutdown_function(array('DOHook','HangPlugin'),'shutdown',array());

?>
