<?php

class DORole extends DOController
{
	public function indexAction()
	{
		$this->listAction();
	}

	public function listAction()
	{
		$req = DOFactory::GetTool('http.request');
		$dao = DOFactory::GetDatabase();
		$dao->Clean();
		$dao->From('#__user')
			->Select('*')
			->Where('?')
			->Values('1')
			->Limit($req->Get('_start')*0,$req->Get('_limit')*0+20)
			->OrderBy(array('user_name'=>'desc'))
			->Read();
		//$dao->Clean();
		//$dao->
		$variables['data']['roles'] = $dao->GetAll();
		$dao->Clean();
		$dao->From('#__user')
			->Select('count(*) as total')
			->Where('?')
			->Values(1)
			->Read();

		$variables['data']['roles_amount'] = $dao->GetOne('total');
		$this->Display('list',$variables);
	}
}