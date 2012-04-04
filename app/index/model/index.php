<?php
class DOModel_index extends DOModel 
{
	private $_tables = array();
	
	function DOModel_index()
	{
		$db    = & DOFactory::get('DBO',array('localhost','root','','test'));
		
		$this->_tables = & parent::initTable(
				array('cms_admin','user_id')
			   ,array('cms_categry','catid')
			   ,array('b','',$db)
		);
	}
	
	function getName()
	{
		//header('Content-Type:text/html;charset=utf-8');
		$db 	= & DOFactory::get('DBO');
		$db2    = & DOFactory::get('DBO');
		$db3    = & DOFactory::get('DBO');

		//echo "<pre/>";
		$sql = $db->select(array('cottage'=>'cottage_id,cottage_name','cottage_period'=>'start_time,end_time'),'cottage,cottage_period');
		print_r( $db->query( $sql ));
		//print_r( $db2 );
		//print_r( $this->_tables );
		//print_r($rs);
	}
	
}
?>