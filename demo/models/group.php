<?php
namespace Application\Models;
use \Dothing\Lib\Factory;
//view model
class Group extends \Dothing\Lib\Model
{
	public $name = "#__group";
	public $fields = array(
		'@id'  => true,
		'pid'   => true,
		'name' => 'VARCHAR(100)',
		'ordering'	 => 'VARCHAR(32)',
		'description'=> true,
		'state'		 => '1'
	);
	public $defaultOrderby = array(
		'ordering' => 'DESC'
	);

	public $defaultGroupby = null;
	/** What to be where conditions when we update a record **/
	public $updateKey = array(
		'id'	=> '=?'		
	);
	public $updateVal = 0;

	/** What to be where conditions when we update a record **/
	public $deleteKey = array(
		'id'	=> '=?'
	);
	public $error_msg  = '';

	public $connections = array(
	);
	public function __construct()
	{
		/** Parse fields **/
		//$this->fields = include TABLEBASE.DS.'table_user.php';
		/** Set primary key **/
		$this->pk	  = 'id';


		/** Set name,parent call**/
		parent::__construct();
	}	
	public function GroupRoleList($id='')
	{
		$db = Factory::GetDatabase();
		$db->Clean();
		$where = array();
		if(!empty($id))
		{
			$where['g.id'] = '='.$id;
		}
		if(!empty($_REQUEST['DO']['search']['name']))
		{
			$where['g.name'] = "like '%".$_REQUEST['DO']['search']['name']."%'";
		}
		$sql = $db->From('#__group','g','SQL_CALC_FOUND_ROWS g.*')
                   	->LeftJoin('#__group_role'
	                          ,'gr'
	                          ,array('gr.group_id'=>'g.id')
                    	)
                   	->LeftJoin('#__role','r',array('r.id'=>'gr.role_id'),'group_concat(r.name) as `role`,group_concat(r.id) as role_id')
                   	->Orderby(isset($_REQUEST['_doorder']) ? $_REQUEST['_doorder'] : "" ,isset($_REQUEST['_dosort']) ? $_REQUEST['_dosort'] : "" )
                   	->Limit($this->defaultLimit)
                   	->Where($where)
                   	->Groupby('g.id')
                   	->Read();

		return $db->GetAll();
	}
	/** make the recored to be a tree structure array**/
	public function TreeData()
	{
		$this->defaultLimit = array(0,10000);
		$data = $this->GroupRoleList();
		$tree   = Factory::GetWidget('tree','default',array($data));
		$tpl     = <<<EOD
		[prefix]{#name}
EOD;
		return $tree->FormatItem('name',$tpl);
	}
/** Add record **/
	public function Add(array $insArray = null)
	{
		$R = parent::Add($insArray);
		if($R->success)
		{
			foreach($insArray['role_id'] as $rid)
			{
				DOFactory::GetTable('#__group_role')->Insert(
					array(
						'group_id' => $R->insert_id,
						'role_id' => $rid
					)
				);
			}
		}
		return $R;
	}
	/** Update record **/
	public function Update(array $upArray = null)
	{
		$R = parent::Update($upArray);
		if($R->success)
		{
			Factory::GetTable('#__group_role')->Delete(array(
				"group_id" => "=?"
			),$upArray['id']);

			foreach($upArray['role_id'] as $rid)
			{
				Factory::GetTable('#__group_role')->Insert(
					array(
						'group_id' => $upArray['id'],
						'role_id'  => $rid
					)
				);				
			}

		}
		return $R;
	}
	public function Delete(array $params = null)
	{
		$R = $this->GetRow(array("pid"=>'=?'),$params['id']);
		if($R->id){
			$this->error_msg = L("Can not delete a group which having some sub groups");
			return false;
		}
		else return parent::Delete($params);
	}
	/** Keep unique user name **/
	public function Add_validate_name($value)
	{
		if(0 !=  $this->GetOne('id',array('name'=>'=?'),$value) )
		{
			$this->error_msg = DOLang::Get('Do not allow duplicated groups!');
			return false;
		}
		return true;
	}
	/** What shall we do before saving a new record**/
	public function Add_pre_validate( $posts )
	{
		$flag = true;
		if(empty($posts['name']))
		{
			$this->error_msg  = DOLang::Get('Empty Group name');
			$flag 		 	  = false;
		}
		return $flag;
	}
	/** What shall we do before saving a new record**/
	public function Update_pre_validate( $posts )
	{
		return $this->Add_pre_validate($posts);
	}
	public function Update_validate_name($value,$posts)
	{
		if(0 !=  $this->GetOne('id','name=? and id<>?',array($value,$posts['id'])) )
		{
			$this->error_msg  = DOLang::Get('Do not allow duplicated groups!');
			return false;
		}
		return true;
	}
}

?>
