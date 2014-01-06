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
			   ,'iconClass' => ''
			   ,'child'	=> array(
			   	     array(
			   			'title' => L('Basic Info')
			   		   ,'link'  => '#baseinfo'
			   		   ,'iconClass' => ''
			   		)
			   	   ,array(
			   	   		'title' => L('System')
			   	   	   ,'link'  => '#system'
			   	   	   ,'iconClass' => ''
			   	   	)
			   	   ,array(
				   		'title'	=> L('Database')
				   	   ,'link'	=> '#database'
				   	   ,'iconClass' => ''
		   			)
			   	)
			)
		);
		$menus['admin/module/*'] = array(
		   array(
				'title' => L('Types')
			   ,'link'  => '#'
			   ,'class' => 'active'
			   ,'iconClass' => ''
			   ,'child' => array()
		   )
		  ,array(
				'title' => L('Cores')
			   ,'link'  => '#'
			   ,'class' => ''
			   ,'iconClass' => ''
			    ,'child' => array()
			)
		  ,array(
				'title' => L('Users')
			   ,'link'  => '#'
			   ,'class' => ''
			   ,'iconClass' => ''
			    ,'child' => array()
			)
		);
		$menus['admin/user/*'] = array(
			array(
				'title' => L('Modules')
			   ,'link'  => '#'
			   ,'class'	=> 'active'
			   ,'iconClass' => ''
			//   ,'iconClass' => 'glyphicon glyphicon-user glyphicon-white'
			   ,'child' => array(
			   		array(
						'title' => L('Users')
					   ,'link'  => "admin/user/index"
					   ,'iconClass' => 'glyphicon glyphicon-user glyphicon-white'
					   ,'class' => in_array(
					   					DORouter::GetController()."/".DORouter::GetAction(),
					   					array('user/index','user/edit')
					   				) ? 'item-active' : ''
					),
					array(
		  	   			'title' => L('Groups')
		  	   		   ,'link'  => 'admin/user/group'
		  	   		    ,'iconClass' => 'glyphicon glyphicon-grid glyphicon-white'
					   ,'class' => in_array(
					   					DORouter::GetController()."/".DORouter::GetAction(),
					   					array('user/group','user/editgroup')
					   				) ? 'item-active' : ''		  	   		
					),
					array(
		  	   			'title' => L('Roles')
		  	   		   ,'link'  => 'admin/user/role'
		  	   		   ,'iconClass' => ''
					   ,'class' => in_array(
					   					DORouter::GetController()."/".DORouter::GetAction(),
					   					array('user/role','user/editrole','user/rolepermission')
					   				) ? 'item-active' : ''		  	   		
					),
					array(
		  	   			'title' => L('Permissions')
		  	   		   ,'link'  => 'admin/user/permission'
		  	   		    ,'iconClass' => ''
					   ,'class' => in_array(
					   					DORouter::GetController()."/".DORouter::GetAction(),
					   					array('user/permission','user/editpermission')
					   				) ? 'item-active' : ''		  	   		
					),
					array(
		  	   			'title' => L('Operations')
		  	   		   ,'link'  => 'admin/user/operation'
		  	   		    ,'iconClass' => ''
					   ,'class' => in_array(
					   					DORouter::GetController()."/".DORouter::GetAction(),
					   					array('user/operate','user/editoperate')
					   				) ? 'item-active' : ''		  	   		
					)
			   )
		   )
		);
		$curIndex = DORouter::GetPageIndex();
		$sess = DOFactory::GetSession();
		$permissions = $sess->Get("permissions");
	//	print_r($permissions);
		foreach((array)$menus as $key=>$menu)
		{
			if($key == $curIndex OR preg_match('#'.$key.'#is',$curIndex))
			{
				//see if people has permission for links.
				foreach($menu as $k1=>&$item):
					foreach($item['child'] as $k2=>&$child):
						$item['child'][$k2]['link'] = Url($item['child'][$k2]['link'] );

					endforeach;
				endforeach;
				return $menu;
			}
		}
		return array();
	}
}