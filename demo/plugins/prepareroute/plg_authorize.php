<?php
/**
**
** authorize plugin,see people if they can access current action.
**/
use \Dothing\Lib\Uri;
use \Dothing\Lib\Factory;
class DOPlgAuthorizePrepareroute extends \Dothing\Lib\Plugin
{
	public function Trigger($params = array())
	{
		$mca = $params[0];
		/** Login check ,for backend **/
		if($mca[0] == "admin" )
		{
			$session = Factory::GetSession();

			if(($mca[1]."/".$mca[2] ) != "user/login")
			{
				if($session->Get('_adm_user') == null)
				{
					$msg = L("Please login to access backend modules");
					Uri::Redirect(Url("admin/user/login"),$msg,0);
					exit();
				}
			}
			else
			{
				if($session->Get('_adm_user') != null)
				{
					Uri::Redirect(Url("admin/user/index"),"",1);
					exit();
				}
			}
		}
	}
}
