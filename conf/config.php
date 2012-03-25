<?php
define( 'DS', DIRECTORY_SEPARATOR );
//system
!defined('SYSTEM_NAME') && define('SYSTEM_NAME',basename( dirname(dirname(__FILE__)) ));
!defined('SYSTEM_ROOT') && define('SYSTEM_ROOT',realpath( dirname(dirname(__FILE__)) ));
define('FRAMEWORK_ROOT',realpath( dirname(dirname(__FILE__)) ));
define('IMAGE_ROOT',SYSTEM_ROOT.DS.'data'.DS.'images');
define('JS_ROOT',SYSTEM_ROOT.DS.'data'.DS.'js');
define('CSS_ROOT',SYSTEM_ROOT.DS.'data'.DS.'css');
define('FILE_ROOT',SYSTEM_ROOT.DS.'data'.DS.'files');
define('TEMPLATE_ROOT',SYSTEM_ROOT.DS.'data'.DS.'template');
define('CACHE_ROOT',SYSTEM_ROOT.DS.'data'.DS.'cache');
?>
