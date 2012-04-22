<?php
class DOModelUser extends DOModel
{
	public $fields;
	public $updatekey = array(
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
}

?>
