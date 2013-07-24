<?php
/**
**@project:/var/www/dothing
**@whytodo:
**@author:Lake
**/
class DOModelMember extends DOModel
{
	public $connections = array(
		"#__role" => array("id"=>"role_id")
	);
	public function __construct()
	{
		$this->fields = array(
			'user_id'		=> true
		   ,'role_id'		=> true
		   ,'member_name'	=> true
		);
		$this->updateKey = array(
			'user_id' => '=?'
		);
		$this->name   = 'member';
		$this->pk     = 'member_id';
	}
}