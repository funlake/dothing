<?php
class DOIndexEvent
{
	/** Before indexAction call **/
	public function OnBeforeRequestIndex($params)
	{
	}
	/** After indexAction call **/
	public function OnAfterRequestIndex($results)
	{
	}
	/** Do we want to set a special header for a action?
	*** like we may support file download function ,so in
	*** the specific action ,you must set specify headers for that.
	**/
	public function OnSetHeader($response)
	{
		//$response->SetHeader('Content-type','image/jpeg');	
	}	
	/** You can set different template in different controllers event actions **/
	public function OnSetTemplate($response)
	{
	}
}
?>
