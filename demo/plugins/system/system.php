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
			$_GET 		= DOStripslashes($_GET);
			$_POST  	= DOStripslashes($_POST);
			$_COOKIE  	= DOStripslashes($_COOKIE);
		}
		/**Check permission here?*/
	}
	
	public function OnAfterRoute()
	{
	}
	
	public function OnPrepareDocument($response)
	{
		//$response->SetBody($response->GetBody());	
		return true;
	}
}
?>
