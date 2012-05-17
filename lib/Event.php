<?php
class DOEvent
{
	private static $events = array();
	public function AddEvent($event,$listener)
	{// Implements by subclass
		list($ctr,$evt) = explode('.',$event);
		self::$events[$ctr][$evt][] = $listener;
	}

	public function CallChain($ctr,$evt,array $params = null)
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
	}
}
?>