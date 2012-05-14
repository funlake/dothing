<?php
class PlgSystem
{
	public function __construct( $params )
	{
		$this->params = $params;
	}
	
	public function OnPrepareRoute()
	{
		$request = DOFactory::GetTool('http.request');
		/** Strip slash since we using pdo **/
		if(get_magic_quotes_gpc())
		{
			/** Gpc strip slashes **/
			$_GET 		= DOStripslashes($_GET);
			$_POST  	= DOStripslashes($_POST);
			$_COOKIE  	= DOStripslashes($_COOKIE);
		}
		$response = DOFactory::GetTool('http.response');
		$response->SetHeader("Content-type","text/html;charset=".DO_CHARSET);
		/**Check permission here?*/
		//DOAcl::Check();
	}
	
	public function OnAfterRoute()
	{
	}
	/** Before page dispaly **/
	public function OnPagePrepare($response)
	{
		//$response->SetBody($response->GetBody());	
		return true;
	}

	public function OnPageFinish()
	{

	}
}
?>
