<?php
/**
**@project:/var/www/dothing
**@whytodo:
**@author:Lake
**/
class DOModelRole extends DOModel
{
	// public $connection = array(
	// 	"#_role" => "id:role_id"
	// );
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
		   ,'name'	=> true
		   ,'state'   => false
		);
		$this->name   = 'role';
		$this->pk     = 'id';
		parent::__construct();
	}
}