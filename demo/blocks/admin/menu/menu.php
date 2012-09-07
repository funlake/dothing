<?php 
!defined('DO_ACCESS') AND DIE("Go Away!");
class DOBlocksAdminMenu extends DOBlocksItem
{
	public function GetMenu()
	{
/*		$actions = include APPBASE.DS.DORouter::GetModule()
						  .DS.'view'
			              .DS.DORouter::GetController()
			              .DS.'action.config.php';

		$actions = $actions[DORouter::GetAction()];

		$actlist = array(); 

		$i 		 = 0;

		foreach($actions as $title=>$action)
		{
			$actlist[$i]['title'] = DOLang::Get($title);
			$actlist[$i]['onclick']  = $action['action'];
			$actlist[$i]['icon']  = 'icon-menu-'.$action['icon'].'.png';
			$actlist[$i]['link']  = $action['link'] ? $action['link'] : 'javascript:void(null);';
 			$i++;
		}
		return $actlist;*/
		return array(
		   array(
				'title' => DOLang::Get('Modules')
			   ,'link'  => DOUri::BuildQuery(DO_ADMIN_INTERFACE,"system","setting")
			   ,'icon'  => 'icon-menu-profile.png'
			)
		   ,array(
				'title' => DOLang::Get('Blocks')
						  ." <img class='pin' src='".DO_THEME_BASE."/_layout/images/back-nav-sub-pin.png'/>"
			   ,'link'  => DOUri::BuildQuery(DO_ADMIN_INTERFACE,"system","setting")
			   ,'icon'  => 'icon-menu-tasks.png'
			   ,'child' => array(
			   		array('title' => 'a','class'=>'first')
			   	   ,array('title' => 'b','class'=>'last')
			   	  // ,array('title' => '' ,'class'=>'pin')
			   	)
			)
		   ,array(
				'title' => DOLang::Get('Setting')
			   ,'link'  => DOUri::BuildQuery(DO_ADMIN_INTERFACE,"system","setting")
			   ,'icon'  => 'icon-menu-settings.png'
			)
		);
	}
}