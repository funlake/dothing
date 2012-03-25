<?php
class hookInit extends DOHook
{
	function onBeforeaction()
	{
		set_time_limit( 0 );
		#set_magic_quotes_runtime( 0 );
		ini_set('magic_quotes_runtime',0);
		//==========clean request================
		$request  = & DOFactory::get('com',array('http_request') );
		$request->clean();
		//==========response setting=============
		$response = & DOFactory::get('com',array('http_response') );
		//cache or not
		$response->cache( DO_BROWERCACHE );
		
		$bodytype 	= $request->get('get','bodytype') ;

		$type 		= $bodytype ? $bodytype : 'text_html';

		$type     	= str_replace('_','/',$type);
		//set mime & charset 
		$response->setHeader(
			array('Content-type'=>$type.';charset='.DO_CHARSET)
		  # ,array('Content-Encoding'=>'gzip')
		);
		//========== session init  =================
		$session = & DOFactory::get('session',array(DO_SESSHANDLER));
		$session->start();
		
		//========== multi lang init ===============
        		
		$lang    = & DOFactory::get('com',array('lang'));
	}
}

?>
