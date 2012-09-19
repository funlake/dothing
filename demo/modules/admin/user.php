<?php
class DOControllerUser extends DOController
{
	public function indexAction($request = null)
	{
		$this->Display(null);
	}

	public function editAction($request = null )
	{
		$user 			= M('user')->Select($request->get['id']);
		$var['data']	= $user[0];
		$this->Display(null,$var);
	}

	public function groupAction($request = null)
	{
		$this->Display(null);
	}

	public function editgroupAction($request = null)
	{
		$group 			= M('group')->Select($request->get['id']);
		$var['data']	= $group[0];
		$this->Display(null,$var);		
	}
}