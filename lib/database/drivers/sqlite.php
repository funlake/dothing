<?php 
DOLoader::Import('lib.database.database');
/**
 * @desc 
 * Implegments Sqlite driver
 * ---------------------------------------
 * I saw that php's pdo for sqlite would get some weird problem with php5.3-
 * when we try to bind some integer values for a prepared statment,so 
 * we probably have to override Query method in database class.
 * reference : https://bugs.php.net/bug.php?id=45259
 * ----------------------------------------
 * @author lake
 *
 */
class DODatabaseSqlite extends DODatabase
{
	public $driver;
	public $types = array(
			'integer' => SQLITE3_INTEGER
		   ,'string'  => SQLITE3_TEXT
			# ,'array'   => PDO::PARAM_ARR
	);
	public function SetDsn($host,$dbname)
	{
		$this->dsn 		= 'sqlite:'.$dbname;
		$this->driver 	= 'sqlite';
	}
	
	public function IsError($errors)
	{
		return ($errors[1] > 0 && $errors[1] < 27);
	}
	
	public function SetNames(){}
	/** 
	 * Sqlite would caught exceptions before we prepare a statement
	 * this is make codes not so consistency.it's ugly implements
	 * we have to do this or we would saw some error messages which make no sense
	 * when we execute a wrong sql.
	 **/
	public function SetAttributes()
	{
		$this->connFlag->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
		//$this->connFlag->setAttribute(PDO::ATTR_EMULATE_PREPARES, 0);
	}
}
?>