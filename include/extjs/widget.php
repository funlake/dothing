<?php
class DOExtWidget
{
	function __construct(){}
	/**
	 * Make a drop down menu (select list)
	 *
	 * @param string $name the name of select list
	 * @param array $list  the option of select list
	 * @param array $init  the init list
	 * @param string $attribute the attribute of select list
	 * @param string $selected the selected index of the select list
	 * @return the select list
	 */
	function combo($name,$list,$onChange='',$init='', $attribute='',$selected='',$width='')
	{
		$variable = preg_replace('#[^a-zA-Z0-9_-]#','',$name);
		if(!empty($selected))
		{
			$jsStr = "{$variable}_select_list.setValue(\"{$list[$selected]}\");";
		}
		if(!empty($width)){
			$widthStr = "width:{$width},\n"; 	
		}
		$output  = '';
	
		$output .= "<select name=\"{$name}\" id=\"{$name}\" {$attribute}>\n";
		if (is_array($init))
		{
			$k = key($init);
			$output .= "<option value=\"{$k}\">{$init[$k]}</option>";
		}
		if (($list)) {
			foreach($list as $k => $v)
			{
				$output .= "<option value=\"{$k}\"";
				$output .= $k == $selected ? " selected" : "";
				$output .= ">{$v}</option>\n";
			}
		}
		
	
		$output .= "</select>\n";
		$output .= <<<extjs
		<script type="text/javascript">
		var {$variable}_select_list; 
		Ext.onReady(function(){
		  var _this = Ext.get("{$name}").dom;
		  {$variable}_select_list = new Ext.form.ComboBox({
				typeAhead: true,
				triggerAction: "all",
				transform:"{$name}",
				{$widthStr}
				forceSelection:true,
				form:_this.form,	
				//readOnly:true,
				editable:false,
				selectOnFocus:true	
				{$attribute}
		    });
		    {$jsStr}\n
		 
		    
		    {$variable}_select_list.on("select",function(o,i,sv){
	
				this.text = eval(i.json)[1];
				var selectedIndex = 0;
				this.options = [];
				this.options[selectedIndex] = {};
				this.options[selectedIndex].text = this.text;
				{$onChange}
		    });
		    {$variable}_select_list.reset();
		  }
		  
	    );
	    </script>
extjs;
		return $output;
	}
	/**
	 * list images under folder
	 *
	 * @param $name //select's name 
	 * @param $dir // http path 
	 * @param $initPic //selected img
	 * @param $url // img's url
	 * @param $noPic
	 * @return list html
	 */
	function listDirImg($name,$dir,$url='',$initPic='',$noPic='unknown.gif')
	{
		foreach((array)glob($dir.'/{*.gif,*.jpg,*.png,*.bmp}', GLOB_BRACE) as $imageFiles)
		{
			$file = preg_replace('/[\s\S]*\/(.[^\/]+)$/i','$1',$imageFiles);
			$images[$file]  = $file;
			if($file == $initPic)
			{
				$selectedPic = $file;
			}
		}
		//if(!$selectedPic) $selectedPic = $noPic;
		$imgJs= <<<js
			<script type="text/javascript">
				function changeIcon(v)
				{
					document.getElementById("s_{$name}_img").src = '{$url}'+v;
				}
			</script>
			<style>
				.x-menu-item-icon
				{
					position:static;
				}
			</style>
js;
		$imgTag = "<image id='s_{$name}_img' src='{$url}{$selectedPic}' />";
		$moduleImageSelectList =  self::combo($name,$images,'changeIcon(this.value)','',',width:345,tpl: \'<tpl for="."><div class="x-combo-list-item" ext:qtip="&lt;img src=\\\''.$url.'{text:htmlEncode}\\\' /&gt;"><img src="'.$url.'{text:htmlEncode}" class="x-menu-item-icon" />{text:htmlEncode}</div></tpl>\'',$selectedPic);
		return $imgJs.$moduleImageSelectList.$imgTag;
	}
}

?>
