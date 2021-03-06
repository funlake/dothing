<?php
use \Dothing\Lib\Factory as Factory;
/**
 * Single table object
 * @author lake
 *
 */
class DOTable
{
	/** Database instance **/
	public $_db;
	/** Table name **/
	public $_tb;
	/** Primary key **/
	public $_key;
	
	function __construct($tableName,$key='',$db)
	{
		if( !is_object( $db ) )
		{
			$db = Factory::GetDatabase();
		}
		$this->_db 	= $db;
		$this->_tb 	= $tableName;
		$this->_key	= $key;
	}
	
/* 	function __call( $fn , $args )
	{
		//add table handler
		array_unshift( $args , $this->_tb);
		//call sql generate function
		$sql = call_user_func_array( array($this->_db,$fn) , $args );
		//query
		return $this->_db->query( $sql );
	} */
	/** Get one field according to conditions */
	function GetOne($field,$condition = null,$vals = array(),$orderby = array(),$groupby = null,$limit = array())
	{
		$db = $this->_db;

		$db->Clean();
		$db->From( $this->_tb)
		->Select($field)
		->Where($condition)
		->Values($vals)
		->Read();
		return $db->GetOne($field);
	}
	/** Get row according to conditions */
	function GetRow(array $condition = null,$vals = array(),$orderby = array(),$groupby = null,$limit = array())
	{
		$db = $this->_db;
		$db->Clean();
		$sql = $db->From( $this->_tb )
	   	->Select('*')
	   	->Where($condition)
	   	->Values($vals)
	   	->Read();
		return $db->GetRow();
	}
	
	/** Get col in all rows we fetch according to conditions */
	function GetCol($fields,array $condition = null,$vals = array(),$orderby = array(),$groupby = null,$limit = array())
	{
		$db = $this->_db;
		$db->Clean();
		$db->From( $this->_tb )
		->Select($fields)
		->Orderby($orderby)
		->Groupby($groupby)
		->Where($condition)
		->Values($vals)
		->Limit($limit)
		->Read();
		return $db->GetCol($fields);
	}
	
	/** Get all short way calling **/
	function GetAll(array $condition = null,$vals = array(),$orderby = array(),$groupby = null,$limit = array())
	{
		return call_user_func_array(
			 array($this,"GetCol")
			,array('SQL_CALC_FOUND_ROWS *',$condition,$vals,$orderby,$groupby,$limit)
		);
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
		return $this->_db->Execute();
	}
	
	/** Single table Insert **/
	function Insert(array $insarray )
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
		$sql = $db->Insert();
		/** Can not use $db direcitly here,quite strange**/
		return $this->_db->Execute();
	}
	
	/** Single table replace **/
	function Replace( array $insarray)
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
		$db->Replace();
		/** Can not use $db direcitly here,quite strange**/
		return $this->_db->Execute();		
	}
	/** Single table delete function **/
	function Delete( array $condition = null , $vals = array())
	{
		$db = $this->_db;
		$db->Clean();
		$db->From($this->_tb)
		->Where($condition)
		->Values($vals)
		->Delete();
		return $db->Execute();
	}
	/** 
	 * get totals row from table
	 *
	 * @param $condition //conditions for searching
	 * @return total's num 
	 **/
	 function Total(array $condition = null,array $vals = array())
	 {
	 	foreach(array_slice(func_get_args(),1) as $val)
	 	{
	 		$vals[] = $val;
	 	}
		$db = $this->_db;
		$db->Clean();
		$db->From($this->_tb)
		->Select("COUNT(".($this->_key ? $this->_key : '*').") as totalrows")
		->Where($condition);
		$db = call_user_func_array(array($db,'Values'),$vals);
		$db->Read();
		return $this->_db->GetOne('totalrows');
	 }

	 public function Count()
	 {
	 	$db = $this->_db;
	 	$db->Clean();
	 	// $db->Select('FOUND_ROWS()')
	 	// ->Read();
	 	return $db->GetFoundRows();
	 }
}
?>
