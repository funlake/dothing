<?php

class DOTable
{
	var $_db;
	var $_tb;
	var $_key;
	var $returnType = 1;
	
	function DOTable($tableName,$key='',$db)
	{
		if( !is_object( $db ) )
		{
			$db = & DOFactory::get('DBO');
		}
		$this->_db 	= $db;
		$this->_tb 	= $tableName;
		$this->_key	= $key;
	}
	
	function __call( $fn , $args )
	{
		//add table handler
		array_unshift( $args , $this->_tb);
		//call sql generate function
		$sql = call_user_func_array( array($this->_db,$fn) , $args );
		//query
		return $this->_db->query( $sql );
	}
	/** get one */
	function getOne($field,$condition='')
	{
		$rs = $this->select($field,$condition);
		return  $rs->data[0][$field];
	}
	/** get row */
	function getRow($field,$condition='')
	{
		$rs = $this->select($field,$condition);
		return  $rs->data[0];
	}
	
	/** 
	 * get totals row from table
	 *
	 * @param $condition //searching's condition
	 * @return total's num 
	 **/
	 function totalRow($condition='')
	{
		$t = $this->select("COUNT(".($this->_key ? $this->_key : '*').") as totalrows",$condition);
		return  $t->data[0]['totalrows'] ;
		
	}
}
?>
