<?php 
class DOSax extends DOXml
{
	/** A deepth array saving xml struct**/
	private static $parents = array('ROOT');
	/** Open xml file,prepare for parsing job**/
	public function Open( $file )
	{
		
	}
	/** What we want to do when parser pass a tag **/
	public function TagOpen($parser,$tag,$attrs)
	{
		if(method_exists($this,"Start_".$tag))
		{
			
		}
	}
	
	public function TagClose($parser,$tag)
	{
		
	}
	
	public function ReadData($parser,$data)
	{
		
	}
	
	public function PiParser($parser,$target,$data)
	{
		
	}
	
	public function ExternalParser($parser,$entity,$base,$entiryFile,$publicId)
	{
		
	}
	
	public function DefaultOpen($parser,$data)
	{
		
	}
}
?>