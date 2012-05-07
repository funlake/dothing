<?php
class DOModelUser extends DOModel
{
	public $fields;
	public $maps;
	/** What to be where conditions when we update a record **/
	public $updatekey = array(
		'user_id'	=> '=?'		
	);
	/** What to be where conditions when we update a record **/
	public $deletekey = array(
		'user_id'	=> '=?'
	);

	public $error_msg  = '';
	public function __construct()
	{
		/** Parse fields **/
		$this->fields = include TABLEBASE.DS.'table_user.php';
		/** Set primary key **/
		$this->pk	  = 'user_id';
		/** Set name,parent call**/
		parent::__construct();
	}	
	public function add_adjust_DOALL($value)
	{
		return trim($value);
	}
	/** Md5 serialize **/	
	public function add_adjust_user_pass($value)
	{
		return md5($value);
	}
	/** Keep unique user name **/
	public function add_validate_user_name($value)
	{
		if(0 !==  $this->GetOne('user_id',array('user_name'=>'=?'),$value) )
		{
			$this->error_msg = DOLang::Get('Do not allow multiple users!');
			return false;
		}
		return true;
	}
	/** What shall we do before saving a new record**/
	public function add_pre_validate( $posts )
	{
		$flag = true;
		if(empty($posts['user_name']))
		{
			$this->error_msg = DOLang::Get('Empty user name');
			$flag 		 = false;
		}
		if(empty($posts['user_pass']))
		{
			$this->error_msg .= ' '.DOLang::Get('Empty user pass');
			$flag 		 = false;
		}
		return $flag;
	}
}

?>
