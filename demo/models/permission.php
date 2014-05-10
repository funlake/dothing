<?php
namespace Application\Models;
/**
**@project:/var/www/dothing
**@whytodo:
**@author:Lake
**/

class Permission extends \Dothing\Lib\Model
{
	// public $connection = array(
	// 	"#_role" => "id:role_id"
	// );
	public $defaultOrderby = array(
		'ordering' => 'DESC'
	);
	public $updateKey = array(
		'id'	=> '=?'		
	);
	public $updateVal = 0;

	/** What to be where conditions when we update a record **/
	public $deleteKey = array(
		'id'	=> '=?'
	);
	public function __construct()
	{
		$this->fields = array(
		     'id'		=> true
		   ,'module_id'	=> false
		   ,'operation_id'   	=> false
		   ,'url_pattern' 	=> false
		   ,'state' 		=> false

		);
		$this->name   = 'permission';
		$this->pk     = 'id';
		parent::__construct();
	}

	public function Update(array $data = null)
	{
		\Dothing\Lib\Factory::GetDatabase()->Query("truncate #__permission");
		$final = array();
		foreach($data['action'] as $mk=>$mo) :
			list($mid,$oid) = explode("_",$mo);
			$final[] = array(
				'module_id' 	=> $mid,
				'operation_id'	=> $oid,
				'url_pattern'	=> $data['action_interface'][$mo],
				'state'		=> 1
			);
		endforeach;

		foreach($final as $item):
			self::Add($item);
		endforeach;
		\Dothing\Lib\Uri::Redirect(Url('admin/user/permission'),L('Permissions were successfully saved'),1);
		return true;
	}

	public function GetOperationPermissionSetting($moduleId)
	{
		$db = \Dothing\Lib\Factory::GetDatabase();
		$db->Clean();
		$db->From("#__operation","o","o.id as oid,o.name as oname")
		->Where("o.state=1")
		->Read();

		$operations = $db->GetAll();

		$db->Clean();
		$db->From("#__permission","p","p.*")
		->Where("p.state=1")
		->Read();

		$permissions = $db->GetAll();
		
		$pers = array();

		foreach($permissions as $per):
			$pers[$per->module_id."_".$per->operation_id] = $per;
		endforeach;

		$final = array();
		foreach($operations as $op):
			//if we have already set something for it
			if(isset($pers[$moduleId."_".$op->oid]))
			{
				$obj = $pers[$moduleId."_".$op->oid];
				$obj->checked = "checked";
				$final[] = (object)array_merge((array)$obj,(array)$op);
			}
			else
			{
				$final[] = $op;
			}

		endforeach;

		return $final;
	}
}