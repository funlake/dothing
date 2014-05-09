<?php
/** Load bootstrap **/
include '../bootstrap.php';
//Load defines
include 'define.php';
/** System config **/
include 'config.php';

include 'includes/function.php';

/**
 * User custom error handler 
 * We should close this function in live enviroment
 **/
use \Dothing\Lib\Router as Router;
use \Dothing\Lib\Uri as Uri;
use \Dothing\Lib\Factory as Factory;
if(DO_DEBUG)
{
	error_reporting(E_ALL);
	if(error_reporting() AND ini_get('display_errors'))
	{
		$errorRef = new \Dothing\Lib\Error();
		set_error_handler(array($errorRef,'Capture'));
	}
} 
/** Capture request **/
try
{
	$request 	= new \Dothing\Lib\Http\Request();

	/** Clean dangrous params **/
	$request->Clean();
	/** Parse Uri then dispatch **/
	//$uri = DOUri::Parse()
	Router::Dispatch( Uri::Parse() );
	/** Generate response **/
	$response	= new \Dothing\Lib\Http\Response();
	/** Http response **/
	$response->Response();
}
catch(DOException $e)
{
	$request 	= Factory::GetTool('http.request');
	/** Capture request **/
	$session 	= Factory::GetSession();
	$msg 		= array();
	foreach($e->_getMessage() as $i=>$message)
	{
		$msg[$i]['msg']= $message['msg'];
		$msg[$i]['file']= $message['file'];
		$msg[$i]['line']= $message['line'];
		foreach($message['trace'] as $j=>$trace)
		{
			$msg[$i]['trace'][$j]['line'] = $trace['line'];
			$msg[$i]['trace'][$j]['file'] = $trace['file'];
			$msg[$i]['trace'][$j]['function'] = $trace['function'];
		}
		//echo $message['msg']."<br/>";
	}
	 $session->Set("Error_Msg",$msg);
	if(!$request->Get('__ajax','request'))
	{
		Uri::Redirect(
			Url(
				'debug/index/index',
				array(
					//'source' 	=> base64_encode(Url(DOUri::GetPageIndex(),DORouter::GetParams())),
					'mca'		=> base64_encode(DORouter::GetPageIndex())
				)
			)
		);
	}
	else
	{//Dump as json
		
	}
}
?>

