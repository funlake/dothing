<?php
namespace Application\Modules\Admin;
class Dashboard extends \Dothing\Lib\Controller
{
	public function indexAction()
	{
		echo "welcome";
	}

	public function settingAction($request = null)
	{
		$M 		= \Dothing\Lib\Factory::GetModel("#__setting");
		$data	= $M->Select(array(
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
			$db = \Dothing\Lib\Factory::GetDatabase();
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
			$model = $msg = \Dothing\Lib\Factory::GetModel('#__setting');
			if($db->Execute())
			{
				$msg 	= $model->updateMsgSuccess;
				$flag	= 1;
			}
			else
			{
				$msg 	= $model->updateMsgFail;
				$flag	= 0;
			}
			$db->Clean();
			\Dothing\Lib\Uri::Redirect(
				Url('admin/dashboard/setting')
			   ,$msg
			   ,$flag
			);
		}
	}
}