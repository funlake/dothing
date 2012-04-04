<?php
/**
 * http response header
 *
 */
class DOResponse extends DOBase 
{

	function setHeader(Array $headers)
	{
		if(!!$headers)
			array_walk($headers,array(self,set));
	}
	function cache($t = false)
	{
		/**
		 * 			JResponse::setHeader( 'Expires', 'Mon, 1 Jan 2001 00:00:00 GMT', true ); 				// Expires in the past
			JResponse::setHeader( 'Last-Modified', gmdate("D, d M Y H:i:s") . ' GMT', true ); 		// Always modified
			JResponse::setHeader( 'Cache-Control', 'no-store, no-cache, must-revalidate, post-check=0, pre-check=0', false );
			JResponse::setHeader( 'Pragma', 'no-cache' ); 		
		 */
		$headerArray = !$t ? array('Expires'		=> 'Mon, 1 Jan 2001 00:00:00 GMT'
								  ,'Last-Modified'	=> gmdate("D, d M Y H:i:s").' GMT'
								  ,'Cache-Control'  => 'Max-age=0,must-revalidate,no-cache,post-check=0,pre-check=0'
								  ,'Pragma'			=> 'no-cache'
								  )
						    : array();
	}
	function set($value,$option)
	{
		if ('status' == strtolower($option))
		{
			// 'status' headers indicate an HTTP status, and need to be handled slightly differently
			header(ucfirst(strtolower($option)) . ': ' . $option, null, (int)$option);
		}
		else header(ucwords($option).":".$value);
	}
}
?>