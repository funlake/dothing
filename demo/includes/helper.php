<?php
if(!function_exists('showStatus'))
{
	function showStatus($flag,$model,$idval,$idkey='')
	{
		$pu = array('unpublish','publish');
		return "<a class='".$pu[$flag]." status_trigger' src='".Url(
			'autocrud/Update/status',
			'state='.(1-$flag).'&_m='.$model.'&_k='.$idkey.'&_v='.$idval
			.'&__ajax=1&_no_token=1'
			)
		."' href='javascript:void(0);'></a>";
	}
}
if(!function_exists('cutStr'))
{
	function cutStr($string,$length,$encoding=DO_CHARSET)
	{
		$cs = mb_substr($string,0,$length,$encoding);
		if(strlen($cs) < strlen($string))
		{
			$cs .= "...";
		}
		return $cs;
	}
}
