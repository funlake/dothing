<?php
/**
 * http response header
 *
 */
class DOResponse
{
	/** Http response body,generally generated by specific controller**/
	public $httpBody;
	/** Response init **/
	public function __construct(){}
	function SetHeaders(Array $headers)
	{
		if(!!$headers) array_walk($headers,array(__CLASS__,'SetHeader'));
	}
	public function SetHeader($option,$value)
	{	
		if ('status' == strtolower($option))
		{
			// 'status' headers indicate an HTTP status, and need to be handled slightly differently
			header(ucfirst(strtolower($option)) . ': ' . $option, null, (int)$option);
		}
		else header(ucwords($option).":".$value);
	}
	
	public function SetBody( $body )
	{
		$this->httpBody = $body;
	}
	public function GetBody()
	{
		return $this->httpBody;
	}

	function NoCache($t = false)
	{
		$headerArray = !$t ? array('Expires'=> 'Mon, 1 Jan 2001 00:00:00 GMT'
					  ,'Last-Modified'		=> gmdate("D, d M Y H:i:s").' GMT'
					  ,'Cache-Control'  	=> 'Max-age=0,must-revalidate,no-cache,post-check=0,pre-check=0'
					  ,'Pragma'				=> 'no-cache'
		): array();
		$this->SetHeaders( $headerArray );
	}

	public function Response($httpCache = false)
	{
			/**Set cache http header**/
			if(!$httpCache)
			{
				$this->NoCache();
			}
			/** Get template and prepare to display**/
			$this->SetBody(DOTemplate::LoadTemplate());
			/** Do we have any plugin to format this responses?**/
			$params   = array($this);
			DOHook::HangPlugin('afterPageRender',$params);
			echo $this->GetBody();
	}
	
	public function __destruct(){}
}
?>
