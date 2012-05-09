<?php
error_reporting( ~E_NOTICE & ~E_STRICT );
ini_set('display_errors',true);
define( 'DS'			, DIRECTORY_SEPARATOR );
define('SYSTEM_NAME'	,basename(__FILE__));
define('SYSTEM_ROOT'	,realpath(dirname(__FILE__)));

include '../bootstrap.php';
/** System config **/
include 'config.php';
try
{
	/** Capture request **/
	$request 	= DOFactory::GetTool('http.request');
	/** Clean dangrous params **/
	$request->Clean();
	/** Parse URI **/
	DOUri::Parse();
	/**$C = new DOCache();
	$C->GetCache( $params );
	**/
	/** Route **/
	DORouter::Dispatch();
	/** Generate response **/
	$response	= DOFactory::GetTool('http.response');
	/** Http response **/
	$response->Response();
}
catch(DOException $e)
{
	print_r($e->_getMessage());
}
?>
