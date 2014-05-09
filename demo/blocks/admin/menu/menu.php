<?php 
!defined('DO_ACCESS') AND DIE("Go Away!");
use \Dothing\Lib\Router;
use \Dothing\Lib\Uri;
class DOBlocksAdminMenu extends \Dothing\Lib\BlocksItem
{
	public function GetMenu()
	{
		$cur = Router::GetController();
		return array(
		   array(
				'title' => L('Dashboard')."<b class='caret'></b>"
			   ,'link'  =>'#'
			   ,'class' => (($cur == 'dashboard') ? ' active' : ''). ' dropdown'
			   ,'attrs' => ' class="dropdown-toggle" data-toggle="dropdown" '
			   ,'child' => array(
			   	array(
			   		'title' => L('Setting'),
			   		'link'  => Url("admin/dashboard/setting"),
			   		'class' => ''
			   	)
			   )
			)
		   ,array(
				'title' => L('Components')."<b class='caret'></b>"
			   ,'link'  => '#'
			   ,'icon' => ''
			   ,'class' => 'dropdown '.(in_array($cur,array('module','user','role','category')) ? 'active' : '')
			   ,'attrs' => ' class="dropdown-toggle" data-toggle="dropdown" '
			   ,'child' => array(
			   	   array(
			   			'title' => 'Users'
			   		   ,'link'	=> Url("admin/user/index"),
			   		   'class' => ''
			   		)
			   	   ,array(
			   			'title' => 'Categories'
			   		   ,'link'	=> Url("admin/category/index"),
			   		   'class' => ''
			   		)
			   	   ,array(
			   			'title' => 'Extensions'
			   		   ,'link'	=> Url("admin/module/index"),
			   		   'class' => ''
			   		)
			   	)
			)
		   ,array(
				'title' => L('Blocks')
			   ,'link'  => Uri::BuildQuery(DO_ADMIN_INTERFACE,"system","setting")
			   ,'attrs'=>''
			   ,'icon'  => 'icon-menu-tasks.png',
			   'class' => '',
			   'child' => array()
			)
		);
	}
}