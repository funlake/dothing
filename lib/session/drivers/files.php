<?php
namespace Dothing\Lib\Session\Drivers;
class Files
{
	public function __construct(){}
	
	public function session_file(){$this->__construct();}
	
	public static  function open($sPath,$sName){}
	
	public static  function close(){}
	
	public static  function read( $sessionID ){}
	
	public static  function write( $sessionID ){}
	
	public static  function destroy( $sessionID ){}
	
	public static  function gc( $maxLifeTime ){}
}
?>