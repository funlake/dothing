<?php
#define( 'DS'	, DIRECTORY_SEPARATOR );

define('DOROOT'	,realpath( dirname(__FILE__) ) );

include DOROOT.DS.'conf'.DS.'config.php';

include DOROOT.DS.'lib'.DS.'dothing'.DS.'class.loader.php';
//mvc
DOLoader::import('lib.base'
/*			  ,'lib.database.database'
			  */
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
?>
