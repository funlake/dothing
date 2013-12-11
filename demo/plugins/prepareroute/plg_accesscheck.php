<?php
class DOPlgAccesscheckPrepareroute extends DOPlugin
{
	public function Trigger($mca = null)
	{
		$interface = DORouter::GetPageIndex();
		if(in_array(DORouter::GetModule(),array('debug','install'))) return;
		$permission = M('permission')->GetRow(array("url_pattern"=>$interface));
		
		//if we need to check permission for login user
		if(isset($permission->module_id) and isset($permission->operation_id) ):
			$sess = DOFactory::GetSession();
			$permissions = $sess->Get("permissions");
			if(!in_array($interface,$permissions)):
				DOUri::redirect(Url("debug/index/nopermission"),null,0);
				exit();
			endif;
		endif;
	}
}