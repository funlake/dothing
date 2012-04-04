<?php
class DOError extends DOController 
{
	function indexAction()
	{
		$prms   			= $this->params;
		$prms['backend'] 	= 'Y';
		$params = str_replace('&amp;','&',http_build_query($prms) );
		//will build a site link,not admin link.
		$this->set('backend','');
		$url    			= DOUri::buildQuery('error','error','index',$params);
		//$this->set('backend','admin');
		DOUri::redirect($url);
	}
}
?>