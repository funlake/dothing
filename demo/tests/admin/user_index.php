<?php
include dirname(__FILE__).'/../init.php';
class UserIndexTest extends PHPUnit_TestCase
{
	public function TestDb()
	{
		$db = \Dothing\Lib\Factory::GetDatabase();
		$this->assertNotNull($db, "Database has been connected");
	}
	public function TestLake()
	{
		$this->assertNotNull(null, "Has lake fall in sleep?");
	}
}
simpletest_autorun();
?>