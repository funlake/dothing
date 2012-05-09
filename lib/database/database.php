<?php
DOLoader::Import('lib.database.record');
/** 
 * PDO database interface
 * @author lake
 *
 */
class DODatabase implements DORecord
{
	public $types = array(
	    'integer' => PDO::PARAM_INT
	   ,'string'  => PDO::PARAM_STR
	  # ,'array'   => PDO::PARAM_ARR
	);
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
		$rSql           	= $syntax->formatSql( $sql );
		$resource 			= $this->connFlag->prepare( $rSql );
		if(!!$params)
		{
			$this->BindValue($params, $resource);
		}
		$resource->execute();
		/** Return dataset**/
		$rs					= array();
		/** 
		 * Don't invoke fetchAll if we dont need to do it
		 * or it would cause a HY000 error. 
		 **/
		if(preg_match('#^select\s+#i',$sql))
		{
			$rs					= $resource->fetchAll(PDO::FETCH_OBJ);
		}
		$this->insert_id   	= $this->connFlag->lastInsertId();
		$this->affect_row  	= $resource->rowCount();
		$R = new stdClass();
		$R->data 			= $this->data 		= $rs;
		$R->insert_id		= $this->insert_id;
		$R->affect_row  	= $this->affect_row;
		$errors				= $resource->errorInfo();
		if($this->IsError($errors))
		{
			//if(DO_DEBUG)
			//{
			//$backtraces = debug_backtrace();
			//$json		= DOFactory::GetTool('json');
			//$detail     = $json->encode($backtraces);
			//}
			//DOError::Trigger(DO_DBDRIVE,$errors[2],$detail,E_USER_WARNING);
			throw new DODatabaseException($sql."<{$errors[2]}>",301);
		}
		return $R;			
	}
	/**
	* For Create/Update/Delete operation.
	*/
	public function Execute()
	{
		$R = $this->Query($this->GetQuery(),$this->GetParams());
		return $R->success;
		//->insert_id;
	}	
	public function GetQuery()
	{
		return $this->GetSyntax()->sqlQuery;
	}
	public function GetParams()
	{
		return $this->GetSyntax()->values;
	}
	public function GetAll()
	{
		return $this->Query($this->GetQuery(),$this->GetParams())
			   ->data;	
	}
	public function GetOne($field)
	{
		$rs = @$this->Query($this->GetQuery(),$this->GetParams())
			    ->data[0];
		return	!empty($field) ? $rs->$field : current((array)$rs);	
	}
	
	public function GetRow()
	{
		return $this->Query($this->GetQuery(),$this->GetParams())
			    ->data[0];	
		
	}

	public function GetCol($fields)
	{
		$rs 		= $this->GetAll();
		$rt 		= array();
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
	 * pdo bind value
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
