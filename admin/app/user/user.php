<?php
class DOUser extends DOController  
{
	function indexAction()
	{
		/**
		 * list all user here.
		 */
				//grid
		$dataConfig['用户名'] 		= 'user_name:40';
		$dataConfig['用户组'] 		= 'group_name:40';
		
		//$dataUrl,$formUrl,$actionUrl='',$key,$headerConfig,$id='ext',$title=''
		//DOLoader::import('include.extjs.grid.grid');
		
		$this->grid			= & DOFactory::get('extjs',array(
								'grid'
								,DOUri::buildQuery('user','user','data')
							  	,DOUri::buildQuery('user','user','edit')
							  	,' '
							  	,array('user_id')
								,$dataConfig)
							);
		$this->grid->unregisterButton(DOLang::get('g_edit','编辑'));
		$this->loadView();
	
	}
	function devlistAction()
	{

		//grid
		$dataConfig['部门'] = 'department:40';
		$dataConfig['操作'] = 'action';
		//$dataUrl,$formUrl,$actionUrl='',$key,$headerConfig,$id='ext',$title=''
		//DOLoader::import('include.extjs.grid.grid');
		
		$this->grid			= & DOFactory::get('extjs',array(
								'grid'
								,DOUri::buildQuery('user','user','devdata')
							  	,DOUri::buildQuery('user','user','devdata')
							  	,' '
							  	,array('user_id')
								,$dataConfig)
							);
		$this->loadView();

		//tree
		
		//$this->treeLayout = & DOFactory::get('extjs',array('treelayout'));
		//$this->loadView('treelayout');
		
	}
	
	function devdataAction()
	{
		$ext = & DOFactory::get('extjs',array('data'));
		$res = array(array(
			'department' => "人事科"
		   ,"action"     => "..."
		));
		$ext->dumpGridData($res);
	}
	
	function dataAction()
	{
		$ext = & DOFactory::get('extjs',array('data'));
		$db  = & DOFactory::get('dbo');
		$sql = "select u.*,u2.group_id,u2.group_name from `user` u "
			  ."left join user_group u2 on u2.user_id=u.user_id "
			  ."left join group g on g.group_id=u2.group_id "
			  ."order by g.ordering desc";
		$R   = $db->query( $sql );
		
		$ext->dumpGridData($R->data);
	}
	
	//组
	function groupAction()
	{
		
	}
}
?>
