<?php
class hookLogin extends DOHook  
{
	function onBeforeaction()
	{

		$arg 	= func_get_args();
		
		parent::set( 'hookpath',dirname(__FILE__) );
		
		//login
		if( !$_SESSION['s_user']['user_id'] )
		{
			//login hanlder
			if( $_POST )
			{
				switch($_POST['task'])
				{
					case 'login' : 
						$User		= & DOModel::load('user');
						$username	= DORequest::safeSql( $_POST['user'] );
						$userpass   = DORequest::safeSql( $_POST['pass'] );
						$res   		= $User->checkExist( $username , $userpass);
						if ( !!$res )
						{
							$_SESSION['s_user'] 				= $res;
							#$Usergroup 							= & DOModel::load('user_group');
							#$_SESSION['s_user']['user_group']	= $Usergroup->getGroups($res['user_id']); 
							echo "{flag:'1',fn:'location.href=location.href;'}";
						}
						else 
						{
							
							echo "{flag:'0',msg:'错误的用户名或密码'}";
						}
					break;
				}
			}
			else
			{
				//echo md5(123456);
				parent::loadHookView('hook_login.html');
			}
			exit();
		}
		//logout
		else 
		{
			if($_POST && $_POST['task'] == 'logout')
			{
				DOSession::clean();
				echo "{flag:'2',msg:'您已成功注销',fn:'location.href=location.href;'}";
				exit();
			}
			return true;
		}
	}
}
?>
