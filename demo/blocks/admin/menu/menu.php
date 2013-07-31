<?php 
!defined('DO_ACCESS') AND DIE("Go Away!");
class DOBlocksAdminMenu extends DOBlocksItem
{
	public function GetMenu()
	{
		$cur = DORouter::GetController();
		return array(
		   array(
				'title' => DOLang::Get('Dashboard')."<b class='caret'></b>"
			   ,'link'  =>'#'
			   ,'class' => (($cur == 'dashboard') ? ' active' : ''). ' dropdown'
			   ,'attrs' => ' class="dropdown-toggle" data-toggle="dropdown" '
			   ,'child' => array(
			   	array(
			   		'title' => L('Setting'),
			   		'link'  => Url(DO_ADMIN_INTERFACE."/dashboard/setting")
			   	)
			   )
			)
		   ,array(
				'title' => DOLang::Get('Components')."<b class='caret'></b>"
			   ,'link'  => '#'
			   ,'class' => 'dropdown '.(in_array($cur,array('module','user','role','category')) ? 'active' : '')
			   ,'attrs' => ' class="dropdown-toggle" data-toggle="dropdown" '
			   ,'child' => array(
			   	   array(
			   			'title' => 'Users'
			   		   ,'link'	=> Url(DO_ADMIN_INTERFACE."/user/index")
			   		)
			   	   ,array(
			   			'title' => 'Categories'
			   		   ,'link'	=> Url(DO_ADMIN_INTERFACE."/category/index")
			   		)
			   	   ,array(
			   			'title' => 'Extensions'
			   		   ,'link'	=> Url(DO_ADMIN_INTERFACE."/module/index")
			   		)
			   	)
			)
		   ,array(
				'title' => DOLang::Get('Blocks')
			   ,'link'  => DOUri::BuildQuery(DO_ADMIN_INTERFACE,"system","setting")
			   ,'icon'  => 'icon-menu-tasks.png'
			)
		);
	}
}