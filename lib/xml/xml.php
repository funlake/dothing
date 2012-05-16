<?php
/** Xml parser interface,we'd better to use SAX/xmlReader engine for efficiency requirement **/  
class DOXml
{
	public $fp = null;
	public function Parse( $link )
	{
		
	}
	public function Open( $file )
	{
		
	}
	
	public function Current()
	{
		
	}
	
	public function StartElement($tag,$attr,$content)
	{
		$tagHandler = "Start_".ucwords(strtolower($tag));
		/** Do we have specify tag handler method? **/
		if(method_exists($this,$tagHandler))
		{//Then invoke it
			$args = func_get_args();
			array_unshift($args);
			return call_user_func_array(array($this,$tagHandler), $args);
		}
		else
		{
			
		}
	}
	
	public function EndElement($tag)
	{
		
	}
	
	public function Child()
	{
		
	}
	
	public function Next()
	{
		
	}
	
	public function Query()
	{
		
	}
	
	public function Close()
	{
		
	}
}
?>