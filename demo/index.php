<?php
error_reporting( ~E_NOTICE & ~E_STRICT );
ini_set('display_errors',true);
define( 'DS'		, DIRECTORY_SEPARATOR );
define('SYSTEM_NAME'	,'docms');
define('SYSTEM_ROOT'	,realpath(dirname(__FILE__)));
include '../dothing/bootstrap.php';
include 'config.php';
$Request 	= DOFactory::GetTool('http.request');
$Request->Clean();
DOUri::Parse();
/**$C = new DOCache();
$C->GetCache( $params );
DOBlcoks::Prepare();
**/
DORouter::Dispatch();

$Response	= DOFactory::GetTool('http.response');
$Response->Response();

//DOHook::Hook('router','afterRoute');
?>
