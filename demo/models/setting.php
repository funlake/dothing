<?php
namespace Application\Models;
/**
**@project:/var/www/dothing
**@whytodo:
**@author:Lake
**/
class Setting extends \Dothing\Lib\Model
{
	public function __construct()
	{
		$this->fields = array(
			'id'			=> true
		   ,'label'	    	=> true
		   ,'constant'  	=> true
		   ,'type'			=> true
		   ,'value'			=> true
		   ,'description'	=> true
		   ,'status'    	=> 1
		);
		$this->updateKey = array(
			'id' => '=?'
		);
		$this->name   = 'setting';
		$this->pk     = 'id';
		parent::__construct();
	}
}