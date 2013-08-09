<?php
class DOControllerModule extends DOController
{
	public function indexAction($request = null)
	{
		$this->Display(null);
	}

	public function addAction($request = null)
	{
		$var['action'] = 'Add';
		$this->Display('edit',$var);
	}

	public function editAction($request = null)
	{
		$var['action'] = 'Update';
		$var['data']    = M('module')->GetRow(array('id'=>'='.$request->get['id']));

		$this->Display(null,$var);
	}
}