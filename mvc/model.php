<?php
class DOModel
{
	public static  $_tbl 	= array();
	public static  $_mod 	= array();
	private $name 			= '';
	private $pk	 			= '';
	private $binds 		 	= array();
	private $cdts		    = array();
	function __construct()
	{
		if(empty($this->name)) $this->name = $this->GetName();
	}
	function Init()
	{
		$tables = func_get_args();
		
		if( !!$tables )
		{
			foreach((array)$tables as $v)
			{
				if(!self::$_tbl[$v[0]])
				{
					self::$_tbl[$v[0]] = DOFactory::GetTable($v[0],$v[1],$v[2]);
				}
			}
		}
		return self::$_tbl;
		
	}
	function GetName()
	{
		return strtolower(preg_replace('#^DOModel#','',get_class($this)));
	}
	function GetTable( $tb,$key='')
	{
		if(!self::$_tbl[ $tb ])
		{
			self::$_tbl[ $tb ] = DOFactory::GetTable($tb,$key,null);
		}
		return self::$_tbl[ $tb ];
	}
	
	/**
	 * Enter description here...
	 *
	 * @param unknown_type $module
	 * @param unknown_type $model
	 * @param unknown_type $backend
	 */
	function Load( $model )
	{
		return DOController::GetModel( $model );
	}
	
	/**
	 * Single table data insert
	 * @param array $insArray
	 */
	function Create()
	{
		if(empty($this->name))
		{
			throw DOException("Please set the name attribute to be a valid table name",200);
		}
		if( false !== $this->Bind() )
		{
			return self::GetTable($this->name)->Create( $this->binds );
		}
		else
		{
			return false;
		}
	}
	
	/**
	 * Single table data update
	 * @param array $insArray
	 */
	function Update( )
	{
		if(empty($this->name))
		{
			throw DOException("Please set the name attribute to be a valid table name");
		}
		if( false !== $this->Bind() )
		{
			foreach(array_keys($this->updatekey) as $upkey)
			{
				unset($this->binds[$upkey]);
			}
			
			$params[] = $this->binds;
			$params[] = $this->updatekey;
			foreach($this->cdts as $p)
			{
				$params[] = $p;
			}
			$caller =  self::GetTable($this->name);
			return call_user_func_array(array($caller,"Update"), $params);
		}
		else 
		{
			return false;
		}
		
	}
	
	function Bind()
	{
		$request = DOFactory::GetTool('http.request');
		$this->binds = $this->cdts = null;
		foreach($request->Get(null,'post') as $field=>$value)
		{
			/** Do we have mapping for fields ?**/
			if($this->maps[$field])
			{
				$field = $this->maps[$field];
			}
			if( $this->fields[0]['@'.$field] 
			  ||$this->fields[0]['#'.$field]
			  ||$this->fields[0][$field]
			)
			{//primary key
			 //index key
			 //normal field
			 	/** Is it for update ? **/
				if( $this->updatekey[$field] )
				{
					foreach(explode(',',$value) as $cdt)
					{
						$this->cdts[] = $cdt;
					}
				}
				/** Validate **/
				if($this->validate[$field])
				{
					if(!preg_match($this->validate[$field],$value))
					{
						throw new Exception("Field [{$field}] validate fail");
						return false;
					}
				}
				/** Adjust field's value **/
				if(method_exists($this,'_adjust_'.$field))
				{
					$value = call_user_func_array(
								array($this,'_adjust_'.$field)
							   ,array($value)
					);	
				}
				$this->binds[$field] = $value;
			}
			else 
			{
				continue;
			}
		}
		return true;
	}
}
?>
