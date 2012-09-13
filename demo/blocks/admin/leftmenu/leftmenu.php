<?php 
!defined('DO_ACCESS') AND DIE("Go Away!");
class DOBlocksAdminLeftmenu extends DOBlocksItem
{
	public function GetBackMenu()
	{
		$menu = array();
		$menu['admin/system/setting'] = array(
			array(
				'title'		=> L('Global')
			   ,'link'		=> '#'
			   ,'class'		=> 'nav-header'
			   ,'child'	=> array(
			   		array(
			   			'title' => L('Basic Info')
			   		   ,'link'  => '#baseinfo'
			   		)
			   	   ,array(
			   	   		'title' => L('System')
			   	   	   ,'link'  => '#system'
			   	   	)
			   	   ,array(
				   		'title'		=> L('Database')
				   	   ,'link'		=> '#database'
				   	   ,'class'     => 'active'
		   			)
			   	)
			)

		);
		return $menu[DORouter::GetPageIndex()];
	}
}