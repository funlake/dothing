<?php
//include dirname(__FILE__).DS.'index.listener.php';
/** Events for controller index **/
class DOIndexEvent
{
	/** Trigger before indexAction call **/
	public function OnBeforeRequestAddUser($params)
	{
		//echo "hello!ss";
		//print_r($params);exit;
	}
	/** Trigger after indexAction call **/
	public function OnAfterRequestAddUser($results)
	{
		//print_r($results);exit;
		//$this->On(__METHOD__);
		//DOTemplate::SetModule($results."after");
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

	/** Trigger before all actions in controller index call **/
	public function OnBeforeRequest($params)
	{

	}
	/** Trigger after all actions in constroller index call **/
	public function OnAfterRequest($params)
	{

	}

	public function BindAfterRequestAdd($posts)
	{
		print_r($posts);
	}
}
?>
