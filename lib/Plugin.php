<?php
/**
** Plugin class
** @author lake
**/
class DOPlugin 
{
	public $params;
	public $behavior;
	public function __construct(){}
	/** Fire! **/
	public function Trigger()
	{
		$this->Display();
	}
	/** Each plugin may has it's own configuration**/
	public function SetConfig( Array $params = null )
	{
		$this->params = $params;
	}
	/** Some information about this plugin **/
	public function GetConfig()
	{

	}

	/** If this plugin need to display something,implements this **/
	public function Display()
	{

	}
}
?>