<?php 
!defined('DO_ACCESS') AND DIE("Go Away!");
class DOBlocksAdminLeftmenu extends DOBlocksItem
{
	public function GetBackMenu()
	{
		$menus = array();
		$menus['admin/system/setting'] = array(
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
				   		'title'	=> L('Database')
				   	   ,'link'	=> '#database'
				   	   //,'class'     => 'active'
		   			)
			   	)
			)
		);
		$menus['admin/module/*'] = array(
		   array(
				'title' => L('Articles')
			   ,'link'  => '#'
			   ,'class' => 'active'
		   )
		  ,array(
				'title' => L('Messages')
			   ,'link'  => '#'
			   ,'class' => ''
			)
		  ,array(
				'title' => L('Travels')
			   ,'link'  => '#'
			   ,'class' => ''
			)
		);
		$menus['admin/user/*'] = array(
			array(
				'title' => L('All')
			   ,'link'  => Url(DO_ADMIN_INTERFACE."/user/index")
			   ,'class' => ''
			)
		   ,array(
				'title' => L('Administrator')
			   ,'link'  => Url(DO_ADMIN_INTERFACE."/user/index@group=admin")
			   ,'class' => ''
			)
		);
		$curIndex = DORouter::GetPageIndex();
		foreach($menus as $key=>$menu)
		{
			if($key == $curIndex OR preg_match('#'.$key.'#is',$curIndex))
			{
				return $menu;
			}
		}
		return null;
	}
}