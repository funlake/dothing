<?php 
class DOBlocksItem
{
	public function Display($tpl = 'default')
	{
		$blocks 	= DOBlocks::GetBlocks();
		$current	= strtolower(str_replace('DOBlocks','',get_class($this)));
		if(!empty($blocks[$current]))
		{
			include_once $blocks[$current].DS.'layout'.DS.$tpl.'.php';
		}
		else
		{
			throw new DORouterException("Unknown blocks:[{$current}]", 404);
		}
		//include_once dirname(__FILE__).DS.'layout'.DS.$tpl.'.php';
	}
}