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
				'title' => L('Types')
			   ,'link'  => '#'
			   ,'class' => 'active'
		   )
		  ,array(
				'title' => L('Cores')
			   ,'link'  => '#'
			   ,'class' => ''
			)
		  ,array(
				'title' => L('Users')
			   ,'link'  => '#'
			   ,'class' => ''
			)
		);
		$menus['admin/user/*'] = array(
			array(
				'title' => L('Modules')
			   ,'link'  => '#'
			   ,'class'	=> 'active'
			//   ,'iconClass' => 'glyphicon glyphicon-user glyphicon-white'
			   ,'child' => array(
			   		array(
						'title' => L('Users')
					   ,'link'  => Url(DO_ADMIN_INTERFACE."/user/index")
					   ,'iconClass' => 'glyphicon glyphicon-user glyphicon-white'
					   ,'class' => in_array(
					   					DORouter::GetController()."/".DORouter::GetAction(),
					   					array('user/index','user/edit')
					   				) ? 'item-active' : ''
					),
					array(
		  	   			'title' => L('Groups')
		  	   		   ,'link'  => Url(DO_ADMIN_INTERFACE.'/user/group')
		  	   		    ,'iconClass' => 'glyphicon glyphicon-grid glyphicon-white'
					   ,'class' => in_array(
					   					DORouter::GetController()."/".DORouter::GetAction(),
					   					array('user/group','user/editgroup')
					   				) ? 'item-active' : ''		  	   		
					),
					array(
		  	   			'title' => L('Roles')
		  	   		   ,'link'  => Url(DO_ADMIN_INTERFACE.'/user/role')
					   ,'class' => in_array(
					   					DORouter::GetController()."/".DORouter::GetAction(),
					   					array('user/role','user/editrole')
					   				) ? 'item-active' : ''		  	   		
					),
					array(
		  	   			'title' => L('Permissions')
		  	   		   ,'link'  => Url(DO_ADMIN_INTERFACE.'/user/permission')
					   ,'class' => in_array(
					   					DORouter::GetController()."/".DORouter::GetAction(),
					   					array('user/permission','user/editpermission')
					   				) ? 'item-active' : ''		  	   		
					),
					array(
		  	   			'title' => L('Operations')
		  	   		   ,'link'  => Url(DO_ADMIN_INTERFACE.'/user/operation')
					   ,'class' => in_array(
					   					DORouter::GetController()."/".DORouter::GetAction(),
					   					array('user/operate','user/editoperate')
					   				) ? 'item-active' : ''		  	   		
					)
			   )
		   )
		);
		$curIndex = DORouter::GetPageIndex();
		foreach((array)$menus as $key=>$menu)
		{
			if($key == $curIndex OR preg_match('#'.$key.'#is',$curIndex))
			{
				return $menu;
			}
		}
		return array();
	}
}