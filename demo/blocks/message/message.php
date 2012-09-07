<?php
class DOBlocksMessage extends DOBlocksItem
{
	public function GetMessage()
	{
		$request = DOFactory::GetTool('http.request');
		$msg	 = $request->Get('__DOMSG','cookie');
		$type	 = $request->Get('__DOMSG_TYPE','cookie');
		if(!empty($msg))
		{
			return array('message' => $msg,'type' => $type);
		}
		return array();
	}
}

?>
