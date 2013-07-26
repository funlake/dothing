<?php
if(!function_exists('DOMakeTick'))
{
	function DOMakeTick($state)
	{
		if($state)
		{
			return '<a class="icon-ok" href="javascript:void(0)"></a>';
		}
		else
		{
			return '<a class="icon-remove" href="javascript:void(0)"></a>';
		}
	}
}

if(!function_exists('DOMakeSortHead'))
{
	function DOMakeSortHead($key,$text)
	{
		$revert = array(
			'asc' 	=> 'desc',
			'desc'	=> 'asc'
		);
		$sort = $_REQUEST['_dosort'];
		$sort = !empty($sort) ? $revert[$sort] : 'desc';

		$url  = DOUri::UrlAddParams(array('_doorder'=>$key,'_dosort'=>$sort));

		return "<a href='".$url."'>".$text."</a>";
	}
}
