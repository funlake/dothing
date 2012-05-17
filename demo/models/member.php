<?php
class DOModelMember extends DOModel
{
	public function __construct()
	{
		$this->fields = array();
		$this->pk     = 'member_id';
	}

	/***
	*** implements listener
	***/

	public function Event_afteradduser($ins,$params)
	{
		throw new DOException("I'm bad guy", 1);
	}
}

?>