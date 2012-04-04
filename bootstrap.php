<?php
define( 'DS'	, DIRECTORY_SEPARATOR );

define('FRAMEWORK_ROOT' ,realpath( dirname(__FILE__) ) );

include FRAMEWORK_ROOT.DS.'conf'.DS.'config.php';

include FRAMEWORK_ROOT.DS.'lib'.DS.'dothing'.DS.'class.loader.php';
/** Set autoload **/
spl_autoload_register(array('DOLoader','Autoload'));
//mvc
/*
DOLoader::import('lib.base'
			  ,'lib.Uri'
			  ,'lib.Router'
			  ,'lib.session.session' 
			  ,'lib.Hook'
			  ,'lib.cache.cache'
			  ,'lib.Factory'
			  ,'mvc.controller'
			  ,'mvc.model'
			  ,'mvc.view'
);
*/
?>
