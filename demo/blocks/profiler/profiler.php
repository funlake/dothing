<?php
class DOBlocksProfiler extends DOBlocksItem
{
	public function __construct()
	{
		$this->items = array(
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
				'content' => $this->GetErrors('','sqlquery')
			),
			array(
				'tab'  => L('Sql queries'),
				'id'   => 'sql_tab',
				'class' => '',
				'content' => $this->GetSqlQueries()
			),
			array(
				'tab'  => L('Tests'),
				'id'   => 'tests_tab',
				'class' => '',
				'content' => $this->GetTests()
			)
		);
	}
	public function GetProfiler()
	{
		return $this->items;
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
	public function GetErrors($specific='',$ignore='')
	{
		$errors 	= DOError::$_errorMsg;
		$errs 		= array();  
		foreach((array)$errors as $key => $value)
		{
			$errType = explode('_',$key);
			if($errType[1] == $ignore) continue;
			elseif(!empty($specific) and $errType[1] != $specific)
			{
				continue;
			}
			foreach($value as $v2)
			{
				$class = '';
				$v 	 = ucwords($errType[1]);
				if($v2['detail'])
				{
					$v = $v2['detail'];
				}
				switch($v) :
					case 'Error' 		: $class = 'danger';break;
					case 'Warning' 	: $class = 'warning';break;
					case 'Strict'		: $class = 'warning';break;
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

	public function GetTests()
	{
		$testFile 		= SYSTEM_ROOT.'/tests/'.DORouter::GetModule().'/'.DORouter::GetController().'_'.DORouter::GetAction().'.php';
		$testsContent 	= '';
		$tests 		= array();
		if(file_exists($testFile))
		{
			ob_start();
			include $testFile;
			//ob_end_clean();
			$testsContent = ob_get_clean();
			//print_r($GLOBALS);
		}
		if(!empty($testsContent))
		{
			preg_match_all('#(Pass|Fail)\s*:\s*(.*?)\s+at\s+\[([^\[\]]+)\]#',$testsContent,$items);
			foreach((array)$items[1] as $key=>$val):
				$tests[] = array(
					"item" => $items[2][$key],
					"file"  => $items[3][$key],
					"value"=> $val,
					"class" => ($val == "Fail" ? "danger" : "")
				);
			endforeach;
		}
		return $tests;
	}

	public function GetSqlQueries()
	{
		return $this->GetErrors('sqlquery');
	}
}

?>
