<?php
/**
**
** authorize plugin,see people if they can access current action.
**/
class DOPlgAuthorizePrepareroute extends DOPlugin
{
	public function Trigger($params = array())
	{
		$mca = $params[0];
		/** Login check ,for backend **/
		if($mca[0] == "admin" )
		{
			$session = DOFactory::GetSession();

			if(($mca[1]."/".$mca[2] ) != "user/login")
			{
				if($session->Get('_adm_user') == null)
				{
					$msg = L("Please login to access backend modules");
					DOUri::Redirect(Url("admin/user/login"),$msg,0);
					exit();
				}
			}
			else
			{
				if($session->Get('_adm_user') != null)
				{
					DOUri::Redirect(Url("admin/user/index"),"",1);
					exit();
				}
			}
		}
	}
}
