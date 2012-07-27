<?php
!defined('DO_ACCESS') AND DIE("Go Away!");
class DOControllerSystem extends DOController
{
	public function settingAction($request = null)
	{
		$M 		= DOFactory::GetModel("#__setting");
		$data	= $M->Find(array(
				'status' => array('0','>')
			)
		);
		foreach((array)$data as $setting)
		{
			$var['setting'][$setting->constant] = $setting->value;
		}
		$this->Display(null,$var);
	}

	public function savesettingAction($request = null)
	{
		$post = $request->post;
		if(!!$post)
		{
			$db = DOFactory::GetDatabase();
			foreach((array)$post as $key=>$value)
			{
				if(strpos($key,"S_") === 0)
				{
					$vals[] = "('".substr($key,2)."','".$value."','1')";
				}
			}
			$db->SetQuery("REPLACE INTO #__setting "
						 ."(constant,value,status) "
						 ."VALUES"
						 .implode(',',$vals) 
			);
			$model = $msg = DOFactory::GetModel('#__setting');
			if($db->Execute())
			{
				$msg 	= $model->addMsgSuccess;
				$flag	= 1;
			}
			else
			{
				$msg 	= $model->updateMsgFail;
				$flag	= 0;
			}
			$db->Clean();
			DOUri::Redirect(
				DOUri::BuildQuery(DO_ADMIN_INTERFACE,'system','setting')
			   ,$msg
			   ,$flag
			);
		}
	}
}