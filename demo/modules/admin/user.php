<?php
!defined('DO_ACCESS') AND DIE("Go Away!");
class DOControllerUser extends DOController
{
	public function loginAction($request = null)
	{
		if(!empty($request->post['user_name']) and !empty($request->post['user_pass']))
		{
			$user = M('user')->GetRow(
				array('user_name'=>"=?" ),$request->post['user_name']
			);
			if($user->id)
			{
				$T = DOFactory::GetTool('encrypt');
				//successfully verify
				if($T->Decrypt($user->user_pass) == $request->post['user_pass'])
				{
					if($user->state)
					{
						$session = DOFactory::GetSession();
						$session->Set("_adm_user",$user->user_name);
						$session->Set("_adm_user_id",$user->id);
						DOUri::Redirect(Url(DO_ADMIN_INTERFACE."/user/index"),"",1);
					}
					else
					{
						DOUri::Redirect(Url(DO_ADMIN_INTERFACE."/user/login")
							,L("Your account is not a publish admin ! please contact administrator.")
							,3
						);
					}
					exit();
				}
				else
				{
					DOUri::Redirect(Url(DO_ADMIN_INTERFACE."/user/login")
						,L("Wrong user name or password! ")
						,0
					);
					exit();
				}
			}
			else
			{
				DOUri::Redirect(Url(DO_ADMIN_INTERFACE."/user/login")
					,L("Wrong user name or password! ")
					,0
				);
				exit();			
			}
		}
		$this->Display(null);
	}
	public function logoutAction($request = null)
	{
		$session = DOFactory::GetSession();
		$session->Clean();
		DOUri::Redirect(Url(DO_ADMIN_INTERFACE."/user/login"),"",1);
		exit();
	}
	//@interface:access
	public function indexAction($request = null)
	{
		$this->Display(null);
	}
	//@interface:edit
	public function editAction($request = null )
	{
		$data 		= M('user')->UserGroupList($request->get['id']);
		$var['data']		= $data[0];
		$var['action']	= "Update";
		$this->Display(null,$var);
	}
	//@interface:add
	public function addAction($request = null)
	{
		$this->Display("edit",array("action"=>"Add","data" => new stdClass()));
	}
	public function groupAction($request = null)
	{
		$this->Display(null);
	}

	public function editgroupAction($request = null)
	{
		$group 		= M('group')->GroupRoleList($request->get['id']);
		$var['data']		= $group[0];
		$var['action']  	= 'Update';
		$this->Display(null,$var);		
	}

	public function addgroupAction($request = null)
	{
		$var['action'] 	= 'Add';
		$var['data']    = new stdClass();
		$this->Display('editgroup',$var);
	}

	public function roleAction($request = null)
	{
		$this->Display(null);
	}

	public function addroleAction($request = null)
	{
		$var['action'] = 'Add';
		$var['data']    = new stdClass();
		$this->Display('editrole',$var);
	}

	public function editroleAction($request = null)
	{
		$var['data']	= M('role')->GetRow(array('id'=>'='.$request->get['id']));
		$var['action'] 	= 'Update';
		$this->Display(null,$var);
	}

	public function permissionAction($request = null)
	{
		$this->Display(null);
	}

	public function operationAction($request = null)
	{
		$this->Display(null);
	}

	public function addoperationAction($request = null)
	{
		$var['action'] = 'Add';
		$var['data']    = new stdClass();
		$this->Display('editoperation',$var);
	}

	public function editoperationAction($request = null)
	{
		$var['data']	= M('operation')->GetRow(array('id'=>'='.$request->get['id']));
		$var['action'] 	= 'Update';
		$this->Display(null,$var);
	}

	public function rolepermissionAction($request = null)
	{
		$this->Display(null);
	}
}