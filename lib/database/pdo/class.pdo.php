<?php
DOLoader::import('lib.database.database');
DOLoader::import('lib.database.record');
class DOPdo extends DODatabase implements DORecord
{
	public $types = array(
	    'integer' => PDO::PARAM_INT
	   ,'string'  => PDO::PARAM_STR
	  # ,'array'   => PDO::PARAM_ARR
	);
	function DOPdo($host='localhost',$user='root',$pw,$db)	
	{
		$this->dbHost 		= 	$host	;
		$this->dbUserName 	= 	$user	;
		$this->dbPassWord	=	$pw		;
		$this->dbName		=	$db		;
		$this->debug		=	DO_DEBUG;
		//set dsn
		call_user_func(array($this,'set'.ucwords(DO_DBDRIVE).'Dsn'));
		//connect
		$this->connect();
	}
	
	function SetNames()
	{
		$charset = str_replace('-','',DO_CHARSET);
		if(version_compare(phpversion(),'5.2.8','<'))
		{
			//not really good .
			$this->query("SET NAMES '{$charset}'");
		}
		return true;
	}
	function Connect()
	{
		$this->connFlag = new PDO( $this->dsn,$this->dbUserName,$this->dbPassWord,$this->opt);

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
	}
	/**
	 * get syntax obj
	 *
	 * @return syntax object
	 */
    	function GetSyntax( )
   	{
        	return DODatabaseWS::GetSyntax();
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
		$resource 		= $this->connFlag->prepare( $rSql );
		$this->bindValue($params, $resource);
		$resource->execute();
		$rs			= $resource->fetchAll(PDO::FETCH_OBJ);

		$debug			= $resource->errorInfo();
		$this->insert_id   	= $this->connFlag->lastInsertId();
		$this->affect_row  	= $resource->rowCount();
		$this->debug ? $this->showError( $rSql , $debug[2] ) : '';
		
		$R = new stdClass();
		$R->data 		= $this->data 		= $rs;
		$R->insert_id		= $this->insert_id;
		$R->affect_row  	= $this->affect_row;
		return $R;
				
	}
	/**
	* For Create/Update/Delete operation.
	*/
	public function Commit()
	{
		return $this->Query($this->GetQuery(),$this->GetParams())
			    ->insert_id;
	}	
	public function GetQuery()
	{
		return $this->getSyntax()->sqlQuery;
	}
	public function GetParams()
	{
		return $this->getSyntax()->params;
	}
	public function GetAll()
	{
		return $this->Query($this->GetQuery(),$this->GetParams())
			   ->data;	
	}
	public function GetOne($field='')
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

	public function GetCol()
	{
		$rs 		= $this->GetAll();
		$rt 		= array();
		$fields		= func_get_args();
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
    function bindValue( $params ,$resource )
    {
        if( $params == null || !is_object($resource) ) return;
        foreach((array)$params as $k=>$v)
        {
           $resource->bindValue($k+1,$v,$this->getType($v));
        }
    }

    function getType( $param )
    {
        $type = $this->types[gettype( $param )];
	return $type ? $type : PDO::PARAM_STR;
    }
    /***
	 * ------------------------
	 * show the error message;
	 * -------------------------
	 *
	 * @param string|boolen $msg
    */
    function showError( $msg ,$error='')
    {
       if($this->debug) 
       {
	echo getType($msg) == 'string' ? "<hr noshade size=0 color=#C0C0C0>".$msg."<hr noshade size=0 color=#C0C0C0><br>" : '';
					if($error) exit( "<hr noshade size=0 color=#C0C0C0><span style='color:red'>".$error."</span><hr noshade size=0 color=#C0C0C0><br>" );
       }
    }
}

class DOPdo_Mysql extends DOPdo
{
	function setMysqlDsn()
	{
		$this->dsn = 'mysql:host='.$this->dbHost.';dbname='.$this->dbName;
		#$this->opt = array(PDO::ATTR_PERSISTENT => DO_SQLPCONNECT);
	}
}
?>
