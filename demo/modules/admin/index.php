<?php
class DOControllerIndex extends DOController
{
	public function __construct()
	{
		parent::__construct();
	}
	public function indexAction()
	{
		$array = DOFactory::GetModel('#__group')->Find();
		$tree   = DOFactory::GetWidget('tree','default',array($array));
		$tpl     = <<<EOD
		<h1>[prefix]{#name}</h1>
EOD;
		echo $tree->Render($tpl);
	}

	public function settingAction()
	{
		$string="Hi! [num:0] with [num:1]";
		$array=array();
		$array[0]=array('name'=>"na");
		$array[1]=array('name'=>"nam");
		echo preg_replace('#(\!)?\s+\[num:(\d+)\]#ie','isset($array[\2]) ? "\1 ".$array[\2]["name"] : " "',$string);
	}

	public function loginAction($request = null)
	{
		$this->Display(null);exit;
	}

	public function searchAction($request)
	{
		
	}
}
?>
