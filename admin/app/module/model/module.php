<?php
class DOModel_module extends DOModel 
{
	public $name  = 'module';
	public $fields = array(
		'module_id'		=> '[0-9]+'
	   ,'module_pid'	=> '[0-9]+'
       ,'module_name'	=> '[a-zA-Z_\x7f-\xff][a-zA-Z0-9_\x7f-\xff]*'
       ,'module_code'   => '[a-zA-Z0-9_-]+'
       ,'module_icon'	=> '[a-zA-Z\.0-9_-]+'
	   ,'module_url'	=> '[\w,]+'
	   ,'module_target'	=> '\w*'
	   ,'iscore'		=> '[0-9]+'
	   ,'attribute'		=> '.*'
	   ,'ordering'		=> '[0-9]*'
	   ,'state'			=> '[0-9]*'
	);
	/**
	 * list sub modules,if $mid === null,list all modules.
	 *
	 * @param unknown_type $mid
	 * @param $b //前台or后台模块
	 */
	function getModules( $mid = 0 , $b = 'backend')
	{
		switch($b)
		{
			case 'backend':
				$modHandler = parent::table('module');
				$cdt		= $mid === null ? "1" : "module_pid='".$mid."'";
				#$cdt       .= " && state=1";
				$rs 		= $modHandler->select('*',$cdt,array('ordering'=>'desc'));
				return $rs->data;
			break;
			
			default:
				return array();
			break;
		}
	}
}
?>
