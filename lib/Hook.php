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
				}
				/**Do we have registered this event for specific action?**/
				$onEvent = 'On'.ucwords($event).ucwords(DORouter::$action);
				if(method_exists($CTR,$onEvent))
				{
					call_user_func_array(array(
						$CTR,$onEvent
					), $params);					
				}
			}

		}
	}

	public static function HangPlugin( $event , array $params = null )
	{
		foreach((array)self::FetchPlugins($event) as $plugin )
		{
			$plugin->Trigger($params);
		}
	}
	public static function FetchPlugins( $event )
	{
		$event = strtolower($event);
		if(!self::$listener[$event])
		{
			foreach(glob(PLGBASE.DS.$event.DS.'*.php') as $plugins)
			{
				include $plugins;
				$plugin = basename($plugins,'.php');
				$class 	= 'DOPlg'.ucwords(strtolower($plugin)).ucwords($event);
				self::$listener[$event][] = new $class();
			}
		}
		return self::$listener[$event];
	}
}

?>
