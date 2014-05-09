<?php
namespace Application\Models;
/**
**@project:/var/www/dothing
**@whytodo:
**@author:Lake
**/
use \Dothing\Lib\Factory;
class Status extends \Dothing\Lib\Model
{
	public function __construct()
	{
		parent::__construct();
	}

	public function Update(array $uparray = null)
	{
		$key = $uparray['_k'] ?: 'id';
		$res = new \stdClass();
		$res->success = 1;
		 $db = Factory::GetDatabase();
		 $db->SetQuery("update `{$uparray['_m']}` set state=1-state where `{$key}`='{$uparray['_v']}'");
		if(!$db->Execute())
		{
			$res->success = 0;
			$this->updateMsgFail = "Could not found table '{$uparray['_m']}' or cound not found key '{$key}'";
		}
		return $res;
	}
}