<?php
class DOControllerIndex extends DOController
{
	public function checkAction($request=null)
	{
		$vars['phprelative'] 		= $this->getPhpRelative();
		$vars['serverrelative']		= $this->getServerRelative();
		$this->Display(null,$vars);
	}
	public function getPhpRelative()
	{
		$envs 	= array();
		$version  	= phpversion();
		$envs[] 	= array(
			'item' 	=> L("PHP version > 5.3"),
			"value"	=> $version,
			"class"	=> (version_compare($version, "5.3.0") > 0) ? "success" : "fail"
		);
		$pdo 		= class_exists('PDO');
		$envs[]	= array(
			'item'		=> L("Pdo library installation"),
			'value'	=>  $pdo ? 'Yes' : 'No',
			'class'	=>  $pdo ? "success" : "fail"
		);
		$gpc = get_magic_quotes_gpc();
		$envs[]	= array(
			'item'		=> L("Gpc quote turn off"),
			'value'	=> !$gpc ? 'Yes' : 'No',
			'class'	=> !$gpc ? "success" : "fail"
		);
		return $envs;
	}

	public function getServerRelative()
	{
		$envs 	= array();
		$pathinfo   = array_key_exists('PATH_INFO', $_SERVER);
		$envs[]	= array(
			'item'		=> L("Path info supported"),
			'value'	=>  $pathinfo ? 'Yes' : 'No',
			'class'	=>  $pathinfo ? "success" : "fail"
		);
		return $envs;
	}

	/** --- datbase configuration --**/
	public function databaseAction($request = null)
	{
		$this->Display(null);
	}

	public function savedbsettingAction($request = null)
	{
		$fh = DOFactory::GetFileHandler();
		$dbCfgStoreFile = dirname(__FILE__)."/assets/dbcfg.json";
		if(!$fh->Exist($dbCfgStoreFile)):
			$fh->MakeFile($dbCfgStoreFile);
		endif;
		$fh->Store($dbCfgStoreFile,json_encode($request->post));

	}
	/** -- system configuration --**/
	public function systemAction($request = null)
	{
		$this->Display(null);
	}
}
?>