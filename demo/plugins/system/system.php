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
		if($_COOKIE[$session->GetName()])
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
