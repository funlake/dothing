<?php
class DOModel
{
	public static  $_tbl 		= array();
	public static  $_mod 		= array();
	private $binds 		 		= array();
	private $cdts		    	= array();
	static  $curdErrors 		= array();
	public static $connections 	= array();
	public function __construct()
	{
		if(empty($this->name)) $this->name = $this->GetName();
	}
	public function Init()
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
	public function GetName()
	{
		return empty($this->name) 
			 ? strtolower(preg_replace('#^DOModel#','',get_class($this)))
		     : $this->name;
	}
	/** Go directly to table handler **/
	public function __call($name,array $args = null)
	{
		$myDb	= DOFactory::GetTable($this->GetName(),$this->pk);
		return call_user_func_array(array($myDb,$name),$args);
	}
	/**
	 * Load model
	 *
	 */
	public function Load( $model )
	{
		return DOController::GetModel( $model );
	}
	
	public function Select($where = null)
	{
		$this->action = __FUNCTION__;
		if(empty($this->name))
		{
			throw new DOException("Unknow table",102);
		}
		if(!is_array($where))
		{
			$where = array($this->pk => $where);
		}
		if( false != $this->Bind($where) )
		{
			$condition = array_intersect($where,$this->binds);
			foreach($condition as $k=>$v)
			{
				$condition[$k] = '=?';
				$params[]      = $v;
			}
			array_unshift($params,$condition);
			$caller =  DOFactory::GetTable($this->name);
			$R      = call_user_func_array(array($caller,'GetRow'), $params);
			$this->SetFieldsValue($R,$R,$this->action);
			return $R;
		}
		else
		{
			return false;
		}
	}
	/**
	 * Single table data insert
	 * @param array $insArray
	 */
	public function Add( array $insArray = null)
	{
		$this->action = __FUNCTION__;
		if(empty($this->name))
		{
			throw new DOException("Unknow table",102);
		}
		if( false != $this->Bind( $insArray ) )
		{
			
			$R =  DOFactory::GetTable($this->name)->Insert( $this->binds );
			$this->SetFieldsValue($R,$insArray,$this->action);
			return $R;
		}
		else
		{
			return false;
		}
	}
	
	/**
	 * Delete table data;
	 */
	function Delete(array $cdtarray = null)
	{
		$this->action = __FUNCTION__;
	}
	
	/**
	 * Single table data update
	 * @param array $insArray
	 */
	public function Update( array $uparray = null )
	{
		$this->action = __FUNCTION__;

		if(empty($this->name))
		{
			throw new DOException("Unknow model",102);
		}
		if( false != $this->Bind($uparray) )
		{
			$params   = array();
			foreach(array_keys($this->updateKey) as $upkey)
			{
				unset($this->binds[$upkey]);
			}
			
			$params[] = $this->binds;
			$params[] = $this->updateKey;
			foreach($this->cdts['update'] as $p)
			{
				$params[] = $p;
			}
			$caller = DOFactory::GetTable($this->name);
			$R      = call_user_func_array(array($caller,__FUNCTION__), $params);
			$this->SetFieldsValue($R,$uparray,$this->action);
			return $R;
		}
		else 
		{
			return false;
		}
	}
	
	public function Bind( array $posts = null )
	{
		if(!$posts)
		{
			$request = DOFactory::GetTool('http.request');
			$posts = $request->Get(null,'post');
		}
		$this->binds = $this->cdts = null;
		/** Global Validate **/
		if(method_exists($this,$this->action.'_pre_validate'))
		{
			$checked = 	call_user_func_array(
				array($this,$this->action.'_pre_validate')
			   ,array($posts)
			);	
			if(!$checked) return false;
		}
		/** Global Adjustment **/
		if(method_exists($this,$this->action.'_pre_adjust'))
		{
			$value = call_user_func_array(
				array($this,$this->action.'_pre_adjust')
			   ,array($posts)
			);
		}
		/** Log each field's status **/
		$falseFlag = array(1);
		/** Filter **/
		$filter    = DOFactory::GetFilter();
		foreach( $posts as $field=>$value)
		{
			if(strpos($field,'__editor') === 0)
			{
				/**Editor dont need to strip html tag**/
				$value = trim($filter->decode($value));
			}
			else 
			{
				/**Other values should not including html tags **/
				$value = trim($filter->process($value));
			}
			/** Do we have mapping for fields ?**/
			if($this->maps[$field])
			{
				$field = $this->maps[$field];
			}
			if(isset($this->fields[0]['@'.$field]) 
			  ||isset($this->fields[0]['#'.$field])
			  ||isset($this->fields[0][$field])
			)
			{//primary key
			 //index key
			 //normal field
				/** Validate **/
				if(method_exists($this,$this->action.'_validate_'.$field))
				{
					$checked = call_user_func_array(
								array($this,$this->action.'_validate_'.$field)
							   ,array($value,$posts)
					);
					if(!$checked)
					{
						$falseFlag[] = $checked + 0;
						continue;
					}
				}
				/** Adjust field's value **/
				if(method_exists($this,$this->action.'_adjust_'.$field))
				{
					$value = call_user_func_array(
								array($this,$this->action.'_adjust_'.$field)
							   ,array($value,$posts)
					);	
				}
				/** Set condition array for update/delete sql **/
				$this->SetConditions($field,$value);
				$this->binds[$field] = $value;
			}
			else 
			{
				continue;
			}
		}
		if(!!$this->binds)
		{
			/** Merge mapper **/
			foreach($this->fields[0] as $key=>$default)
			{
				$rawKey = trim($key,'#@');
				if(!isset($this->binds[$rawKey]))
				{
					$this->binds[$rawKey] = $default;
				}
			}
		}
		else
		{
			throw new DOException("Empty parameters!",101);
		}
		return array_product($falseFlag);
	}

	public function SetConditions($field,$value)
	{
		$this->cdts 	  = array();
		$cdtkey           = strtolower($this->action).'Key';
		if($this->{$cdtkey}[$field])
		{
			foreach(explode(',',$value) as $cdt)
			{
				$this->cdts[strtolower($this->action)][] = $cdt;
			}
		}
	}
	/**
	** We probably need to get some datas of last action.
	**/
	public function SetFieldsValue($ins,$posts,$action)
	{
		$posts								= (array)$posts;
		$this->last['fields']			    = array();
		$this->last['lastAction'] 			= $action;
		$this->last['fields'][$this->pk] 	= $posts[$this->pk] ? $posts[$this->pk] : $ins->insert_id;
		$this->last['fields'] 				= array_merge($this->last['fields'],$posts);
	}
}
?>
