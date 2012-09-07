<?php
/**
**@project:/var/www/dothing
**@whytodo:
**@author:Lake
**/
class DOModelMenu extends DOModel
{
	public function __construct()
	{
		$this->fields = array(
			'id'		=> true
		   ,'pid'       => '0'
		   ,'name'		=> true
		   ,'link'		=> true
		);
		$this->updateKey = array(
			'id' => '=?'
		);
		$this->pk     = 'id';
	}

	public function GetTopMenu()
	{
		return array(
		   array(
				'title' => DOLang::Get('Modules')
			   ,'link'  => DOUri::BuildQuery(DO_ADMIN_INTERFACE,"system","setting")
			   ,'icon'  => 'icon-menu-profile.png'
			)
		   ,array(
				'title' => DOLang::Get('Blocks')
						  ." <img class='pin' src='".DO_THEME_BASE."/_layout/images/back-nav-sub-pin.png'/>"
			   ,'link'  => DOUri::BuildQuery(DO_ADMIN_INTERFACE,"system","setting")
			   ,'icon'  => 'icon-menu-tasks.png'
			   ,'child' => array(
			   		array('title' => 'a','class'=>'first')
			   	   ,array('title' => 'b','class'=>'last')
			   	  // ,array('title' => '' ,'class'=>'pin')
			   	)
			)
		   ,array(
				'title' => DOLang::Get('Setting')
			   ,'link'  => DOUri::BuildQuery(DO_ADMIN_INTERFACE,"system","setting")
			   ,'icon'  => 'icon-menu-settings.png'
			)
		);
	}
}