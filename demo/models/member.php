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

	public function event_afteradduser($ins,$params)
	{
	}
}

?>