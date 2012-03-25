<?php
!defined('DO_ACESS') OR exit(DOLang::get('g_notaccess','不可直接访问本页面!'));
class DOModel_category extends DOModel 
{
	public function getCategory( $where='1' )
	{
		if(!$where) $where = '1'; 
		
		$Cate = parent::table('category');
		
		return $Cate->getRow('*',$where);
	}
}
?>