<?php 
class DOBlocksItem
{
	public function Display($tpl = 'default')
	{
		$blocks 	= DOBlocks::GetBlocks();
		$current	= strtolower(str_replace('DOBlocks','',get_class($this)));
		if(!empty($blocks[$current]))
		{
			//if(TEMPLATEROOT.DS.DOTemplate::GetTemplate().DS.'')
			echo DOTemplate::ParseHtml($blocks[$current]);
		}
		else
		{
			throw new DORouterException("Unknown blocks:[{$current}]", 404);
		}
		//include_once dirname(__FILE__).DS.'layout'.DS.$tpl.'.php';
	}
}