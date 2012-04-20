<?php
class DOPlgSetDefine
{
	public function beforeRoute()
	{
		if(!defined('TEMPLATE'))
		{
			$db = & DOFactory::get('dbo');
			$db->Clean();
			$db->From('#__template')
			   ->Select('template_name')
			   ->Where('`default`','=?')
			   ->Params(1)
			   ->Read();
			$template = $db->GetOne();
			define('TEMPLATE',$template ? $template : 'default');
		}
		$uriParse = DOUri::parse();
		if(!defined('M'))
		{
			#module define
			define('MOD',$uriParse['module']);
			#controller define
			define('CTR',$uriParse['controller']);
			#action define
			define('ACT',$uriParse['action']);
			#params
			define('GPC',json_encode($uriParse['params']));
		}
	}

	public function afterRoute()
	{
		
	}
}
?>
