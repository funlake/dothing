<?php
class DOBlocksWizard extends DOBlocksItem
{
	public function GetInstallWizard()
	{
		$action = DORouter::GetAction();
		return array(
			1=>array(
				'link'		=> '',
				'class'	=> $action == "check" ? 'current' : '',
				"title"		=> L("Enviroment overview")
			),
			array(
				'link'		=> '',
				'class'	=> $action == "database" ? 'current' : '',
				'title'		=> L("Database configuration")
			),
			array(
				'link'		=> '',
				'class'	=> $action == "system" ? 'current' : '',
				'title'		=> L("System configuration")
			)
		);
	}
}

?>
