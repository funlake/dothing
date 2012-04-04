<?php
class DOModel extends DOBase
{
	public static  $_tbl = array();
	public static  $_mod = array();
	public $name = '';
	function DOModel()
	{
		parent::__construct();
	}
	function & initTable()
	{
		$tables = func_get_args();
		
		if( !!$tables )
		{
			foreach((array)$tables as $v)
			{
				if(!self::$_tbl[$v[0]])
				{
					self::$_tbl[$v[0]] = & DOFactory::get('table',array($v[0],$v[1],$v[2] ) );
				}
			}
		}
		return self::$_tbl;
		
	}
	
	function table( $tb,$key='')
	{
		if(!self::$_tbl[ $tb ])
		{
			self::$_tbl[ $tb ] = & DOFactory::get('table',array($tb,$key) );
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
	function load( $module,$model='',$backend=true )
	{
		if($backend)
		{
			$pre = "admin.";
		}
		$model = $model ? $model : $module;
		if( !self::$_mod[$backend.$module.$model] )
		{
			if( DOLoader::import($pre.'app.'.$module.'.model.'.$model) )
			{
				$ms	= "DOModel_".$model;
				self::$_mod[$backend.$module.$model] = new $ms();
			}
		}
		return self::$_mod[$backend.$module.$model];
	}
	function create( $items)
	{
		return self::table($this->name)->insert($items);
	}
	function update( $items , $condition = '')
	{
		return self::table($this->name)->update($items,$condition);
	}	
}
?>
