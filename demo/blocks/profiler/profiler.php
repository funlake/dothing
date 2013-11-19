<?php
class DOBlocksProfiler extends DOBlocksItem
{
	public function GetProfiler()
	{
		return array(
			array(
				'tab'  => L('Time'),
				'id'   => 'time_tab',
				'class' => 'active',
				'content' => $this->GetTimes()
			),
			array(
				'tab'  => L('Memory'),
				'id'   => 'mem_tab',
				'class' => '',
				'content' => $this->GetMemory()
			),
			array(
				'tab'  => L('Error'),
				'id'   => 'error_tab',
				'class' => '',
				'content' => $this->GetErrors()
			)
		);
	}
	public function GetTimes()
	{
		$timer = array();
		
		foreach(DOProfiler::GetTimer() as $event=>$t):
			if($event == "Block:debug")  continue; 
			$class = '';
			list($type,$tag) = explode(':',$event,2);
			switch( $type ) :
				case 'Controller' 	: $class = 'danger'; break;
				case 'Block'		: $class = 'warning'; break; 
			endswitch;
			$timer[] = array(
				'item' 	=> $event."[".$t['ordering']."]",
				'file'		=> $t['file'],
				'value' 	=> $t['spent']."s",
				'class' 	=> $class
			);
		endforeach;
		return $timer;
	}
	public function GetMemory()
	{
		return  array(
			array(
				'item' => 'Prepare route',
				'file' 	 => '',
				'value' => '14k'
			)
		);
	}
	public function GetErrors()
	{
		$errors 	= DOError::$_errorMsg;
		$errs 		= array();  
		foreach((array)$errors as $key => $value)
		{
			$errType = explode('_',$key);
			//if($errType[1] == 'notice') continue;
			foreach($value as $v2)
			{
				$class = '';
				$v 	 = ucwords($errType[1]);

				switch($v) :
					case 'Error' 		: $class = 'danger';break;
					case 'Warning' 	: $class = 'warning';break;
					default 		: $class = '';break;
				endswitch;
				$errs[] = array(
					'item' => $v2['msg'],
					'file'	  => $v2['file']."(".$v2['line'].")",
					'value' => $v,
					'class' => $class
				);
			}
		}
		//array_multisort($errs,array('Error','Warning','Notice'),SORT_DESC);
		return $errs;
	}
}

?>
