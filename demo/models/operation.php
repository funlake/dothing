<?php
namespace Application\Models;
/**
**@project:/var/www/dothing
**@whytodo:
**@author:Lake
**/
class Operation extends \Dothing\Lib\Model
{
	// public $connection = array(
	// 	"#_role" => "id:role_id"
	// );
	public $name = "operation";
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
		   ,'name'	=> true
		   ,'state'   => false
		   ,'ordering' => false
		   ,'description' => false

		);
		$this->name   = 'operation';
		$this->pk     = 'id';
		parent::__construct();
	}
}