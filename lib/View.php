<?php
class DOView
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
		//set if template cover view exists
		//$tFile = 
		$cFile = VIEWBASE.DS.'modules'.DS.DORouter::GetModule().DS.DORouter::GetController().DS.$view;
		if(!empty($variables))
		{
			extract($variables);
		}
		ob_start();
		include $vFile;
		$content = ob_get_clean();
		if(DO_TEMPLATE_PARSE /*AND !file_exists($cFile)*/)
		{//parse the content ,and store it into compile dir
			//$content 		= DOTemplate::ParseHtml($vFile,$variables);
			$content		= DOTemplate::Parse($content,null,$variables);
			$fileHandler		= DOFactory::GetFileHandler();
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