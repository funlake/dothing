<?php
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
					$session = DOFactory::GetSession();
					$session->Set("_adm_user",$user->user_name);
					$session->Set("_adm_user_id",$user->id);
					DOUri::Redirect(Url(DO_ADMIN_INTERFACE."/user/index"),"",1);
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
	public function indexAction($request = null)
	{
		$this->Display(null);
	}

	public function editAction($request = null )
	{
		$user 	= M('user')->Select($request->get['id']);
		$var['data']	= $user[0];
		$var['action']	= "Update";
		$this->Display(null,$var);
	}
	public function addAction($request = null)
	{
		$this->Display("edit",array("action"=>"Add"));
	}
	public function groupAction($request = null)
	{
		$this->Display(null);
	}

	public function editgroupAction($request = null)
	{
		$group 		= M('group')->Select($request->get['id']);
		$var['data']		= $group[0];
		$var['action']  	= 'Update';
		$this->Display(null,$var);		
	}

	public function addgroupAction($request = null)
	{
		$var['action'] 	= 'Add';
		$this->Display('editgroup',$var);
	}
}