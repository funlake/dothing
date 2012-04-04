<?php
interface DORecord 
{
	public function GetAll();
	public function GetOne($field);
	public function GetRow();
	public function GetCol();
}

?>
