<?php
/**
**@project:/var/www/dothing
**@whytodo:
**@author:Lake
**/

class DOModelRolepermission extends DOModel
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
		   'role_id'			=> true
		   ,'permission_id'		=> true
		   ,'operation_id'   	=> true

		);
		$this->name   = 'role_permission';
		$this->pk     = null;
		parent::__construct();
	}

	public function Add(array $data = null)
	{
		$db = DOFactory::GetDatabase();
		$db->Query("delete from #__role_permission where role_id=".(int)$data['role_id']);
		$values = array();
		foreach($data['action'] as $mk=>$mo) :
			list($mid,$oid) = explode("_",$mo);
			$values[] = "(".(int)$data['role_id'].",".(int)$mid.",".(int)$oid.")";
		endforeach;

		if(!empty($values)):
			$db->Query("insert into #__role_permission (role_id,module_id,operation_id) values ".implode(",",$values));
		endif;

		DOUri::Redirect(Url(DO_ADMIN_INTERFACE.'/user/rolepermission','id='.$data['role_id']),DOLang::Get('Permissions were assinged successfully'),1);
		return true;
	}
	public function GetOperationPermission($moduleId,$roleId)
	{
		$final = array();
		$db = DOFactory::GetDatabase();
		$db->Clean();
		//get parent role
		$role = M('role')->GetRow(array('id'=>'='.$roleId));

		$db->Clean();
		$db->From("#__permission","p","p.*")
		->Innerjoin("#__operation","o","o.id=p.operation_id");
		//We must inherit what permissions parent role has.
		if($role->pid != 0):
			$db->Innerjoin("#__role_permission","rp","rp.operation_id=o.id and rp.module_id=".(int)$moduleId." and rp.role_id=".$role->pid);
		endif;
		$sql = $db->Select("o.name as oname,o.id as oid")
		->Where("p.state=1 and p.module_id=?")
		->Values($moduleId)
		->Read();
		$rs = $db->GetAll();
		//reconstruct the reocrds,make it easily to access on [#1] proecess
		foreach($rs as $item):
			$final[$item->module_id."_".$item->operation_id] = $item;
		endforeach;

		$db->Clean();
		$db->From("#__role_permission")
		->Select("*")
		->Where("module_id=? and role_id=?")
		->Values($moduleId,$roleId)
		->Read();
		$rs = $db->GetAll();
		//found some assigned permission
		foreach($rs as $item):
			if(isset($final[$item->module_id."_".$item->operation_id])):
				#1
				$final[$item->module_id."_".$item->operation_id]->checked = "checked";
			endif;
		endforeach;
		return $final;
	}
}