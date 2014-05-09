<?php
use \Dothing\Lib\Factory;
class DOBlocksMessage extends \Dothing\Lib\BlocksItem
{
	public function GetMessage()
	{
		$session = Factory::GetSession();
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
		$session = Factory::GetSession();
		$msg	 = $session->Set('__DOMSG','');
		$type	 = $session->Set('__DOMSG_TYPE','');		
	}
}

?>
