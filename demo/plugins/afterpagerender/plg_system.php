<?php
use \Dothing\Lib\Router;
use \Dothing\Lib\Factory;
class DOPlgSystemAfterpagerender extends \Dothing\Lib\Plugin
{
	public function Trigger( $params = array())
	{
		$response               = $params[0];
		$mca 			= Router::GetMca();
		$cache 			= Factory::GetCache(); 
		return $cache->SetPageCache($mca,$response->GetBody());
	}


}