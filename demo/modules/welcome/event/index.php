<?php
//include dirname(__FILE__).DS.'index.listener.php';
/** Events for controller index **/
class DOIndexEvent
{
	public $cache       = null;
	public $cacheModule = array();
	/** Trigger before indexAction call **/
	public function OnBeforeRequestAddUser($params)
	{
		//echo "hello!ss";
		//print_r($params);exit;
	}
	/** Trigger after indexAction call **/
	public function OnAfterRequestAddUser($results)
	{
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
	public function OnBeforeRequest( $mca )
	{
		$cache = DOFactory::GetCache();

		DOTemplate::SetModule($cache->GetControllerCache($mca));
	}

	public function OnAfterRequest($mca,$content)
	{
		$cache = DOFactory::GetCache();
		
		$cache->SetControllerCache($mca,$content);
	}
/*	// Trigger before all actions in controller index call
	public function OnBeforeRequestIndex($mca)
	{
		// Check if cache prepare 
		$cache 					= DOFactory::GetCache();
		DORouter::$content  	= $cache->GetPageCache($mca);
	}
	// Trigger after all actions in constroller index call 
	public function OnAfterRequestIndex($mca,$content)
	{
		$cache 	= DOFactory::GetCache();
		$cache->SetPageCache($mca,$content);
	}*/

}
?>
