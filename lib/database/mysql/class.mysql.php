<?php
/**
 * 
 * @package database.class
 * @author  lake
 * @version $Id:$
 * @version 2.0
 * ---------------------------------------------------
*/
class DOMysql
{
/**
 * ----------------
 * database's host
 * ----------------
 *
 * @public  $dbHost
 */
	public  $dbHost;
	
/**
 * --------------------
 * database's username
 *---------------------
 * @public  $dbUserName
 */
	public  $dbUserName;

/**
 * --------------------
 * database's password
 * --------------------
 *
 * @public  $dbPassWord
 */
	public  $dbPassWord;
	
/**
 * ---------------------
 * single database's name
 * ----------------------
 * 
 * @public  $dbName
 */
	public  $dbName	;
	
/**
 * --------------------
 * mysql's connect flag
 * --------------------
 *
 * @public  $connFlag;
 */
	public  $connFlag;
	
/**
 * ------------------
 * sql query's statement
 * -------------------
 * @public  queryString
 */
	public  $queryString;
	
	
/**
 * -----------------------
 * sql debug
 * ---------------------
 * @public  debug
 */
	public  $debug;
	
/**
 * -------------------
 * result's total rows
 * -------------------
 * @public  rows;
 */
	public  $rows;
	
	/**
	 * -----------------------
	 * consturct function
	 * -----------------------
	 *
	 * @param string $host
	 * @param string $user
	 * @param string $pw
	 * @param string $db
	 */
	
	function DOMysql($host='localhost',$user='root',$pw,$db)
	{
		/**---define--*/
		$this->dbHost 		= 	$host	;
		$this->dbUserName 	= 	$user	;
		$this->dbPassWord	=	$pw		;
		$this->dbName		=	$db		;
		$this->debug		=	DO_DEBUG;
		$this->connect();
	}
	
	/**
	 * --------------
	 * connect mysql
	 * --------------
	 *
	 * @return $msg
	 */
	function connect()
	{
		//CLIENT_MULTI_RESULTS for procedure calling.
		$this->connFlag = @mysql_connect($this->dbHost,$this->dbUserName,$this->dbPassWord,true,131072) or $msg = mysql_error();
		
		$msg =  $this->connFlag
				? @mysql_select_db($this->dbName,$this->connFlag) ? $this->setNames() : mysql_error($this->connFlag)
				: $msg
				;
		
		$this->showError($msg);
		
		return getType($msg) == 'string' ? false : true;
	}
	/**
	 * set names
	 *
	 */
	function setNames()
	{
		$charset = str_replace('-','',DO_CHARSET);
		//php   < 5.2.8
		//mysql > 4.0.1
		if(version_compare(phpversion(),'5.2.8','<') && version_compare($this->getVersion(),'4.0.1','>'))
		{
			//not really good .
			$this->query("SET NAMES '{$charset}'");
		}
		else 
		{
			//recommand method,it will check the current charset,and see if chars need to be added slashes.
			mysql_set_charset(DO_CHARSET,$this->connFlag);
		}
		return true;
	}
	function checkConnect()
	{
		return mysql_ping($this->connFlag);	
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
		DOLoader::import('lib.database.syntax');
		
		$syntax = new mysqlSyntax();
		
		if(method_exists( $syntax,$fn ))
		{
			return $this->makeSql($fn,$args,$syntax);
		}
		else 
		{
			
		}
	}
	/**
	 * makeSql
	 *
	 * @param string $method
	 * @param array $args
	 * @return unknown
	 */
	function makeSql( $method,$args,$syntaxHandler)
	{
		return call_user_func_array(array($syntaxHandler,$method),$args);
	}
	/**
	 * ---------------
	 * directly exec
	 * -----------------
	 * 
	 * @param $sql // sql statement
	 * @return $rs|id|true or false
	 */
	function query( $sql,$rsType = 1)
	{
		DOLoader::import('lib.database.syntax');
		$syntax = new mysqlSyntax();
		$resource = mysql_query($syntax->formatSql($sql),$this->connFlag);
		$debug    = mysql_error( $this->connFlag );
		$rs 				= $this->mysql_fetch( $resource , $rsType) ;
		$this->inser_id 	= mysql_insert_id($this->connFlag);
		$this->affect_row 	= mysql_affected_rows($this->connFlag);
		if($this->debug) 
		{
			$this->showError($sql,$debug);
		}
		
		$R = new stdClass();
		$R->data 		= $rs;
		$R->insert_id	= $this->insert_id;
		$R->affect_row  = $this->affect_row;
		return $R;

	}
	
	/**
	 * --------------
	 * fetch result
	 * --------------
	 *
	 * @param array $rs
	 * @param integer $rsType
	 * @return array || object
	 */
	function mysql_fetch( $resource,$rsType=1 )
	{
		if(!is_resource( $resource )) return false;
		if( $resource )
		{
			$res = array();
			
			switch($rsType)
			{
				case '':
										
					while( $row = mysql_fetch_array($resource) )
					{
						$res[] = $row;
					}
				break;

				case 1:
					while( $row = mysql_fetch_array($resource,MYSQL_ASSOC) )
					{
						$res[] = $row;
					}
				
				break;
				
				case 2:
					while( $row = mysql_fetch_array($resource,MYSQL_NUM) )
					{
						$res[]	= $row;
					}
				break;
				
				case 3:
					while( $row = mysql_fetch_object($resource) )
					{
						$res[] = $row;
					}
				
				default: break;
					
			}
		}
		/** count(false) =1 careful!*/
		return count($res) > 0 ? $res : null;
	}
	
	/**
	 * ------------------------
	 * show the error message;
	 * -------------------------
	 *
	 * @param string|boolen $msg
	 */
	function showError( $msg , $error='')
	{
            if($this->debug) {
					echo getType($msg) == 'string' ? "<hr noshade size=0 color=#C0C0C0>".$msg."<hr noshade size=0 color=#C0C0C0><br>" : '';
				
						if($error) echo "<hr noshade size=0 color=#C0C0C0><span style='color:red'>".$error."</span><hr noshade size=0 color=#C0C0C0><br>";
           
            }
	
	}
	function getVersion()
	{
		$version = mysql_get_server_info( $this->connFlag );
		$version = trim($version);
		$version = explode('.',$version);
		return $version[0].'.'.$version[1];
	}
	function __destruct()
	{
		@mysql_close($this->connFlag);
	}
}
?>
