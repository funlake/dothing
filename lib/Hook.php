<?php
namespace Dothing\Lib;
/**
 * Event & Plugin hooker
 * @author lake
 *
 */
use \Dothing\Lib\Profiler as Profiler;
use \Dothing\Lib\Router;
use \Dothing\Lib\Controller;
class Hook
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
		if(!Router::$module) return;
		//self::LoadEvents();
		foreach( $args as $events)
		{
			foreach($events as $event=>$params)
			{
				/**Do we have registered this event for all action?**/
				$onEvent = 'On'.ucwords($event);
				Profiler::MarkStartTime('Event:'.$onEvent);
				/**Event would always call after controller loaded**/
				$CTR	 = Controller::GetControllerEvent();
				if(method_exists($CTR,$onEvent))
				{
					// call_user_func_array(array(
					// 	$CTR,$onEvent
					// ), $params);
					$CTR->$onEvent($params);
					// DOEvent::CallChain(Router::$controller,strtolower($event),$params);
				}
				Profiler::MarkEndTime('Event:'.$onEvent,__FILE__);
				/**Do we have registered this event for specific action?**/
				$onEvent = 'On'.ucwords($event).ucwords(Router::$action);
				Profiler::MarkStartTime('Event:'.$onEvent);
				if(method_exists($CTR,$onEvent))
				{
					// call_user_func_array(array(
					// 	$CTR,$onEvent
					// ), $params);
					$CTR->$onEvent($params);
					// DOEvent::CallChain(Router::$controller
					// 	,strtolower($event.Router::$action),$params
					// );
				}
				Profiler::MarkEndTime('Event:'.$onEvent,__FILE__);

			}

		}
	}
	public static function LoadEvents()
	{
		static $loaded = array();
		if(!isset($loaded[Router::$module]))
		{
			$listenerFile = DOController::GetPath('event').DS.'event.listener.php';
			if(file_exists($listenerFile)) 
			{
				include $listenerFile;
			}
			$loaded[Router::$module] = true;
		}
	}
	public static function HangPlugin( $event , array $params = null )
	{
		Profiler::MarkStartTime('Plugin:'.$event);
		foreach((array)self::FetchPlugins($event) as $plugin )
		{
			//Load slow
			$plugin->Trigger($params);
			//call_user_func_array(array($plugin,'Trigger'),$params);
		}
		Profiler::MarkEndTime('Plugin:'.$event,__FILE__);
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
