<?php
namespace Application\Modules\Debug;
use \Dothing\Lib\Factory;
use \Dothing\Lib\Uri;
class Index extends \Dothing\Lib\Controller
{
	public function indexAction($request = null)
	{
		$sess = Factory::GetSession();
		$variables['source'] 	= base64_decode($request->get['source']);
		$variables['mca']		= base64_decode($request->get['mca']);
		$pageSession = preg_grep('#'.$request->get['mca'].'#',array_keys($sess->get()));
		array_map(array($session,'Clean'),$pageSession);
		$variables['errors'] 	= $sess->Get('Error_Msg');
		$this->Display(null,$variables);
	}

	public function clearsessionAction($request = null)
	{
		$session = Factory::GetSession();
		$pageSession = preg_grep('#'.$request->post['mca'].'#',array_keys($session->get()));
		array_map(array($session,'Clean'),$pageSession);
		//print_r($session->Get());
		//print_r($request->post['source_link']);exit;
		if(strpos($request->post['mca'],"autocrud") === 0)
		{
			Uri::Redirect(Url('debug/index/index'),L('Session variables of page have been cleared'),'error');
		}
		else
		{ 
			Uri::Redirect($request->post['source_link'],L('Session variables of page have been cleared'),'warning');
		}
	}

	public function nopermissionAction($request = null)
	{
		$this->Display(null);
	}
}
?>