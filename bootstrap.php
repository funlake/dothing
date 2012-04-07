<?php
!defined('DS') && define( 'DS'	, DIRECTORY_SEPARATOR );
/** Framework directory **/
define('FRAMEWORK_ROOT' ,realpath( dirname(__FILE__) ) );
/** Load loader first **/
include FRAMEWORK_ROOT.DS.'lib'.DS.'Loader.php';
/** Set autoload ,So those lib class can use directly**/
spl_autoload_register(array('DOLoader','AutoLoad'));
/** Preprare for url parse **/
DOLoader::Import('lib.http.request');
/* DOLoader::Import(
			   'lib.http.request'
			  ,'lib.http.response'
			  ,'mvc.controller'
			  ,'mvc.model'
			  ,'mvc.view'
);
 */
?>
