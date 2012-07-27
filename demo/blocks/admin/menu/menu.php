<?php 
!defined('DO_ACCESS') AND DIE("Go Away!");
class DOBlocksAdminMenu extends DOBlocksItem
{
	public function GetMenu()
	{
		return array(
			array(
		   		'title' => 'Api'
		   	   ,'link'  => DOUri::BuildQuery(DO_ADMIN_INTERFACE,"api")
		   	   ,'icon'  => 'icon-menu-settings.png'
		   	   ,'child' => array(
/*		   	   		array(
		   	   			'title' => 'Property'
		   	   	   	   ,'link'  => '#'
		   	   	   	   ,'class' => 'first'
		   	   	   	)*/
		   	   	)
		   	)
			,array(
				'title' => 'System'
			   ,'link'  => DOUri::BuildQuery(DO_ADMIN_INTERFACE,"system","setting","a=1&b=2")
			   ,'icon'  => 'icon-menu-profile.png'
			)
		);
	}
}