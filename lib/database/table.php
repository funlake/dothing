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
			$db = DOFactory::GetDatabase();
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
	/** Get one field according to conditions */
	function GetOne($field,array $condition = null)
	{
		$db = $this->_db;
		$db->Clean();
		$db->From( $this->_tb)
		   ->Select($field)
		   ->Where($condition)
		   ->Read();
		return $db->GetOne($field);
	}
	/** Get row according to conditions */
	function GetRow(array $condition = null)
	{
		$db = $this->_db;
		$db->Clean();
		$db->From( $this->_tb)
		   ->Select('*')
		   ->Where($condition)
		   ->Read();
		return $db->GetRow();
	}
	/** Get col in all rows we fetch according to conditions */
	function GetCol($fields,array $condition = null)
	{
		$db = $this->_db;
		$db->Clean();
		$db->From( $this->_tb)
		->Select($fields)
		->Where($condition)
		->Read();
		return $db->GetCol();
	}
	/** Single table update **/
	function Update(array $uparray,array $condition = null)
	{
		foreach($uparray as $k=>$v)
		{
			$sets[$k] = '?';
			$vals[]   = $v;
		}
		foreach(array_slice(func_get_args(),2) as $val)
		{
			$vals[] = $val;
		}
		$db = $this->_db;
		$db->Clean();
		$db->From($this->_tb)
		->Set($sets)
		->Where($condition);
		$db = call_user_func_array(array($db,'Values'), $vals);
		$db->Update();
		/** Can not use $db direcitly here,quite strange**/
		return $this->_db->Execute()->affect_rows;
	}
	
	/** Single table update **/
	function Create(array $insarray )
	{
		foreach($insarray as $k=>$v)
		{
			$sets[$k] = '?';
			$vals[]   = $v;
		}
		$vals += array_slice(func_get_args(),1);
		$db = $this->_db;
		$db->Clean();
		$db->From($this->_tb)->Set($sets);
		$db = call_user_func_array(array($db,'Values'), $vals);
		$db->Create();
		/** Can not use $db direcitly here,quite strange**/
		return $this->_db->Execute();
	}
	
	/** Single table delete function **/
	function Delete( array $condition = null)
	{
		$args = func_get_args();
		array_unshift($args);
		$db = $this->_db;
		$db->Clean();
		$db->From($this->_tb)
		->Where($condition)
		->Values($args)
		->Delete();
		return $db->Execute();
	}
	/** 
	 * get totals row from table
	 *
	 * @param $condition //searching's condition
	 * @return total's num 
	 **/
	 function TotalRows(array $condition = null)
	 {
		$db = $this->_db;
		$db->Clean();
		echo $db->From($this->_tb)
		->Select("COUNT(".($this->_key ? $this->_key : '*').") as totalrows")
		->Where($condition)
		->Read();
		return $db->GetOne('totalrows');
	 }
}
?>
