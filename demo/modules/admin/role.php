<?php
class DORole extends DOController
{
	public function indexAction($request)
	{
		$this->listAction($request);
	}

	public function listAction($request)
	{
		$req = DOFactory::GetTool('http.request');
		$dao = DOFactory::GetDatabase();
		$dao->Clean();
		$dao->From('#__user')
			->Select('*')
			->Where('1')
			->Limit($req->Get('_start')*0,$req->Get('_limit')*0+20)
			->OrderBy(array('user_name'=>'desc'))
			->Read();
		$variables['data']['roles'] = $dao->GetAll();
		$dao->Clean();
		$dao->From('#__user')
			->Select('count(*) as total')
			->Where('1')
			->Read();
			
		$variables['data']['roles_amount'] = $dao->GetOne('total');
		$this->Display('list',$variables);
	}

	public function refAction($request = null)
	{
		$refClass = new reflectionClass($this);
		foreach($refClass->getMethods() as $method)
		{
			if($method->isPublic())
			{
				$publics[] = $method->name;
			}
		}
		print_r($publics);
	}
}