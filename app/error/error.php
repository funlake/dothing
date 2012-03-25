<?php
class DOError extends DOController 
{
	function indexAction()
	{

		$error 				= $this->params['error'];
		$module				= $this->params['module'];
		$controller 	    = $this->params['controller'];
		$action   	        = $this->params['action'];
		$params				= $this->params;
		unset($params['module']);
		unset($params['controller']);
		unset($params['action']);
		unset($params['error']);
		//print_r($params);exit;
		if($params['backend'] == 'Y')
		{
			$this->set('backend','admin');
		}
		unset($params['backend']);
		$this->lastLink		= DOUri::buildQuery($module,$controller,$action,$params);
		
		$this->loadView($error);
	}
}