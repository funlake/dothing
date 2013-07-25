<?php 
!defined('DO_ACCESS') AND DIE("Go Away!");
class DOBlocksAdminLeftmenu extends DOBlocksItem
{
	public function GetBackMenu()
	{
		$menus = array();
		$menus['admin/dashboard/setting'] = array(
			array(
				'title'		=> L('Global')
			   ,'link'		=> '#'
			   ,'class'		=> 'nav-header active'
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
				'title' => L('Modules')
			   ,'link'  => '#'
			   ,'class'	=> 'nav-header active'
			   ,'iconClass' => 'icon-user icon-white'
			   ,'child' => array(
			   		array(
						'title' => L('Users')
					   ,'link'  => Url(DO_ADMIN_INTERFACE."/user/index")
					   ,'class' => in_array(
					   					DORouter::GetController()."/".DORouter::GetAction(),
					   					array('user/index','user/edit')
					   				) ? 'active' : ''
					),
					array(
		  	   			'title' => L('User groups')
		  	   		   ,'link'  => Url(DO_ADMIN_INTERFACE.'/user/group')
					   ,'class' => in_array(
					   					DORouter::GetController()."/".DORouter::GetAction(),
					   					array('user/group','user/editgroup')
					   				) ? 'active' : ''		  	   		
					)
			   )
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
		return array();
	}
}