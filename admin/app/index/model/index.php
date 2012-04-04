<?php
class DOModel_index extends DOModel 
{
	function DOModel_index()
	{
		$this->tbl = parent::initTable(
			 array('cottage'			,'cottage_id')
	   		,array('cottage_period'	,'cottage_period_id')
		);
	}
	
	function getCottage()
	{
		return $this->table('cottage')->totalRow();
	}
}
?>