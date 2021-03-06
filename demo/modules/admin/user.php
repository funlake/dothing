<?php
namespace Application\Modules\Admin;
!defined('DO_ACCESS') AND DIE("Go Away!");
use \Dothing\Lib\Uri;
use \Dothing\Lib\Factory;
class User extends \Dothing\Lib\Controller
{
	public function loginAction($request = null)
	{
		if(!empty($request->post['user_name']) and !empty($request->post['user_pass']))
		{
			$user = M('user')->GetRow(
				array('user_name'=>'=?'),$request->post['user_name']
			);
			if($user->id)
			{
				$T = new \Dothing\Lib\Encrypt\Encrypt();
				//successfully verify
				if($T->Decrypt($user->user_pass) == $request->post['user_pass'])
				{
					if($user->state)
					{
						$session = Factory::GetSession();
						$session->Set("_adm_user",$user->user_name);
						$session->Set("_adm_user_id",$user->id);
						$session->Set("login_user",$user);
						//save permission from user->role->permissions
						$db    = Factory::GetDatabase();
						$db->Clean();
						$db->From("#__user_role","ur")
						->Innerjoin("#__role_permission","rp",array(
							"rp.role_id"             => "ur.role_id"
						))
						->Innerjoin("#__permission","p",array(
							"p.module_id" 	=> "rp.module_id",
							"p.operation_id"	=> "rp.operation_id"
						))
						->Select("p.url_pattern")
						->Where("ur.user_id=".$user->id)
						->Read();
						$pers = array();
						foreach($db->GetAll() as $permission):
							$pers[] = $permission->url_pattern;
						endforeach;
						//TODO: save permission from user->group->role->permission
						$session->Set("permissions",$pers);
						Uri::Redirect(Url("admin/user/index"),"",1);
					}
					else
					{
						Uri::Redirect(Url("admin/user/login")
							,L("Your account is not a publish admin ! please contact administrator.")
							,3
						);
					}
					exit();
				}
				else
				{
					Uri::Redirect(Url("admin/user/login")
						,L("Wrong user name or password! ")
						,0
					);
					exit();
				}
			}
			else
			{
				Uri::Redirect(Url("admin/user/login")
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
		$session = Factory::GetSession();
		$session->Clean();
		Uri::Redirect(Url("admin/user/login"),"",1);
		exit();
	}
	//@interface:access
	public function indexAction($request = null)
	{
		//echo 3;
		$this->Display(null);
	}
	//@interface:edit
	public function editAction($request = null )
	{
		$data 		= M('user')->UserGroupList($request->get['id']);
		$var['data']		= $data[0];
		$var['action']	= "Update";
		$var['request']	= $request;
		$this->Display(null,$var);
	}
	//@interface:add
	public function addAction($request = null)
	{
		$this->Display("edit",array("action"=>"Add","data" => new \stdClass()));
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
		$var['request']	= $request;
		$this->Display(null,$var);		
	}

	public function addgroupAction($request = null)
	{
		$var['action'] 	= 'Add';
		$var['data']    = new \stdClass();
		$var['request']	= $request;
		$this->Display('editgroup',$var);
	}

	public function roleAction($request = null)
	{
		$this->Display(null);
	}

	public function addroleAction($request = null)
	{
		$var['action'] = 'Add';
		$var['data']    = new \stdClass();
		$var['request']	= $request;
		$this->Display('editrole',$var);
	}

	public function editroleAction($request = null)
	{
		//$var['data']	= M('role')->GetRow(array('id'=>'=?'),$request->get['id']);
		$var['data'] 	= M('role')->GetRowById($request->get['id']);
		$var['action'] 	= 'Update';
		$var['request']	= $request;
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
		$var['request']	= $request;
		$this->Display('editoperation',$var);
	}

	public function editoperationAction($request = null)
	{
		$var['data']	= M('operation')->GetRowById($request->get['id']);
		$var['action'] 	= 'Update';
		$var['request']	= $request;
		$this->Display(null,$var);
	}

	public function rolepermissionAction($request = null)
	{
		$var['data']		= M('role')->GetRowById($request->get['id']);
		$var['request']	= $request;
		$this->Display(null,$var);
	}
}