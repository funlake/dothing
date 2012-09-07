<?php
class DOModelSetting extends DOModel
{
	public $fields = array(
		'@id'  => true,
		'name'			=> 'VARCHAR(100)',
		'value'			=> 'TEXT',
		'constant'		=> 'VARCHAR(100)',
		'description'   => 'TEXT',
		'status'		=> '1'
	);
	public $maps = array(
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
	);
	public function __construct()
	{
		/** Parse fields **/
		//$this->fields = include TABLEBASE.DS.'table_user.php';
		/** Set primary key **/
		$this->pk	  = 'id';

		$this->addMsgSuccess 	= DOLang::Get('Configuration Done!');
		$this->updateMsgSuccess = DOLang::Get('You have successfully modify it');
		$this->updateMsgFail	= DOLang::Get('You failed to modify it');
		/** Set name,parent call**/
		parent::__construct();
	}
}

?>
