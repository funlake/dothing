<?php
/**
 * @author lake
 * @version 1.0
 * @package framework
 */
include dirname( __FILE__)."/../init/init.php";
//load the router..
$router = & DOFactory::get( 'class',array('router') );
//run
$router->run('admin');

?>