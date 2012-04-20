<?php
class DOHtml
{	
	function Load( $pos,$args = array() )
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
	
	function Nead()
	{

	}
	function Title()
	{
		
	}
	
	function Footer()
	{
		
	}
	function W3c()
	{
		
	}
	//navigation
	function Nav($total,$rowPerPage,$page = 1)
	{
		//include pager template
		
	}
	function AddTag($tag,$attributes,$innerValue='',$endTag=1)
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
	/** Select List **/
	function SelectList($name, $list, $init='', $selected='',$attribute='class="selects"')
	{
		$output  = '';
		$output .= "<select name='{$name}' id='{$name}' {$attribute}>";
		if (is_array($init))
		{
			$k = key($init);
			$output .= "<option value='{$k}'>{$init[$k]}</option>";
		}
		foreach((array)$list as $k => $v)
		{
			$output .= "<option value='{$k}'";
			$output .= $k == $selected ? ' selected' : '';
			$output .= ">{$v}</option>";
		}
		$output .= "</select>";
		
		return $output;
		
	}
	/** CheckBox list **/
	function CheckBoxList($name,array $list = null ,array $attrArray = null,$selected = '')
	{
		$output = array();
		foreach($attrArray as $key=>$value)
		{
			$attr[] = $key."='".addslashes($value)."'";
		}
		if(!!$attr) $attrs = implode(" ".$attr);
		$checked[$selected] = 'checked';
		foreach($list as $val=>$text)
		{
			$output[] = "<input type='checkbox' 
								name='{$name}' 
								id='{$name}_{$val}' 
								value='{$val}' 
								{$checked[$val]} 
								{$attrs}
						/>".$text;
		}
		return implode('',$output);
	}
	/** Radio list **/
	function RadioList($name,array $list = null ,array $attrArray = null,$selected = '')
	{
		return preg_replace("#type='checkbox'#i","type='radio'"
			  		,call_user_func_array(array(self,"CheckBoxList"),func_get_args())
		);
	}
}
?>