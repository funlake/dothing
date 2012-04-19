<?php

class DOSyntax
{
	const tableFileSep = '___';
	private $asset = array('join'		,'joinField'	,'fields'
			      ,'orderby'	,'groupby'	,'where'
			      ,'limit'		,'coreTable'	,'coreTableAs'
			      ,'sqlQuery'	,'params'	,'sets');
	function DOSyntax( ){}
	
	function __construct(){
		
	}
	function Quote( $t ){
		if(strpos($t,'.') > 0) list($table,$field)=sscanf('%[^.].%[^.]',$t);
		if(strpos($table,'#__') === 0) 
		{	
			return "`".$table."`.".($field == '*' ? $filed : "`".$field."`");
		}
		else 
		{
			return (strpos($t,'*') !== false ? $t : "`".$t."`");
		}
	}	
	public function NQ( $field )
	{
		return '`'.$field.'`';
	}	
	/** replace table prefix,trim */
	function FormatSql( $sql )
	{
		return preg_replace(
			array('~(?<=\s)(`)?(?(1)#__(\w+)`|#__(\w+))(?=\s+|$)~is','#^\s+|\s+$#')
		       ,array('`'.DO_TABLEPRE.'\2\3`','')
		       ,$sql);
	}
	
	public function Select( $fields )
	{
		if(is_string($fiendls)) $fields = explode(',',$fields);
		foreach( (array)$fields as $k=>$v)
		{
			$sf = preg_split('#(?<=\s)as(?=\s+)#i',$v);
			$this->fields[  trim($sf[0] ) ] = $sf[1];
		}
		return $this;
	}

	public function Set( )
	{
		$args = func_get_args();
		switch( count($args) )
		{
			case 1 : 
				foreach((array)$args[0] as $k=>$v)
				{
					$this->sets[$this->Quote($k)] 		= $v;	
					//$this->Params[]    					= $v;
				}
			break;

			case 2:
				$this->sets[ $this->Quote($args[0]) ]   = $args[1];	
				//$this->Params[]		   		  			= $args[1];
			break;
		}
		return $this;

	}
	public function From( $tables,$as = '',$fields='')
	{
		$this->coreTable 	= $this->Quote($tables); 
		$this->coreTableAs	= $as;
		!empty($fields) && $this->Select( $fields );
		return $this;
	}
	public function Where( )
	{
		$args = func_get_args();
		switch( count($args) )
		{
			case 1 : 
				foreach((array)$args[0] as $k=>$v)
				{
					$this->where[ $k ] = $v;	
					//$this->Params[]    = $v;
				}
			break;

			case 2:
				$this->where[ $args[0] ]   = $args[1];	
				//$this->Params[]		   	   = $args[1];
			break;
		}
		return $this;
	}
	/** Alias of method 'Values'**/
	public function Params()
	{
		call_user_func_array(array($this,'Values'),func_get_args());
	}
	public function Values()
	{
		$this->values = array();
		foreach(func_get_args() as $value) 
		{
			//if(!is_array($value)) $value = array($value);
			$this->values[] = $value;
		}
		
		return $this;
	}
	public function Clean()
	{
		foreach($this->asset as $asset)
		{
			$this->$asset = null;
		}
		return $this;
	}
	/**
	 * join query
	 *
	 * @param unknown_type $table
	 * @param array $joinField // what fields need to be connected to core table
	 * @param string|array $fetchField //what field need to be fetch 
	 */
	private function joinField( $table , $as,$joinField , $fetchField='')
	{
		if(is_array($joinField))
		{
			foreach((array)$joinField as $k=>$v)
			{
				$this->join[$table]['join'][] = $k
								.' = '
								.$v;
			}
		}
		else $this->join[$table]['join'][] = $joinField;
		if(is_array($fetchField)) $fetchField = implode(',',$fetchField);
		$this->join[$table]['fields'] = $fetchField;
		$this->join[$table]['as']     = $as;
		return $this;
	}
	function LeftJoin($table,$as,$joinField, $fetchField=''){
		$this->join[$table]['type'] = 'left join';
		$this->joinField( $table , $as,$joinField , $fetchField);
		return $this;
	}
	function InnerJoin($table,$as,$joinField, $fetchField=''){
		$this->join[$table]['type'] = 'inner join';
		$this->joinField( $table , $as,$joinField , $fetchField);
		return $this;
	}
	function RightJoin($table,$as,$joinField, $fetchField){
		$this->join[$table]['type'] = 'right join';
		$this->joinField( $table , $as,$joinField, $fetchField );
		return $this;
	}
	function Limit($s,$e){
		$this->limit = array($s,$e);
		return $this;
	}
	function Orderby()
	{
		$args = func_get_args();
		switch(count($args))
		{
			case 1:
				$orderList = $args[0];
				foreach($orderList as $k=>$v)
				{
					$this->orderby[$k] = $v; 
				}
			break;
			
			case 2:
				$this->orderby[ $args[0] ] = $args[1];
			break;
		}
		return $this;
	}

	function Groupby( )
	{
		foreach(func_get_args() as $k=>$v)
		{
			$this->groupby[$k] = $v; 
		}
		return $this;
	}
	private function GetField()
	{
		$get = array();
		foreach( (array)$this->fields as $field=>$as)
		{
			$get[] = $field . (!empty($as) ? ' AS '.$as : '');	
		}
		return implode(',',$get);
	}	
	private function GetWhere()
	{
		$wheres = array();
		foreach((array)$this->where as $k=>$v)
		{
			$wheres[] 	= $k." ".$v;
		}
		if(!!$wheres)
		{
			return "WHERE ".implode(" AND ",$wheres);
		}
		return '';
	}
	private function GetGroupby()
	{
		$groupby = '';
		if( !!$this->groupby)
		{
			$groupby = 'GROUP BY ';
			$grp	 = array();
			foreach($this->groupby as $v)
			{
				$grp[] = $v;
			}
			$groupby .= implode(",",$grp);
		}
		return $groupby;
		
	}
	private function GetOrderby()
	{
		$orderby = '';
		if( !!$this->orderby ) 
		{
			$orderby = 'ORDER BY ';
			$oby 	 = array();
			foreach($this->orderby as $k=>$v)
			{
				$oby[] = $k." ".$v;
			}
			$orderby .= implode(",",$oby);
		}
		return $orderby;
	}
	private function GetSets()
	{
		foreach($this->sets as $field=>$value)
		{
			if($value !== '?') $set[] = $field.'='.$value;
			else $set[] = $field.' = ?';
		}
		return implode(',',$set);
	}
	private function GetLimit()
	{
		if(!!$this->limit)
		{
			return 'Limit '.$this->limit[0].' '.($this->limit[1] ? (' , '.$this->limit[1]) : '');
		}

	}
	private function GetJoiner()
	{
		$joins = array();
		foreach((array)$this->join as $k=>$v)
		{
			$jas	  			= $v['as'];
			if(!empty($v['fields'])) $this->fields[$v['fields']] 	= '';	
			$joins[]  			= $v['type'].' '
				   			 .$this->Quote($k) .' '.$jas
				   			 .($this->coreTable != $k ? (' ON '.implode(' AND ',$v['join'])) : " ");
		}
		return implode("\n",$joins);	
	}

	/**
	*Generate 'SELECT' statements
	*/	
	public function Read()
	{
		$query   = array('SELECT');
		$get     = $joins = $wheres = array();
		$joins   = $this->GetJoiner();
		//fields
		$query[] = $this->GetField();
		//tables
		$query[] = 'FROM '.$this->coreTable.' '.$this->coreTableAs;
		//joined tables
		$query[] = $joins;
		//conditions
		$query[] = $this->GetWhere();		
		//group by
		$query[] = $this->GetGroupby();
		//order by
		$query[] = $this->GetOrderby();		
		//limit
		$query[] = $this->GetLimit();		
		$this->sqlQuery = implode("\n",$query);

		return $this->FormatSql(implode("\n",$query));
	}

	public function Create( $type = 'INSERT')
	{
		$query 		= array($type.' INTO');	
		$query[]	= $this->coreTable;
		$query[]	= 'SET';
		$query[]    = $this->GetSets();
		$query[]	= $this->GetWhere();
		$this->sqlQuery	= implode("\n",$query);
		
		return $this->formatSql( $this->sqlQuery );
	}
	public function Replace()
	{
		return $this->Create('REPLACE');
	}
	public function Update()
	{
		$query 		= array('UPDATE');
		//set joined tables
		$joins		= $this->GetJoiner();	
		//fields	
		$query[]	= $this->GetField();
		//core table
		$query[]	= ' ' . $this->coreTable.' '.$this->coreTableAs;
		//joined tables
		$query[]   	= $joins;
		//set values
		$query[]	= 'SET';
		$query[]    = $this->GetSets();
		//conditions
		$query[] 	= $this->GetWhere();		
		//group by
		$query[] 	= $this->GetGroupby();
		//order by
		$query[] 	= $this->GetOrderby();		
		//limit
		$query[] 	= $this->GetLimit();		

		$this->sqlQuery	= implode("\n",$query);
		
		return $this->FormatSql( $this->sqlQuery );
	}

	public function Delete()
	{
		$query 	 = array('DELETE');
		//joined tables	
		$joins   = $this->GetJoiner();
		//multiple table delete?
		$query[] = $this->GetField();
		//core table
		$query[] = 'FROM ' . $this->coreTable.' '.$this->coreTableAs;
		
		$query[] = $joins;
		//conditions
		$query[] = $this->GetWhere();
		//group by
		$query[] = $this->GetGroupby();
		//order by
		$query[] = $this->GetOrderby();
		//limit
		$query[] = $this->GetLimit();

		$this->sqlQuery	= implode("\n",$query);
		
		return $this->FormatSql( $this->sqlQuery );
	}
}
/**
 * mysql syntax
 *
 */
class MysqlSyntax extends DOSyntax 
{
	/**
	 * idea from csdn,not really tested ,just mark it.
	 *
	 * @param unknown_type $table
	 * @param unknown_type $fileds
	 * @param unknown_type $condition
	 * @param unknown_type $start
	 * @param unknown_type $limit
	 * @param unknown_type $keyid
	 * @return unknown
	 */
	function QuickLimit( $table,$fileds,$condition,$start,$limit,$keyid)
	{
		//model
/*		select module_id,module_pid,module_name from module m 
		INNER JOIN ( 
				select module_id as my_id from ( 
						select module_id from module order by module_id desc limit 0,100 
				) as tmp 
		) as temp ON my_id=module_id */

		$sql = "select {$fileds} from `{$table}` \n"
		      ."inner join( \n"
		      ." select `{$keyid}` as key_id from ( \n"
		      ."	select `{$keyid}` from `{$table}` order by `{$key}` desc limit {$start},{$limit} \n"
		      ." ) as tmp \n"
		      .") as temp on key_id=`{$key}`";
		 return $sql;
	}
}
?>
