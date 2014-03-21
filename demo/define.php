<?php
error_reporting( ~E_NOTICE & ~E_STRICT );
ini_set('display_errors',true);
define( 'DS'			, DIRECTORY_SEPARATOR );
define('SYSTEM_NAME',basename(__FILE__));
define('SYSTEM_ROOT'	,realpath(dirname(__FILE__)));
/** Some base paths for project,project must define SYSTEM_ROOT**/
/**
**===============================Core definition=====================
**/
define('APPBASE'        		,SYSTEM_ROOT.DS.'modules');
define('VIEWBASE'    		,SYSTEM_ROOT.DS.'views'	 );
define('PLGBASE'        		,SYSTEM_ROOT.DS.'plugins');
define('WIGBASE'      		,SYFSTEM_ROOT.DS.'widgets');
/** Where we put models files **/
define('MODELBASE'		,SYSTEM_ROOT.DS.'models');
//define('EVTBASE'        ,SYSTEM_ROOT.DS.'events' );
define('BLKBASE'        		,SYSTEM_ROOT.DS.'blocks' );
/** Where we put templates and related files**/
define('TEMPLATE_ROOT'   	,SYSTEM_ROOT.DS.'templates');
/**
**===============================Extra definition=====================
**/
define('IMAGEDIR'       		,TEMPLATE_ROOT.DS.'images'  );
define('JSDIR'          		,TEMPLATE_ROOT.DS.'js'      );
define('CSSDIR'         		,TEMPLATE_ROOT.DS.'css'     );
/** Where we put files for system **/
define('FILEROOT'		,SYSTEM_ROOT.DS.'data'.DS.'files' );
/** Where we put cachees files **/
define('CACHEROOT'		,SYSTEM_ROOT.DS.'data'.DS.'cache');
/** Where we put tables files **/
define('TABLEBASE'		,SYSTEM_ROOT.DS.'tables');
?>