<?php
class DOModelUser extends DOModel
{
	public $fields = array(
		'@id'  => true,
		'user_name'	=> 'VARCHAR(100)',
		'user_pass'	=> 'VARCHAR(32)',
		'img_url'   => 'no-image.png',
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
/*		'has_one' => array(
			'#__userinfo' => array('id')
		)*/
	   // 'has_one'=> array(
	   // 		'#__member' => array('id')
	   // 	),
	   // '#__member' => array("user_id" => "id")
	);
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
		if(0 !=  $this->GetOne('id',array('user_name'=>'=?'),array($value)) )
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
