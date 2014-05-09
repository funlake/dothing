<?php
namespace Dothing\Lib;
use \Dothing\Lib\Router;
use \Dothing\Lib\Template;
use \Dothing\Lib\Factory;
class View
{
	public $controller = null;

	public function DOView()
	{
		$this->controller = DOController::GetController();
	}
	public function Grid($config)
	{

	}
	public function Tree($config)
	{

	}
	public function MenuList($config)
	{

	}
	public function GridTree($config)
	{

	}
	public function TableList($config)
	{
		
	}
	public function SetTplRoot($dir)
	{
		$this->tplBase = $dir;
	}

	public function Display($vFile,$variables = array())
	{
		$view 	= basename($vFile);
		$cFile = VIEWBASE.DS.'modules'.DS.Router::GetModule().DS.Router::GetController().DS.$view;
		if(!empty($variables))
		{
			extract($variables);
		}
		ob_start();
		//if template cover view exists
		$tFile = TEMPLATE_ROOT."/".Template::GetTemplate()."/views/modules/".Router::GetModule()."/".Router::GetController()."/".$view;
		if(file_exists($tFile))
		{
			$vFile = $tFile;
		}
		include $vFile;
		$content = ob_get_clean();
		if(DO_TEMPLATE_PARSE /*AND !file_exists($cFile)*/)
		{//parse the content ,and store it into compile dir
			//$content 		= Template::ParseHtml($vFile,$variables);
			$content		= Template::Parse($content,null,$variables);
			$fileHandler		= Factory::GetFileHandler();
			$fileHandler->Store($cFile,$content);
		}
		include $cFile;

	}

	public function C()
	{
		return $this->controller;
	}
}
?>