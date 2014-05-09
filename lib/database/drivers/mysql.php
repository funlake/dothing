<?php
use \Dothing\Lib\Loader;
Loader::Import('lib.database.database');
class DODatabaseMysql extends DODatabase
{
	public $driver = 'mysql';
	public function SetDsn($host,$dbname)
	{
		$this->dsn = 'mysql:host='.$host.';dbname='.$dbname;
	}
	
	public function IsError($errors)
	{
		return ($errors[1] > 999 && $errors[1] < 1200);
	}
}
?>