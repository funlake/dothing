<?php
class DOHtml
{	
	function load( $pos,$args = array() )
	{
		if(method_exists(array(self,$pos)))
		{
			call_user_func_array(array( self,$pos ),$args);			
		}
		else
		{
			exit(get_class(self)."::{$pos} was undefined!");
		}
	}
	
	function head()
	{

	}
	function title()
	{
		
	}
	
	function footer()
	{
		
	}
	function w3c()
	{
		
	}
	//navigation
	function nav($total,$rowPerPage,$page = 1)
	{
		//include pager template
		
	}
	function addTag($tag,$attributes,$innerValue='',$endTag=1)
	{

		$dom[] = "<".$tag ;
		foreach( $attributes as $k=>$v)
		{
			$dom[] = $k."='".addslashes($attributes)."'";
		}
		if($endTag)
		{
			$dom[] = ">".$innerValue.'</'.$tag.'>';
		}
		else 
		{
			$dom[] = "/>";
		}
		return implode(' ',$dom);
	}
	
	function select($name, $list, $init='', $selected='',$attribute='class="selects"')
	{
		$output  = '';
		$output .= "<select name=\"{$name}\" id=\"{$name}\" {$attribute}>";
		if (is_array($init))
		{
			$k = key($init);
			$output .= "<option value=\"$k\">{$init[$k]}</option>";
		}
		foreach((array)$list as $k => $v)
		{
			$output .= "<option value=\"{$k}\"";
			$output .= $k == $selected ? ' selected' : '';
			$output .= ">{$v}</option>";
		}
		$output .= "</select>";
		
		return $output;
		
	}
	
	function chks()
	{
		
	}
	function radio($name, $list, $attribute='', $selected='')
	{
		$output  = '';
		foreach((array)$list as $k => $v)
		{
			$output .= "<input type=\"radio\" name=\"{$name}\" id=\"{$name}\" {$attribute} value=\"{$k}\"";
			$output .= $k == $selected ? ' checked' : '';
			$output .= "/>{$v}";
		}
		return $output;
	}
}
?>