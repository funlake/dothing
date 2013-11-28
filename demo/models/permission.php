<?php
/**
**@project:/var/www/dothing
**@whytodo:
**@author:Lake
**/

class DOModelPermission extends DOModel
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

	public function Update($data = null)
	{
		DOFactory::GetDatabase()->Query("truncate #__permission");
		$final = array();
		foreach($data['action'] as $mk=>$mo) :
			list($mid,$oid) = explode("_",$mo);
			$final[] = array(
				'module_id' 		=> $mid,
				'operation_id'	=> $oid,
				'url_pattern'	=> $data['action_interface'][$mo],
				'state'		=> 1
			);
		endforeach;

		foreach($final as $item):
			self::Add($item);
		endforeach;
		DOUri::Redirect(Url(DO_ADMIN_INTERFACE.'/user/permission'),DOLang::Get('Permissions were successfully saved'),1);
		return true;
	}

	public function GetOperationPermission($moduleId = '')
	{
		$db = DOFactory::GetDatabase();
		$db->Clean();
		$db->From("#__operation","o","o.id as oid,o.name as oname")
		->LeftJoin("#__permission",'p',array(
			'p.operation_id' => 'o.id'
		))
		->Select("p.*")
		->Read();
		//echo "<pre/>";

		$rs = $db->GetAll();

		foreach($rs as $rk=>&$item):
			$item->checked = '';
			if( $item->module_id != $moduleId):
				foreach(get_object_vars($item) as $k=>$v):
					if($k != "oid" and $k != "oname") $item->$k = '';
				endforeach;
			elseif($item->module_id > 0) : 
				$item->checked = 'checked';
			endif;
		endforeach;
		return $rs;

	}
}