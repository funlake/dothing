<?php 
class DOLang extends DOBase 
{
	public function get($param,$content,$lang='ZH-cn')
	{
		//保留接口以扩展.
		if(!!$content) return $content;
	}
}
?>