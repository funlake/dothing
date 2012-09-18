<?php
class DOControllerUser extends DOController
{
	public function indexAction($request)
	{
		$this->Display(null);
	}

	public function editAction($request)
	{
		$user 			= M('user')->Find($request->get['id']);
		$var['data']	= $user[0];
		$this->Display(null,$var);
	}
}