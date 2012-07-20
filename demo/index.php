<?php
error_reporting( ~E_NOTICE & ~E_STRICT );
ini_set('display_errors',true);
define( 'DS'			, DIRECTORY_SEPARATOR );
define('SYSTEM_NAME'	,basename(__FILE__));
define('SYSTEM_ROOT'	,realpath(dirname(__FILE__)));
/** Load bootstrap **/
include '../bootstrap.php';
/** System config **/
include 'config.php';
try
{
	/** Capture request **/
	$request 	= DOFactory::GetTool('http.request');
	/** Clean dangrous params **/
	$request->Clean();
	
	/** Parse Uri then dispatch **/
	DORouter::Dispatch(	DOUri::Parse() );
	/** Generate response **/
	$response	= DOFactory::GetTool('http.response');
	/** Http response **/
	$response->Response();
}
catch(DOException $e)
{
	/** Capture request **/
	$request 	= DOFactory::GetTool('http.request');
	if(!$request->Get('__ajax','request'))
	{
		include 'error.php';
	}
	else
	{//Dump as json
		
	}
}
?>
