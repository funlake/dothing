<?php
class DOPlgSystemAfterpagerender extends DOPlugin
{
	public function Trigger( $params = array())
	{
		$response               = $params[0];
		$mca 			= DORouter::GetMca();
		$cache 		= DOFactory::GetCache(); 
		return $cache->SetPageCache($mca,$response->GetBody());
	}


}