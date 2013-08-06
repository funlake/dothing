<?php 
class DOControllerIndex extends DOController
{
	public function indexAction($request = null)
	{
		$sess = DOFactory::GetSession();

		$variables['errors'] = $sess->Get('Error_Msg');
		$this->Display(null,$variables);
	}
}
?>