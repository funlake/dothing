<?php 
class DOBlocksItem
{
	public function Display($tpl = 'default')
	{
		$blocks 	= DOBlocks::GetBlocks();
		$current	= strtolower(str_replace('DOBlocks','',get_class($this)));
		if(!empty($blocks[$current]))
		{
			$vFile  = $blocks[$current];
			$view 	= basename($vFile);
			$cFile  = VIEWBASE.DS.'blocks'.DS.$current.DS.$view;
			$variables = array();
			if(DO_TEMPLATE_PARSE /*and !file_exists($cFile)*/)
			{//parse the content ,and store it into compile dir
				$content 		= DOTemplate::ParseHtml($vFile,$variables);
				$fileHandler	= DOFactory::GetTool('file.basic');
				$fileHandler->Store($cFile,$content);
			}
			include $cFile;
		}
		else
		{
			throw new DORouterException("Unknown blocks:[{$current}]", 404);
		}
		return true;
	}
}