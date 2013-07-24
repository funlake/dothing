<?php
DOLoader::Import('lib.database.record');
/** 
 * PDO database interface
 * @author lake
 *
 */
ini_set("mysql.trace_mode", "0");
class DODatabase implements DORecord
{
	public $types = array(
	    'integer' => PDO::PARAM_INT
	   ,'string'  => PDO::PARAM_STR
	  # ,'array'   => PDO::PARAM_ARR
	);

	public $sqlQuerys = array();
	public $sqlQuery  = '';
	function DODatabase($host,$user,$pwd,$dbname)	
	{
		//set dsn
		call_user_func_array(array($this,'SetDsn'),array($host,$dbname));
		//connect
		$this->Connect($user,$pwd);
	}
	
	function SetNames()
	{
		$charset = DO_CHARSET;
		if(DO_CHARSET == 'utf-8')
		{
			$charset = str_replace('-','',DO_CHARSET);
		}
		if(version_compare(phpversion(),'5.2.8','<'))
		{
			//not really good .
			$this->Query("SET NAMES {$charset}");
		}
		else
		{
			//good but need new version
/* 			$this->SetOptions(array(
				PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES {$charset}"
			)); */
			$this->Query("SET NAMES {$charset}");
		}
		return true;
	}
	
	function SetOptions( $options )
	{
		$this->opt = $options;
	}
	
	public function SetAttributes()
	{
		
	}
	function Connect($user,$pass)
	{
		$this->connFlag = new PDO( $this->dsn,$user,$pass,$this->opt);
			/** Use set_error_handler to cache sql error**/
			//$this->connFlag->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
		$this->SetAttributes();
		
		$this->SetNames();
	}
	
	/**
	 * auto call method in syntax.
	 *
	 * @param unknown_type $fn
	 * @param unknown_type $args
	 * @return unknown
	 */
	function __call( $fn , $args )
	{
		$syntax = $this->GetSyntax();	
		
		if(method_exists( $syntax,$fn ))
		{
			return $this->MakeSql($fn,$args,$syntax);
		}
		else 
		{
			throw new DODatabaseException("Didn't find method <b>".get_class($syntax)."::{$fn}</b>", 300);
		}
	}
	/**
	 * get syntax obj
	 *
	 * @return syntax object
	 */
    function GetSyntax( )
   	{
        return DODatabaseWS::GetSyntax($this->driver);
    }
	/**
	 * makeSql
	 *
	 * @param string $method
	 * @param array $args
	 * @return unknown
	 */
	function MakeSql( $method,$args,$syntaxHandler)
	{
		return call_user_func_array(array($syntaxHandler,$method),$args);
	}
	
	/**
	 * execute sql
	 *
	 * @param unknown_type $sql
	 * @param unknown_type $rsType
	 * @return unknown
	 */
	function Query( $sql,$params=null )
	{
		$syntax         	= $this->GetSyntax();
		$this->sqlQuerys[]  = $this->sqlQuery = $syntax->formatSql( $sql );
		DOHook::HangPlugin('prepareSql',array($this,$syntax,$params));
		$statement 			= $this->connFlag->prepare( $this->sqlQuery ,
			array(PDO::MYSQL_ATTR_FOUND_ROWS => true)
		);
		if(!!$params)
		{
			$this->BindValue($params, $statement);
		}
		/** Prepare statement execute **/
		$statement->execute();
		/** Return dataset**/
		$rs					= array();
		/** 
		 * Don't invoke fetchAll method if we dont need to do it
		 * or it would cause a HY000 error. 
		 **/
		if(preg_match('#^select\s+#i',$sql))
		{
			$rs					= $statement->fetchAll(PDO::FETCH_OBJ);
		}
		/** 
		** Generate return record set
		** Bind latest recordset for $PDO object
		**/
		$R = new stdClass();
		$R->success			= false;
		$R->data 			= $this->data 		= $rs;
		$R->insert_id		= $this->insert_id  = $this->connFlag->lastInsertId();
		$R->affect_row  	= $this->affect_row = $statement->rowCount();
		$errors				= $statement->errorInfo();
		if($this->IsError($errors))
		{
			throw new DODatabaseException($sql."//detail:{$errors[2]}",301);
		}
		else
		{
			/** 
			** When sql query was executed properly(mean that database did not dump any error).
			** we treat it as a successfully execution,no matter affect_row was either 0 or 1.
			**/
			$R->success 	= true;
		}
		return $R;			
	}
	/**
	* For Create/Update/Delete operation.
	*/
	public function Execute()
	{
		$R = $this->Query($this->GetQuery(),$this->GetParams());
		return $R;
		//->insert_id;
	}	
	/**
	** Get last sql query
	**/
	public function GetQuery()
	{
		return $this->GetSyntax()->sqlQuery;
	}
	/**
	** Get prepare params
	**/
	public function GetParams()
	{
		return $this->GetSyntax()->values;
	}
	/**
	** Get all recordset
	**/
	public function GetAll()
	{
		return $this->Query($this->GetQuery(),$this->GetParams())
			   		->data;	
	}
	/**
	** Get one value
	**/
	public function GetOne($field)
	{
		$rs = $this->Query($this->GetQuery(),$this->GetParams())
			  	   ->data[0];
		return	!empty($field) ? $rs->$field : current((array)$rs);	
	}

	/**
	** Get a single row
	**/
	public function GetRow()
	{
		return $this->Query($this->GetQuery(),$this->GetParams())
			    ->data[0];	
		
	}
	/**
	** Get some of fields
	** @param string/array $fields
	**/
	public function GetCol($fields)
	{
		$rs 		= $this->GetAll();
		$rt 		= array();
		/** strip the total request rows **/
		$fields     = trim(str_replace('SQL_CALC_FOUND_ROWS','',$fields));
		if($fields === '*') return $rs;
		$fields		= explode(',',$fields);
		foreach($rs as $k=>$record)
		{
			$rt[$k] = new stdClass();
			foreach($record as $f=>$v)
			{
				if(in_array($f,$fields)) $rt[$k]->$f = $v;
			}
		}
		return $rt;
	}
	/**
	** Get found_rows according to statement which have added 'SQL_CALC_FOUND_ROWS'
	** @return number
	**/
	public function GetFoundRows()
	{
		$rs = $this->Query("SELECT FOUND_ROWS() as amount");

		return $rs->data[0]->amount;
	}
	/**
	 * Pdo bind value
	 *
	 * @param array $params
	 * @param pdostatementobj $resource
	 */
    function BindValue( $params ,$resource )
    {
        if( $params == null || !is_object($resource) ) return;
        foreach((array)$params as $k=>$v)
        {
           $resource->bindValue($k+1,$v,$this->GetType($v));
        }
    }
	/** 
	 * Get type of params
	 * @param notsure $param
	 * @return Constant
	 */
    function GetType( $param )
    {
        $type = $this->types[GetType( $param )];
		return $type ? $type : PDO::PARAM_STR;
    }
}

?>
