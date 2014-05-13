<?php
class DOBlocksWizard extends \Dothing\Lib\BlocksItem
{
	public function GetInstallWizard()
	{
		$action = \Dothing\Lib\Router::GetAction();
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
