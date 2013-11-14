<?php 
class DOControllerIndex extends DOController
{
	public function indexAction($request = null)
	{
		$sess = DOFactory::GetSession();
		$variables['source'] 	= base64_decode($request->get['source']);
		$variables['mca']		= base64_decode($request->get['mca']);
		$variables['errors'] 	= $sess->Get('Error_Msg');
		$this->Display(null,$variables);
	}

	public function clearsessionAction($request = null)
	{
		$session = DOFactory::GetSession();
		$pageSession = preg_grep('#'.$request->post['mca'].'#',array_keys($session->get()));
		array_map(array($session,'Clean'),$pageSession);
		//print_r($session->Get());
		//print_r($request->post['source_link']);exit;
		if(strpos($request->post['mca'],"autocrud") === 0)
		{
			DOUri::Redirect(Url('debug/index/index'),L('Session variables of page have been cleared'),'error');
		}
		else
		{ 
			DOUri::Redirect($request->post['source_link'],L('Session variables of page have been cleared'),'warning');
		}
	}
}
?>