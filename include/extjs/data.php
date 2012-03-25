<?php
!defined('DO_ACCESS') && die('不允许直接访问此页面!');
class DOExtData
{
	function __construct(){}
	/**
	 * 输出后台数据
	 *
	 * @param unknown_type $res
	 */
	public function dumpGridData( $res='' )
	{
		$json = & DOFactory::get('com',array('json'));

		echo $_GET['callback'].'({"total":"'.$total.'","results":'.$json->encode($res).'})'; 
	}
	/**
	 * 输出成功/错误信息
	 *
	 * @param unknown_type $flag
	 * @param unknown_type $msg
	 * @param unknown_type $fn
	 */
	public function dumpMsg($flag = 0 , $msg='' , $fn='')
	{
		echo '{"flag":"'.$flag.'","msg":"'.$msg.'","fn":"'.$fn.'"}';
	}
	/**
	 * dump ext tree json data .
	 *
	 * @param unknown_type $type
	 */
	public function dumpTreeData( $type = 'module' )
	{
		$node 	= $_REQUEST['node'] ? trim($_REQUEST['node']) : "";
		$nodes	= explode('|',$node);
		switch ( $type )
		{
			//导出模块树
			case 'module' : 
				$Mod = DOModel::load('module');
				$nid = $nodes[count($nodes)-1];
				$nid = is_numeric($nid) ? $nid : 0;
				$res = $Mod->getModules($nid,$nodes[0]);
				foreach((array)$res as $k=>$v)
				{
					$data[] = array(
						   'text'=>$v['module_name']
						   ,'id'=>$node.'|'.$v['module_id'] 
						   ,'cls'=>'file'
						   ,'leaf' => $v['module_pid'] ? true : false
						   ,"link"=>DOUri::buildQuery('module','module','edit','id='.$v['module_id'].'&pid='.$v['module_pid'])
						   ,'menu_link_add'	=>	DOUri::buildQuery('module','module','add','id='.$v['module_id'].'&pid='.$v['module_pid'].'&task=add')
						   ,'menu_link_edit'=>	DOUri::buildQuery('module','module','edit','id='.$v['module_id'].'&pid='.$v['module_pid'].'&task=edit')
						   ,'menu_link_del'	=>  DOUri::buildQuery('module','module','delete','id='.$v['module_id'].'&pid='.$v['module_pid'].'&task=delete&_token='.md5(uniqid()))
						   ,'icon'			=>  DOUri::getRoot().'/data/images/module/'.($v['module_icon'] ? $v['module_icon'] : 'module.png')
					);
				}
			break;
		}
		$json = & DOFactory::get('com',array('json'));
		
		echo $json->encode($data);
		
	}
}

?>