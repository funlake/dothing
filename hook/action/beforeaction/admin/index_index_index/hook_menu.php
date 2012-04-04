<?php
class hookMenu extends DOBase 
{
	static public $MOD;
	static public $Jason;
	static public $Tree;
	function onBeforeaction()
	{
		/**
		* get all module's
		*/
		self::$MOD 		= DOModel::load('module');
		self::$Jason    = &DOFactory::get('com',array('json'));
		
		$modules 	= self::$MOD->getModules( null );
		//gen a tree data structure
		foreach( $modules  as $k=>$v)
		{
			self::$Tree[$v['module_pid']][] = $v;
		}
		//gen json.
		foreach( self::$Tree[0] as $k=>$v)
		{
			$subMenu = '';
			$icon    = '';
			$v      = array_map('addslashes', $v );
			$sub    = self::getSubMenus( $v['module_id'] , $v['module_code']);
			if( $sub != '[]') 
				$subMenu = ',menu:'.$sub; 
			if($v['module_icon'])
			{
				$icon   = ',icon:"'.DOUri::getRoot()."/data/images/module/".$v['module_icon'].'"';
			}
			$mods[$k] = "{text:'{$v['module_name']}'{$subMenu}{$icon}}"; 
		}
		parent::set('backModules',implode(',',$mods));
	}
	
	function getSubMenus( $pid,$moduleCode='' )
	{
		if(!!self::$Tree[ $pid ])
		{
			foreach( self::$Tree[ $pid ] as $k=>$v)
			{
				//<img class="x-menu-item-icon" src
				$url       = @call_user_func_array(array('DOUri','buildQuery'),explode(',',$v['module_url']));
				$subMods[] = array(
									   'text'=>$v['module_name']
									  ,'icon'=>DOUri::getRoot()."/data/images/module/".$v['module_icon']
									  ,'handler'=>"addTab({closable:true,id:'{$v['module_code']}',title:'{$v['module_name']}',html:'<iframe id=\"center-iframe\" frameborder=\"0\" style=\"width:100%;height:100%\" src=\"{$url}\"></iframe>'})"
								  );
			}
			$subMods[] = self::getCategory( $moduleCode );
			$json = self::$Jason->encode( $subMods );
			//format for fit javascript codes
			$json = preg_replace(
					array('#"(addTab\(\{.*?\}\))"#' , '#\\\\"#' ,'#\\\\/#')
				   ,array('function(){$1}','"','/')
				   ,$json);
			return $json ;
		}
		else return '[]';
	}
	
	function getCategory( $moduleCode )
	{
		
		$cateModel	= DOModel::load('category');
		//module data
		$cateData	= $cateModel->getCategory("module_code='".$moduleCode."'");

		$url        = DOUri::buildQuery('category','category','index','module_code='.$moduleCode);
		if(!!$cateData)
		{
			return array(
						   'text'=>$cateData['category_name']
						  ,'icon'=>DOUri::getRoot()."/data/images/module/".$v['module_icon']
						  ,'handler'=>"addTab({closable:true,id:'{$moduleCode}_cate',title:'{$cateData['category_name']}',html:'<iframe id=\"center-iframe\" frameborder=\"0\" style=\"width:100%;height:100%\" src=\"{$url}\"></iframe>'})"
						);
		}
		else return '';

	}
}
?>