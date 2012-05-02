<?php 
class DOIndex extends DOController
{
	public function indexAction()
	{
		$sess = DOFactory::GetSession();
		
		$variables['errors'] = $sess->Get('DO_Errorinfo');
		
		$this->Display(null,$variables);
	}
}
?>