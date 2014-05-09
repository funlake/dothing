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

		$url  = \Dothing\Lib\Uri::UrlAddParams(array());

		return "<a data-toggle='post' data-link='".$url."' class='sorter' data-key='order,sort' data-value='{$key},{$sort}' href='javascript:void(0);'>".$text."</a>";
	}
}
//TODO:
//<a data-toggle='post' data-key='order,sort' data-value='a.id,desc' data-link='url' href='javascript:void(0);'>text</a>
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
	function showStatus($flag,$model,$idval,$idkey='id')
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
/** delete icon in each row **/
if(!function_exists('showCfm'))
{
	function showCfm($id,$action='',$key='id',$redirect='',$message = 'Are you going to delete selected item(s)?')
	{
		if(empty($link))
		{
			$redirect = Url(\Dothing\Lib\Router::GetPageIndex());
		}
		//Url('autocrud/Delete/group');
		$yes 		= L('Confirm');
		$cancel  	= L('Cancel');
		$warning      = L('Warning');
		$q 		= L($message);
		$action 	= Url($action);
		$tpl = <<<TPL
		<a class="glyphicon glyphicon-trash" href="#" data-toggle="modal" data-target="#DOModal_{$id}"></a>
		<div class="modal fade" id="DOModal_{$id}">
			<div class="modal-dialog">
				<div class="modal-content">
					<form id="form{$id}" action="{$action}" method="post">
						<div class="modal-header">
							<a class="close" data-dismiss="modal">×</a>
							<h3>{$warning}</h3>
						</div>
						<div class="modal-body">
							<p>{$q}</p>
						</div>
						<div class="modal-footer">
							<a href="javascript:void(0);" onclick="jQuery('#form{$id}').submit()" class="btn btn-sm btn-sm btn btn-sm btn-sm-success">
								<i class="glyphicon glyphicon-ok glyphicon-white"></i>
								{$yes}
							</a>
							<a data-dismiss="modal" class="btn btn-sm btn-sm btn btn-sm btn-sm-warning">
								<i class="glyphicon glyphicon-remove glyphicon-white"></i>
								{$cancel}
							</a>
							<input type="hidden" name="__redirect" value="{$redirect}"/>
							<input type="hidden" name="id" value="{$id}"/>
						</div>
					</form>
				</div>
			</div>
		</div>
TPL;
		return $tpl;
	}
}