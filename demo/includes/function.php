<?php
if(!function_exists('DOMakeSortHead'))
{
	function DOMakeSortHead($key,$text)
	{
		$revert = array(
			'asc' 	=> 'desc',
			'desc'	=> 'asc'
		);
		$sort = isset($_REQUEST['_dosort']) ? $_REQUEST['_dosort'] : '';
		$sort = !empty($sort) ? $revert[$sort] : 'desc';

		$url  = DOUri::UrlAddParams(array('_doorder'=>$key,'_dosort'=>$sort));

		return "<a href='".$url."'>".$text."</a>";
	}
}
/** string cuter **/
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

/** publish/unpublish tick style **/
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
/** edit icon in each row **/
if(!function_exists('showEditLink'))
{
	function showEditLink($query,$baseurl)
	{
		$link = Url($baseurl,$query);
		$final =  <<<editlink
		<a class="glyphicon glyphicon-edit" href="{$link}">
		</a>
editlink;
		return $final;
	}
}