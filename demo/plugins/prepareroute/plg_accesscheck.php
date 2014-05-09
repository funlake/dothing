<?php
use \Dothing\Lib\Router;
use \Dothing\Lib\Factory;
use \Dothing\Lib\Uri;
class DOPlgAccesscheckPrepareroute extends \Dothing\Lib\Plugin
{
	public function Trigger($params = array())
	{
		$mca = $params[0];
		$interface = Router::GetPageIndex();
		if(in_array(Router::GetModule(),array('debug','install'))) return;
		$permission = M('permission')->GetRow(array("url_pattern"=>'=?'),$interface);
		//if we need to check permission for login user
		if(isset($permission->module_id) and isset($permission->operation_id) ):
			$sess = Factory::GetSession();
			$permissions = $sess->Get("permissions");
			if(!in_array($interface,$permissions)):
				Uri::redirect(Url("debug/index/nopermission"),null,0);
				exit();
			endif;
		endif;
	}
}