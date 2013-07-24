<?php
class DOPlgSystemAfterpagerender extends DOPlugin
{
	public function Trigger( $response = null)
	{
		$mca 			= DORouter::GetMca();
		$cache 		= DOFactory::GetCache(); 
		return $cache->SetPageCache($mca,$response->GetBody());
	}


}