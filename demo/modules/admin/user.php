<?php
class DOControllerUser extends DOController
{
	public function indexAction($request = null)
	{
		$this->Display(null);
	}

	public function editAction($request = null )
	{
		if($request->get['id'])
		{
			$user 			= M('user')->Select($request->get['id']);
			$var['data']	= $user[0];
			$var['action']  = 'Update';
		}
		else
		{
			$var['data']	= null;
			$var['action']  = 'Add';
		}
		$this->Display(null,$var);
	}

	public function groupAction($request = null)
	{
		$this->Display(null);
	}

	public function editgroupAction($request = null)
	{
		if($request->get['id'])
		{
			$group 			= M('group')->Select($request->get['id']);
			$var['data']	= $group[0];
			$var['action']  = 'Update';
		}
		else
		{
			$var['data'] 	= null;
			$var['action']	= 'Add';
		}
		$this->Display(null,$var);		
	}

	public function addgroupAction($request = null)
	{
		$var['action'] = 'Add';
		$this->Display('editgroup',$var);
	}
}