<?php
class DOEvent
{
/*	private static $events = array();
	public static function AddEvent($event,$listener)
	{// Implements by subclass
		list($ctr,$evt) = explode('.',$event);
		self::$events[$ctr][$evt][] = $listener;
	}

	public static function CallChain($ctr,$evt,array $params = null)
	{
		foreach((array)self::$events[$ctr][$evt] as $lst)
		{
			list($mod,$ipm) = explode('.',$lst);
			$ipm            = 'Event_'.strtolower($ipm);
			call_user_func_array(array(
				DOFactory::GetModel('#__'.$mod),$ipm
			),$params);
		}
		return true;
	}*/

	public function OnBeforeRequest( $mca )
	{//Get controller cache if it has
		$cache = DOFactory::GetCache();
		//echo class_exists('DOTemplate');
		DOTemplate::SetModule($cache->GetControllerCache($mca));
	}

	public function OnAfterRequest($mca,$content)
	{//Generate controller cache if needed[see modules/cache/cache.config.php]
		$cache = DOFactory::GetCache();
		$cache->SetControllerCache($mca,$content);
	}
}
?>