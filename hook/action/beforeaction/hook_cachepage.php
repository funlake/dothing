<?php
class hookCachepage extends DOHook 
{
	public function onBeforeaction()
	{
		if(DO_FILECACHE)
		{
			$admin = DOBase::get('backend');
			if($admin) $admin .= ".";
			
			$uri = & DOFactory::get('class',array('uri'));

			$fileName = implode('_',array($uri->module,$uri->controller,$uri->action,implode('_',$uri->params) ) ).".html";

			if( DOLoader::import('data.template.'.$admin.'page.'.$fileName))
			{
				return true;
				exit();
			}
		}
		else return;
	}
}
?>