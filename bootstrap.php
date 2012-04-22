<?php
!defined('DS') && define( 'DS'	, DIRECTORY_SEPARATOR );
/** Framework directory **/
define('FRAMEWORK_ROOT' ,realpath( dirname(__FILE__) ) );
/** Some base paths for project,project must define SYSTEM_ROOT**/
define('APPBASE'        ,SYSTEM_ROOT.DS.'modules');
define('PLGBASE'        ,SYSTEM_ROOT.DS.'plugins');
define('EVTBASE'        ,SYSTEM_ROOT.DS.'events' );
define('BLKBASE'        ,SYSTEM_ROOT.DS.'blocks' );
/** Where we put templates and related files**/
define('TEMPLATEROOT'   ,SYSTEM_ROOT.DS.'templates');
define('IMAGEDIR'       ,TEMPLATEROOT.DS.'images'  );
define('JSDIR'          ,TEMPLATEROOT.DS.'js'      );
define('CSSDIR'         ,TEMPLATEROOT.DS.'css'     );
/** Where we put files for system **/
define('FILEROOT'		,SYSTEM_ROOT.DS.'data'.DS.'files' );
/** Where we put cachees files **/
define('CACHEROOT'		,SYSTEM_ROOT.DS.'data'.DS.'cache');
/** Load loader first **/
include FRAMEWORK_ROOT.DS.'lib'.DS.'Loader.php';
/** Set autoload ,So those lib class can use directly**/
spl_autoload_register(array('DOLoader','AutoLoadLib'));
spl_autoload_register(array('DOLoader','AutoLoadException'));
?>
