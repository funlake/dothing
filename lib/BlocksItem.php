<?php 
class DOBlocksItem
{
	public function Display($tpl = 'default')
	{
		$blocks 	= DOBlocks::GetBlocks();
		$current	= strtolower(str_replace('DOBlocks','',get_class($this)));
		if(!empty($blocks[$current]))
		{
			echo DOTemplate::ParseHtml($blocks[$current]);
			if($current == 'message')
			{
				$this->CleanMessage();
			}
		}
		else
		{
			throw new DORouterException("Unknown blocks:[{$current}]", 404);
		}
		return true;
	}
}