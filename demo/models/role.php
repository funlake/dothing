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
	public function __construct()
	{
		$this->fields = array(
			'id'		=> true
		   ,'name'	=> true
		);
		$this->name   = 'role';
		$this->pk     = 'id';
	}
}