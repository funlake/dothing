<?php
/**
**@project:/var/www/dothing
**@whytodo:
**@author:Lake
**/
class DOModelModule extends DOModel
{
	public function __construct()
	{
		$this->fields = array(
			'id'		=> true
		   ,'name'	    => true
		   ,'interface'  => true
		   ,'icon'		=> false
		   ,'url'		=> true
		   ,'iscore'=> true
		   ,'ordering' => false
		   ,'state'    => false
		);
		$this->updateKey = array(
			'id' => '=?'
		);
		$this->name   = 'module';
		$this->pk     = 'id';
		parent::__construct();
	}

	public function Find($where=null)
	{
		$result = parent::Find($where);
		foreach($result as &$rs)
		{
			$rs->admin_title_class = $rs->iscore  ? 'panel-primary' : 'panel-info';
		}

		return $result;
	}
}