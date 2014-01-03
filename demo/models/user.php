<?php
class DOModelUser extends DOModel
{
	public $fields = array(
		'@id'  		=> true,
		'user_name'		=> 'VARCHAR(100)',
		'user_pass'		=> 'VARCHAR(32)',
		'img_url'   		=> 'no-image.png',
		'state'		=> '1'
	);
	public $maps = array(
		'images'	=> 'img_url'
	);
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
		'#__user_group' => array('user_id' => 'id','group_id'=>'group_id')
/*		'has_one' => array(
			'#__userinfo' => array('id')
		)*/
	   // 'has_one'=> array(
	   // 		'#__member' => array('id')
	   // 	),
	   // '#__member' => array("user_id" => "id")
	);
	public function UserGroupList($id='')
	{
		$db = DOFactory::GetDatabase();
		$db->Clean();
		$where = array();
		if(!empty($id))
		{
			$where['u.id'] = '='.$id;
		}
		if(!empty($_REQUEST['DO']['search']['user_name']))
		{
			$where['u.user_name'] = "like '%".$_REQUEST['DO']['search']['user_name']."%'";
		}
		$db->From('#__user','u','SQL_CALC_FOUND_ROWS u.*')
                   	->LeftJoin('#__user_group'
                          ,'ug'
                          ,array('ug.user_id'=>'u.id')
                     )
                   	->LeftJoin('#__group','g',array('g.id'=>'ug.group_id'),'group_concat(distinct g.name) as `group`,group_concat(distinct g.id) as group_id')
                   	->LeftJoin('#__user_role','ur',array('ur.user_id'=>'u.id'))
                   	->LeftJoin('#__role','r',array('r.id'=>'ur.role_id'),'group_concat(distinct r.name) as `role`,group_concat(distinct r.id) as role_id')
                   	->Orderby(isset($_REQUEST['_doorder']) ? $_REQUEST['_doorder'] : "" ,isset($_REQUEST['_dosort']) ? $_REQUEST['_dosort'] : "" )
                   	->Limit($this->defaultLimit)
                   	->Where($where)
                   	->Groupby('u.id')
                   	->Read();
		$rs =  $db->GetAll();
		$this->SetTotal();
		return $rs;
	}
	/** Add record **/
	public function Add(array $insArray = null)
	{
		$R = parent::Add($insArray);
		//one use may in several group or belong to several roles.
		if($R->success)
		{
			foreach($insArray['group_id'] as $gid)
			{
				DOFactory::GetTable('#__user_group')->Insert(
					array(
						'user_id' => $R->insert_id,
						'group_id' => $gid
					)
				);
			}
			foreach($insArray['role_id'] as $rid)
			{
				DOFactory::GetTable('#__user_role')->Insert(
					array(
						'user_id' => $R->insert_id,
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
			DOFactory::GetTable('#__user_group')->Delete(array(
				"user_id" => "=?"
			),$upArray['id']);
			foreach($upArray['group_id'] as $gid)
			{
				DOFactory::GetTable('#__user_group')->Insert(
					array(
						'group_id' => $gid,
						'user_id'  => $upArray['id']
					)
				);				
			}
			DOFactory::GetTable('#__user_role')->Delete(array(
				"user_id" => "=?"
			),$upArray['id']);

			foreach($upArray['role_id'] as $rid)
			{
				DOFactory::GetTable('#__user_role')->Insert(
					array(
						'user_id' => $upArray['id'],
						'role_id' => $rid
					)
				);
			}

		}
		return $R;
	}
	/** Delete record **/
	public function Delete(array $posts = null)
	{
		$R = parent::Delete($posts);
		if($R->success)
		{
			DOFactory::GetTable('#__user_group')->Delete(array(
				"user_id" => "=?"
			),$posts['id']);
		}
		return $R;
	}
	//public $defaultLimit = array(0,5);
	public function __construct()
	{
		/** Parse fields **/
		//$this->fields = include TABLEBASE.DS.'table_user.php';
		/** Set primary key **/
		$this->pk	  = 'id';
		/** Set name,parent call**/
		parent::__construct();
	}	
	public function Add_pre_adjust($post)
	{
		//return trim($value);
	}
	/** Md5 serialize **/	
	public function Add_adjust_user_pass($value)
	{
		$T = DOFactory::GetTool("encrypt");
		return $T->Encrypt($value);
		//return md5($value);
	}
	/** Keep unique user name **/
	public function Add_validate_user_name($value)
	{
		if(0 !=  $this->GetOne('id',array('user_name'=>'=?'),$value) )
		{
			$this->error_msg = DOLang::Get('Do not allow duplicated users!');
			return false;
		}
		return true;
	}
	/** What shall we do before saving a new record**/
	public function Add_pre_validate( $posts )
	{
		$flag = true;
		if(empty($posts['user_name']))
		{
			$this->error_msg  = DOLang::Get('Empty user name');
			$flag 		 	  = false;
		}
		if(empty($posts['user_pass']))
		{
			$this->error_msg .= ' '.DOLang::Get('Empty user pass');
			$flag 		 	  = false;
		}
		return $flag;
	}
	/** What shall we do before saving a new record**/
	public function Update_pre_validate( $posts )
	{
		$flag = true;
		if(empty($posts['user_name']))
		{
			$this->error_msg  = DOLang::Get('Empty user name');
			$flag 		 	  = false;
		}
		// if(empty($posts['user_pass']))
		// {
		// 	$this->error_msg .= ' '.DOLang::Get('Empty user pass');
		// 	$flag 		 	  = false;
		// }
		return $flag;
	}
	public function Update_validate_user_name($value,$posts)
	{
		if(0 !=  $this->GetOne('id','user_name=? and id<>?',array($value,$posts['id'])) )
		{
			$this->error_msg  = DOLang::Get('Do not allow duplicated users!');
			return false;
		}
		return true;
	}

	public function Update_adjust_user_pass($value,$posts)
	{
		if($posts['pass_edited'])
		{
			return md5($value);
		}
		return $value;
	}

	public function Add_adjust_img_url($files,$posts)
	{
		return basename($files['name']);
	}

	public function Update_pre_adjust($posts)
	{
		unset($this->fields['user_pass']);
	}
}
?>
