<?php
class DOIndexEvent
{
	/** Before indexAction call **/
	public function OnBeforeRequestAdd($params)
	{
		//echo "hello!ss";
	}
	/** After indexAction call **/
	public function OnAfterRequestAdd($results)
	{
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

	public function OnBeforeRequest($params)
	{
	}
}
?>
