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
	/** Do we want to set a special header for an action?
	*** like we most probably set download http headers in a specify action
	*** to let user download a file.
	**/
	public function OnSetHeader($response)
	{
		//$response->SetHeader('Content-type','image/jpeg');	
	}	
	/** We can set different template in different controllers even different actions **/
	public function OnSetTemplate($response)
	{
	
	}
	/** We may do some prepare works before we rendered a block**/
	public function OnBeforeRenderBlockBanner($params)
	{
		//Display a cache block?	
	}
	/** We may want to change a block's displaying content in specify action**/
	public function OnAfterRenderBlockBanner($content)
	{
		//DOTemplate::$params['blocks']['banner'] = 'i changed it through event';
	}
}
?>
