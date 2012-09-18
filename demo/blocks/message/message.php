<?php
class DOBlocksMessage extends DOBlocksItem
{
	public function GetMessage()
	{
		$session = DOFactory::GetSession();
		$msg	 = $session->Get('__DOMSG');
		$type	 = $session->Get('__DOMSG_TYPE');
		//$this->CleanMessage();
		if(!empty($msg))
		{
			return array('message' => $msg,'type' => $type);
		}
		return array();
	}

	public function CleanMessage()
	{
		$session = DOFactory::GetSession();
		$msg	 = $session->Set('__DOMSG','');
		$type	 = $session->Set('__DOMSG_TYPE','');		
	}
}

?>
