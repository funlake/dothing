<?php
class PlgSystem
{
	public function __construct( $params )
	{
		$this->params = $params;
	}
	
	public function OnPrepareRoute()
	{
		$session = DOFactory::GetSession();
		$request = DOFactory::GetTool('http.request');
		if($request->Get($session->GetName(),'cookie'))
		{
			$session->Start();
		}
		/**Check permission here?*/
	}
	
	public function OnAfterRoute()
	{
	}
	
	public function OnPrepareDocument($response)
	{
		$response->SetBody($response->GetBody());	
		return true;
	}
}
?>
