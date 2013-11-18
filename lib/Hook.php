<?php
/**
 * Event & Plugin hooker
 * @author lake
 *
 */
class DOHook
{
	private static $listener 	= array();

	/**
	*** @description
	*** Controller level event.
	*** After dispatch to a specific controller
	*** we can invoke events registered in controller.
	**/
	public static function TriggerEvent()
	{
		$args 	= func_get_args();
		if(!DORouter::$module) return;
		self::LoadEvents();
		foreach( $args as $events)
		{
			foreach($events as $event=>$params)
			{
				/**Do we have registered this event for all action?**/
				$onEvent = 'On'.ucwords($event);
				/**Event would always call after controller loaded**/
				$CTR	 = DOController::GetControllerEvent();
				if(method_exists($CTR,$onEvent))
				{
					call_user_func_array(array(
						$CTR,$onEvent
					), $params);
					// DOEvent::CallChain(DORouter::$controller,strtolower($event),$params);
				}
				/**Do we have registered this event for specific action?**/
				$onEvent = 'On'.ucwords($event).ucwords(DORouter::$action);

				if(method_exists($CTR,$onEvent))
				{
					call_user_func_array(array(
						$CTR,$onEvent
					), $params);
					// DOEvent::CallChain(DORouter::$controller
					// 	,strtolower($event.DORouter::$action),$params
					// );
				}
			}

		}
	}
	public static function LoadEvents()
	{
		static $loaded = array();
		if(!isset($loaded[DORouter::$module]))
		{
			$listenerFile = DOController::GetPath('event').DS.'event.listener.php';
			if(file_exists($listenerFile)) 
			{
				include $listenerFile;
			}
			$loaded[DORouter::$module] = true;
		}
	}
	public static function HangPlugin( $event , array $params = null )
	{
		foreach((array)self::FetchPlugins($event) as $plugin )
		{
			call_user_func_array(array($plugin,'Trigger'),$params);
		}
	}
	
	public static function FetchPlugins( $event )
	{
		static $events = null;
		if(!$events)
		{
			$events = include PLGBASE.DS.'config.php';
		}
		$event = strtolower($event);
		if(!isset(self::$listener[$event]))
		{
			foreach($events[$event] as $plugin=>$valid)
			{
				if(!$valid) continue;
				include PLGBASE.DS.$event.DS.'plg_'.$plugin.'.php';
				$class 	= 'DOPlg'.ucwords(strtolower($plugin)).ucwords($event);
				self::$listener[$event][] = new $class();
			}
		}
		return self::$listener[$event];
	}
}

?>
