<?php
class DOModelGroup extends DOModel
{
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
	/** make the recored to be a tree structure array**/
	public function TreeData()
	{
		$data = $this->Find();
		
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
		if(0 !=  $this->GetOne('id','name=? and id<>?',$value,$posts['id']) )
		{
			$this->error_msg  = DOLang::Get('Do not allow duplicated groups!');
			return false;
		}
		return true;
	}
}

?>
