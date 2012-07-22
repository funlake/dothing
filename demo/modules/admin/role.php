<?php
class DORole extends DOController
{
	public function indexAction($request=null)
	{
		$this->listAction($request);
	}

	public function listAction($request=null)
	{
		$req = $request->request;
		$dao = DOFactory::GetDatabase();
		$dao->Clean();
		$dao->From('#__role')
			->Select('*')
			->Where('1')
			->Limit($req['_start']*0,$req['_limit']*0+20)
			->OrderBy(array('id'=>'desc'))
			->Read();
		$variables['data']['roles'] = $dao->GetAll();
		$dao->Clean();
		$dao->From('#__role')
			->Select('count(*) as total')
			->Where('1')
			->Read();
		$variables['data']['roles_amount'] = $dao->GetOne('total');
		$this->Display('list',$variables);
	}

	public function formAction($request=null)
	{
		$this->Display(null);
	}
}