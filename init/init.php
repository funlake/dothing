<?php
$rootPath = realpath( dirname(__FILE__)."/../" ) ;

require_once($rootPath.'/conf/config.php');
//dynamic setting
require_once($rootPath.DS.'conf'.DS.'config_dyn.php');

require_once($rootPath.DS.'lib'.DS.'dothing'.DS.'class.loader.php');
//mvc
DOLoader::import('lib.base'
/*			  ,'lib.database.database'
			  ,'lib.session.session'*/
			  ,'lib.factory'
			  ,'mvc.controller'
			  ,'mvc.model'
			  ,'mvc.view'
);

//load the router..
$router = & DOFactory::get( 'class',array('router') );
?>
