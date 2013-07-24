<?php
class DOBlocksProfiler extends DOBlocksItem
{
	public function GetProfiler()
	{
		return array(
			array(
				'tab'  => L('Time'),
				'id'   => 'time_tab',
				'content' => DOProfiler::GetSpentTime('system')
			),
			array(
				'tab'  => L('Memory'),
				'id'   => 'mem_tab',
				'content' => "asdfdsf"
			)
		);
	}
}

?>
