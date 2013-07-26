<?php
/**
**Template render class
**@author lake
**/
ini_set("pcre.backtrack_limit", "23001337");
ini_set("pcre.recursion_limit", "23001337");
class DOTemplate
{
	public static $params 	= array();
	public static $template	= DO_TEMPLATE;
	public static $layout        = "index";
	public static function SetPrams($params)
	{
		foreach($params as $key=>$val) self::SetParam($key,$val);
	}
	
	public static function SetParam($key,$val)
	{
		$key = strtolower($key);
		self::$params[$key] = $val;
	}
	public static function SetTemplate( $template )
	{
		self::$template = $template ;
	}
	public static function SetLayout($layout)
	{
		self::$layout 	= $layout;
	}
	public static function SetTemplateUriPath($template)
	{
		!defined('DO_URI_BASE') AND define('DO_URI_BASE',DOUri::GetBase());
	 	!defined('DO_THEME_BASE') AND define('DO_THEME_BASE',DO_URI_BASE.'/templates/'.$template);
	 	!defined('DO_THEME_DIR') AND define('DO_THEME_DIR',TEMPLATE_ROOT.DS.$template);	
	}
	public static function GetTemplate()
	{
		return self::$template;
	}
	public static function GetLayout()
	{
		return self::$layout;
	}
	public static function LoadTemplate( )
	{
		$template = self::GetTemplate();
		$cFile	= TEMPLATE_ROOT.DS.$template.DS.self::GetLayout().'.php';
		$vFile  = TEMPLATE_ROOT.DS.$template.DS.self::GetLayout().'.tpl.php';
		if(file_exists($vFile))
		{
			$content = file_get_contents($vFile);
			$content = self::ParseTemplate($content,$cFile);
		}
		include $cFile;
		return;
	}

	public static function ParseTemplate($content,$path = '')
	{
		$content 		= self::Parse($content,null,null);
		if(!empty($path))
		{
			$fileHandler	= DOFactory::GetTool('file.basic');
			$fileHandler->Store($path,$content); 
		}
		return $content;
	}
	/**
	**Core function,use to hook all elements we want to display in template
	**/
	public static function _()
	{
		$args 	= func_get_args();
		$type	= strtolower(array_shift($args));
		echo call_user_func_array(array(self,'Get'.ucwords($type)),$args);
	}
	public static function SetTitle( $title )
	{
		self::$params['title'] = $title;
	}

	public static function SetModule($module)
	{
		self::$params['module'] = $module;
	}
	public static function GetBlock( $pos )
	{
		$pos = strtolower( $pos );
		/**We probably need to adjust specific block in a controller**/
 		DOHook::TriggerEvent(
			array(
				'beforeRenderBlock'.ucwords($pos) => array(self::$params)
			)
		);
		/** Display blocks according to related position **/
		ob_start();	
		DOBlocks::Show($pos);
		$blockContent = ob_get_clean();
 		self::$params["blocks"][$pos] .= $blockContent;
 		/**We probably need to adjust specific block in a controller**/
		DOHook::TriggerEvent(
			array(
				'afterRenderBlock'.ucwords($pos) => array($blockContent)
			)
		);
		return self::$params['blocks'][$pos];
	}
	
	public static function GetModule()
	{
		return self::$params['module'];
	}
	
	public static function GetTitle()
	{
		return self::$params['title'];
	}
	public static function ParseHtml($tplfile,$variables = array())
	{
		return self::Parse(file_get_contents($tplfile),null,$variables);
	}
	public static function Parse($content,$innerData = '',$variables,$level=0)
	{
		/**==<div:paginate=google|<?php echo M('user')->Count();?> />==**/
		return preg_replace(
			array(
				'#<(\w+):loop=([^>]+)>(.*)</\1:loop>#ise'
			  ,'#<(\w+):paginate(/\w+)?=([^>]+)/>#ise'
			   ,'#<(module|block):(\w+)\s*/>#is'
			   
			)
		   ,array(
		   		'self::LoopParse("\2","\3",$innerData,"\1",$variables,$level)'
		   	   ,'self::PaginateParse("\1","\3","\2")'
		   	   ,'<?php echo T("\1","\2");?>'
		   	)
		,$content);
	}
	public static function PaginateParse($tag,$src,$type='')
	{
		list($source,$attrs) = preg_split("#\s+#",$src,2);
		$data = self::GetSource($source,array());
		$type  = !empty($type) ? trim($type,'/') : 'default';
		$pageInstance = <<<EOD
		<?php
		 \$pager = DOFactory::GetWidget('paginate','{$type}', {$data},DO_LIST_ROWS);
		 echo \$pager->Render();
		 ?>
EOD;
		return "<".$tag." ".$attrs.">"
		.$pageInstance.
		"</".$tag.">";
	}
	public static function LoopParse($attr,$content,$innerData = '',$tag,$variables,$level)
	{
		list($source,$attrs) = preg_split("#\s+#",$attr,2);
	//	$innerData 			 = (array)$innerData;
		$html = array();
		if(!empty($source))
		{
			if(!empty($innerData))
			{
				$data = $innerData.'["'.$source.'"]';
			}
			else
			{
				$data = self::GetSource($source,$variables);
			}
			$keyChar 	= '$key_'.$level;
			$itemChar	= '$item_'.$level;
			$html[]     = str_pad("",($level+1)*4,"\t",STR_PAD_LEFT);
			$html[] 	= PHP_EOL.'<'.'?php'.' foreach('.$data.' as '.$keyChar.'=>'.$itemChar.') : ?'.'>'.PHP_EOL;
			$html[]     = '<'.'?php'.' '.$itemChar.'=(array)'.$itemChar.'; ?'.'>'.PHP_EOL;
			//foreach((array)$data as $item)
			//{
				$template = $content;
				if(strpos($template,":loop=") !== false)
				{
					$template = self::Parse($template,$itemChar,$variables,++$level);
				}
				$item 	= (array)$item;
				//===========have to consider 2 situations.===================
				#1.{#var}
				#2.{#var|substr(?,0,10)}
				$html[] = preg_replace('~{#([^@}]+)(@)?(?(2)([^\}]+))}~se'
					,"self::ReplaceVar('\\1','{$itemChar}','\\3')"
					,$template);
			//}
			$html[]     = str_repeat("\t",$level+1);
			$html[]     = PHP_EOL.'<?php endforeach;?>'.PHP_EOL;
		}
		if(count($html))
		{
			return stripslashes("<".$tag." ".$attrs.">".implode("",$html)."</".$tag.">");
		}
		return "";
	}
	/** replace tempate var  **/
	public static function ReplaceVar($var,$itemChar,$func)
	{
		if(!empty($func))
		{
			if(strpos($func,"?") !== false)
			{
				$final = str_replace('?',$itemChar.'[\''.$var.'\']',$func);
				$final = preg_replace('~#(\w+)~',$itemChar."['\\1']",$final);
			}
			else
			{
				$final = $func."(".$itemChar.'[\''.$var.'\']'.")";
			}
		}
		else
		{
			$final = $itemChar.'[\''.$var.'\']';
		}
		return '<?'.'php'.' echo '.$final.'?'.'>';
	}
	public static function GetSource($source,$variables)
	{
		if(strpos($source,".") !== false)
		{//Read data from outside
			list($type,$core,$action) 	= sscanf($source,"%[^|]|%[^.].%s");
			$_method 			  		= "Get".ucwords(strtolower($type))."Constant";
			$handler			  		= call_user_func(array(__CLASS__,$_method),$core);
			$rs					  		= $handler.'->'.$action.'()';
			// if($type == 'Model')
			// {
			// 	$variables[$core.".count"]	= $handler.'->'.'Count()';
			// }
			return $rs;
		}
		else if(strpos($source,"|") !== false)
		{
			list($class,$method) = sscanf($source,"%[^|]|%s");
			$className		   = "DO".ucwords(strtolower($class));
			if(class_exists($className))
			{
				return $className."::".$method."()";
			}
		}
		else
		{
			return preg_replace('~\{#([^{}]+)\}~','$\1',$source);
		}
	}

	public static function GetModelConstant($model)
	{
		return "DOFactory::GetModel(strtolower('".$model."'))";
	}

	public static function GetBlockConstant($pos)
	{
		$pos = array_map('strtolower',explode("/",$pos));
		$pos = implode(".",$pos);
		return "DOBlocks::GetBlock('".$pos."')";
	}
}
?>
