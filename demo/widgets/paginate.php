<?php
class DOWidgetPaginate
{
	private static $pager = null;
	public function Create($type)
	{
		$params = func_get_args();
		DOLoader::Import('lib.paginate.workshop');
		if(!self::$pager)
		{
			self::$pager= new DOPaginateWS( $type );
		}
		@array_shift( $params );
		return self::$pager->GetEngine( $params );
	}
}
?>