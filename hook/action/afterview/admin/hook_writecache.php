<?php
/*write cache before load view**/
class hookWritecache extends DOHook
{
	public function onAfterview()
	{
		#print_r(parent::$env);		
		#$isAdmin = DOBase::get('backend');
		
		ob_start();
		include_once(TEMPLATE_ROOT.DS.'admin'.DS.'main.php');
		$mainHtml = ob_get_contents();
		ob_end_clean();
		$html	  = str_replace(array('{title}','{main}'),array('后台管理',parent::$env['arguments']['main']),$mainHtml);
		if(DO_FILECACHE)
		{
			DOLoader::import('lib.cache.cache');
			DOCache::write( $html );
		}		
		echo $html;
	}
} 
?>
