<?php
namespace Dothing\Lib;
use \Dothing\Lib\Blocks;
use \Dothing\Lib\Template;
use \Dothing\Lib\Factory;
class BlocksItem
{
	public function Display($tpl = 'default')
	{
		$blocks 	= Blocks::GetBlocks();
		$current	= strtolower(str_replace('DOBlocks','',get_class($this)));
		if(!empty($blocks[$current]))
		{
			$vFile  = $blocks[$current];
			$tFile = str_replace(array("/blocks/","/layout/"),array("/templates/".Template::GetTemplate()."/views/blocks/","/"),$vFile);
			//if template cover view exists
			if(file_exists($tFile))
			{
				$vFile = $tFile;
			}
			$view 	= basename($vFile);
			$cFile  = VIEWBASE.DS.'blocks'.DS.$current.DS.$view;
			$variables = array();
			if(DO_TEMPLATE_PARSE /*and !file_exists($cFile)*/)
			{//parse the content ,and store it into compile dir
				$content 		= Template::ParseHtml($vFile,$variables);
				$fileHandler	= new \Dothing\Lib\File\Basic();
				$fileHandler->Store($cFile,$content);
			}
			include $cFile;
		}
		else
		{
			throw new \Dothing\Lib\Exception("Unknown blocks:[{$current}]", 404);
		}
		return true;
	}
}