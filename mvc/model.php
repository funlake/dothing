<?php
class DOModel
{
	public static  $_tbl = array();
	public static  $_mod = array();
	private $name = '';
	private $pk	 = '';
	function __construct()
	{
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
	function Create( array $insArray )
	{
		if(empty($this->name))
		{
			throw DOException("Please set the name attribute to be a valid table name");
		}
		return self::Table($this->name)->Insert($insArray);
	}
	function Update( array $uparray , array $condition = null)
	{
		if(empty($this->name))
		{
			throw DOException("Please set the name attribute to be a valid table name");
		}
		return self::Table($this->name)->Update($items,$condition);
	}	
}
?>
