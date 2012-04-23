<?php
class DOModelUser extends DOModel
{
	public $fields;
	/** What to be where conditions when we update a record **/
	public $updatekey = array(
		'user_id'	=> '=?'		
	);
	/** What to be where conditions when we update a record **/
	public $deletekey = array(
		'user_id'	=> '=?'
	);
	public function __construct()
	{
		/** Parse fields **/
		$this->fields = include TABLEBASE.DS.'table_user.php';
		/** Set primary key **/
		$this->pk	  = 'user_id';
		/** Set name,parent call**/
		parent::__construct();
	}	
	/** Md5 serialize **/	
	public function __adjust_user_pass($value)
	{
		return md5($value);
	}
}

?>
