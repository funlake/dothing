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
include 'includes/function.php';
/** Capture request **/
try
{
	$request 	= DOFactory::GetTool('http.request');
	/** Clean dangrous params **/
	$request->Clean();
	
	/** Parse Uri then dispatch **/
	DORouter::Dispatch( DOUri::Parse() );
	/** Generate response **/
	$response	= DOFactory::GetTool('http.response');
	/** Http response **/
	$response->Response();
}
catch(DOException $e)
{
	$request 	= DOFactory::GetTool('http.request');
	/** Capture request **/
	$sess = DOFactory::GetSession();
	$sess->Set("Error_Msg",$e->_getMessage());
	//print_r($sess->Get("Error_Msg"));exit;
	if(!$request->Get('__ajax','request'))
	{
		DOUri::Redirect(Url('debug/index/index'));
	}
	else
	{//Dump as json
		
	}
}
?>
