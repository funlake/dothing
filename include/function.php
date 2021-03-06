<?php

function DOSetArrVal($varname,$path,$value)
{
	preg_replace('##e','DOBase::$vars['.$varname.']['.implode('][',$path).']="'.$value.'"','');
}

function DOHtmlSubstr($str,$start,$len=0)
{
	$tag = 0;
	$j = $i = $len ? $start : 0;

	while( ($c = $str[$i++]) && $j < $start + $len ) 
	{
		if( $c == '<') $tag = 1;
		elseif($c == '>')
		{
			$tagname 		 = explode(' ',trim($tg,'/'),2);
			$tagname         = $tagname[0];
			$is_end_hasopen  = strpos($tg,'/') === 0;
			$is_end_noopen   = $str[$i-2] == '/';
			if($is_end_hasopen)
			{
				$n  = count($temArr['<'.$tagname.'>']);
				if($temArr['<'.$tagname.'>'][1])
				{
					$tgsk 			= $temArr['<'.$tagname.'>'][$n-2];
					$tgs[$tgsk]		= array_merge(array($temArr['<'.$tagname.'>'][1]),$tgs[$tgsk] ? $tgs[$tgsk] : array());
					$tgs[$j-1][]    = '<'.$tg.'>'; 
				}
				unset($temArr['<'.$tagname.'>'][$n-2]);	
				unset($temArr['<'.$tagname.'>'][$n-1]);	
			}
			elseif($is_end_noopen)
			{
				$tgs[$j-1][] 		 = '<'.$tg.'>';  
				unset($temArr['<'.$tagname.'>']);	
			}
			else 
			{
				$temArr['<'.$tagname.'>'][] = $j-1;
				$temArr['<'.$tagname.'>'][] = '<'.$tg.'>';
			}
			$tag = 0;
			$tg  = '';
		}
		elseif($tag == 1) $tg .= $c;
		else $tmp[$j++] = $c;
	}
	foreach($tmp as $k=>$v)
	{
		$bh = '';
		foreach((array)$tgs[$k] as $k2=>$v2)
			$bh = $bh.$v2;
		$s .= $v.$bh;
	}
	return $s;
}

function DOFormToken()
{
	$id = md5(uniqid(rand(),true));
	$_SESSION['s_token'][$id] = true ;
	return $id;
}

function DOPrint($var,$halt=true)
{
	echo "<pre>";
	print_r($var);
	echo "</pre>";
	if($halt) exit();
}

function DOUnicode2Utf8($hex)
{
        $dec = hexdec($hex);
        $ds  = decbin($dec);
        switch($dec):
                case $dec <= 0x007f :
                        return chr( bindec(sprintf("%08s",$ds)));
                break;
                case $dec >= 0x0080 && $dec <= 0x07ff :
                        return chr($dec >> 6 | 0xc0)
                              .chr(bindec(substr($ds,-6)) | 0x80);
                break;
                case $dec >= 0x0800 && $dec <= 0xffff :
                        return
                                chr($dec >> 12 | 0xe0)
                               .chr(bindec(substr(decbin($dec >> 6),-6)) | 0x80)
                               .chr(bindec(substr($ds,-6)) | 0x80);
                break;
                case $dec >= 0x10000 && $dec <= 0x10ffff :
                        return
                                chr($dec >> 24 | 0xf0)
                               .chr(bindec(substr(decbin($dec >> 12),-6)) | 0x80)
                               .chr(bindec(substr(decbin($dec >> 6),-6)) | 0x80)
                               .chr(bindec(substr($ds,-6)) | 0x80);
                break;
        endswitch;
}
/**
 * Strip slash
 */

function DOStripslashes(&$item)
{
	if (is_array($item))
	{
		array_walk($item, 'DOStripslashes');
	}
	else
	{
		$item = stripslashes($item);
	}
	return $item;
}

function GetMessageType($type)
{
	$types = array(
	   0 => 'danger'
	   ,1 => 'success'
	   ,2 => 'info'
	   ,3 => 'warning'
	);
	return $types[$type];
}


function M($mod)
{
	static $m = array();
	if(!array_key_exists($mod, $m))
	{
		$class = '\Application\Models\\'.ucwords(strtolower($mod));
		$m[$mod] = new $class();
	}
	return $m[$mod];
}

function T($type,$pos)
{
	return \Dothing\Lib\Template::_($type,$pos);
}

function L($langVar)
{
	return \Dothing\Lib\Lang::Get($langVar);
}

function Url($dir,$params ='')
{
	$query = '';
	if(!!$params)
	{
		if(is_array($params))
		{
			$query = http_build_query($params);
		}
		else
		{
			$query = $params;
		}
	}
	
	$args 	= explode('/',$dir);
	$args[] = $query;
	return call_user_func_array(array('\Dothing\Lib\Uri',"BuildQuery"),$args);
}
//Session Set
function SS($var,$val)
{
	$session = \Dothing\Lib\Factory::GetSession();
	if($val === null)
	{
		$session->Clean($var);
	}
	else $session->Set($var,$val);
}
//Session Get
function SG($var)
{
	$session = \Dothing\Lib\Factory::GetSession();
	return $session->Get($var);
}
?>
