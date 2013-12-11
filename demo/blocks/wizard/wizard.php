<?php
class DOBlocksWizard extends DOBlocksItem
{
	public function GetInstallWizard()
	{
		return array(
			1=>array(
				'link'		=> '',
				'class'	=> 'current',
				"title"		=> "Enviroment overview"
			),
			array(
				'link'		=> '',
				'class'	=> '',
				'title'		=> "Database configuration"
			),
			array(
				'link'		=> '',
				'class'	=> '',
				'title'		=> "System configuration"
			)
		);
	}
}

?>
