<?php
class DOModel
{
	public static  $_tbl 		= array();
	public static  $_mod 		= array();
	private $binds 		 		= array();
	private $cdts		    	= array();
	static  $curdErrors 		= array();
	public  $connections 		= array();
	public $pk					= 'id';
	private  $records             = array();
	private static $currRecord;
	public static $total;
	public function __construct()
	{
		if(empty($this->name)) $this->name = $this->GetName();
		$get 		= DORequest::Get();
		$session 	= DOFactory::GetSession();
		$page   = DOUri::GetModule()."/".DOUri::GetController()."/".DOUri::GetAction();

		$start = $session->Get($page."_p");

		$this->defaultLimit = array(($start-1)*DO_LIST_ROWS,DO_LIST_ROWS);

		$this->addMsgSuccess 	= DOLang::Get('You have successfully add an item');
		$this->addMsgFail 	= DOLang::Get('You fail to add an item');
		$this->updateMsgSuccess = DOLang::Get('You have successfully modify it');
		$this->updateMsgFail	= DOLang::Get('You failed to modify it');
		$this->deleteMsgSuccess = L('You have successfully deleted the item');
		$this->deleteMsgFail       	= L('Fail to delete');
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

	public function Count()
	{
		return DOFactory::GetTable($this->GetName())->Count();
	}
	public static function LastTotal()
	{
		$db = DOFactory::GetDatabase();
		return $db->GetFoundRows();
	}
	public static function SetTotal($total = 0)
	{
		self::$total = $total > 0 ? $total : self::LastTotal();
	}
	public static function GetTotal()
	{
		return self::$total;
	}
	/**
	 * Load model
	 *
	 */
	public function Load( $model )
	{
		return DOFactory::GetModel( $model );
	}
	/**
	 * A method basically use in table list page
	 */
	public function Data($limit = null)
	{
		$searchs = (array)SG(DORouter::GetSearchIndex());
		/** People is searching something in specific page? **/
		if(!!(array_filter($searchs)))
		{
			$where   = array_merge((array)$where,$searchs);
		}
		/** Get limit page **/
		$rs =  $this->Select($where,'like',$this->defaultOrderby,$this->defaultGroupby,$this->defaultLimit);	
		$this->SetTotal();
		return $rs;
	}
	public function Find($where = null)
	{
		//$session = DOFactory::GetSession();//session_start would happen here
		if(!empty($where) and !is_array($where))
		{
			$where = array($this->pk => $where);
		}
		$searchs = (array)SG(DORouter::GetSearchIndex());
		/** People is searching something in specific page? **/
		if(!!(array_filter($searchs)))
		{
			$where   = array_merge((array)$where,$searchs);
		}
		$rorder = DORequest::Get('_doorder');
		if(!empty($rorder)){
			$this->defaultOrderby = array(
				DORequest::Get('_doorder') => DORequest::Get('_dosort')
			);
		}
		/** Get limit page **/
		$rs =  $this->Select($where,'like',$this->defaultOrderby,$this->defaultGroupby,$this->defaultLimit);
		$this->SetTotal();
		return $rs;
	}
	public function Select($where = null,$compare = '=',$orderby = array(),$groupby = null,$limit = null)
	{
		$this->action = __FUNCTION__;
		if(empty($this->name))
		{
			throw new DOException("Unknow table",102);
		}
		if(!empty($where) and !is_array($where))
		{
			$where = array($this->pk => $where);
		}
		if( false != $this->Bind($where) )
		{
			$params = array();
			if(!!$where)
			{
				//$condition = array_intersect($where,$this->binds);
				$condition = array();
				$j         = 0;
				foreach($where as $k=>$v)
				{
					if(is_array($v))
					{
						$condition[$k] 	   = ($v[1] ? $v[1] : '=').'?';
						$params[$j++]      = ($v[1] == 'like' ? ('%'.$v[0].'%') : $v[0]);
					}
					else
					{
						if($compare == 'like')
						{
							$condition[]     = $k.' like ?';
							$params[$j++]    = '%'.$v.'%';
						}
						else
						{
							$condition[]     = $k.'=?';
							$params[$j++]    = $v;							
						}
					}
				}
				//array_unshift($params,$condition);
			}
			$caller = DOFactory::GetTable($this->name);
			$R      = call_user_func_array(array($caller,'GetAll'),array($condition,$params,$orderby,$groupby,$limit));
			$this->SetFieldsValue($R,$R[0],$this->action);
			$this->SetTotal();
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
			/** We don't need to handle primary key in insert operation **/
			unset($this->binds[$this->pk]);
			if(!!$this->binds)
			{
				$R =  DOFactory::GetTable($this->name)->Insert( $this->binds );
				$this->SetFieldsValue($R,$insArray,$this->action);
				$this->AffectChainAction($insArray);
				return $R;
			}
		}
		return false;
	}
	
	/**
	 * Delete table data;
	 */
	function Delete(array $cdtarray = null)
	{
		$this->action = __FUNCTION__;
		if(empty($this->name))
		{
			throw new DOException("Unknow table",102);
		}
		if( false != $this->Bind( $cdtarray ) )
		{
			$params   = array();
			$params[] = $this->deleteKey;
			foreach($this->deleteKey as $dk=>$dv)
			{
				$params[] = $this->binds[$dk];
			}
			$caller = DOFactory::GetTable($this->name);
			$R      = call_user_func_array(array($caller,__FUNCTION__), $params);
			$this->SetFieldsValue($R,$cdtarray,$this->action);
			$this->AffectChainAction($cdtarray);
			return $R;
		}
		return false;		
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
			/**Update conditions should not stay in binds array*/
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
			$this->AffectChainAction($uparray);
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
				$value = $filter->process($value);

				if(!is_array($value)) $value = trim($value);
			}
			/** Do we have mapping for fields ?**/
			if($this->maps[$field])
			{
				$field = $this->maps[$field];
			}
			if(isset($this->fields['@'.$field]) 
			  ||isset($this->fields['#'.$field])
			  ||isset($this->fields[$field])
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
			foreach($this->fields as $key=>$default)
			{
				$rawKey = trim($key,'@#');
				if(!isset($this->binds[$rawKey]))
				{
					$this->binds[$rawKey] = $default;
				}
			}
			//print_r($this->binds);exit;
		}
		else
		{
			if($this->action !== 'Select' and $this->action !== 'Delete')
			{
				//echo "<pre/>";
				//print_r(debug_backtrace());exit;
		 		throw new DOException("Empty parameters!",101);
			}
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
		$this->last['fields'] 				= @array_merge($posts,$this->last['fields']);
	}

	/** 
	** This method would be invoked 
	** after we do some insert/update/delete action
	**/
	public function AffectChainAction($post)
	{
		/** People dont want to handle other connected tables **/
		if(isset($post['__chain']) && $post['__chain'] == 0)
		{
			return ;
		}
		$posts = $post;
		foreach((array)$this->connections as $tb=>$fields)
		{
			
		}
		// foreach((array)$this->connections['has_one'] as $tb => $fields)
		// {
		// 	foreach($fields as $field)
		// 	{
		// 		$posts[$field]  = $this->last['fields'][$field];
		// 	}
		// 	call_user_func(array(
		// 		DOFactory::GetModel($tb),$this->action
		// 	),$posts);
		// }

		// $posts = $post;
		// foreach((array)$this->connections['has_many'] as $tb => $fields)
		// {
		// 	foreach($fields as $field)
		// 	{
		// 		$posts[$field]  = $this->last['fields'][$field];
		// 	}
		// 	call_user_func(array(
		// 		DOFactory::GetModel($tb),$this->action
		// 	),$posts);
		// }
	}

	public function ARStart($id)
	{
		if(!$this->records[$id])
		{
			$recordset = $this->Find($id);
			$this->records[$id] = $recordset;
		}
		self::$currRecord  = $this->records[$id];
		return $this;
	}
	public function __get($n)
	{
		if(array_key_exists('#__'.$n,$this->connections))
		{
			$keys = array_keys($this->connections['#__'.$n]);
			$finder = $value = array();
			foreach($keys as $cnt)
			{
				$nk 		  = $this->connections['#__'.$n][$cnt];
				foreach((array)self::$currRecord as $mr)
				{
					//print_r($mr);
					$finder[$cnt] 	  = "=?";
					$value[]	  = $mr->$nk;
				}
			}
			//print_r($finder);
			$rs = $this->load($n)->GetAll($finder,$value);
			self::$currRecord =  $rs;
			return $this->load($n);
		}
		return null;
	}
	public function AREnd()
	{
		return  self::$currRecord;
	}
	public function __toString()
	{
		return $this->currRecord;
	}
}
?>
