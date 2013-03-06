<?php
DOLoader::Import('lib.paginate.paginate');
Class DOPaginateWS 
{
	public function __construct( $drive )
	{
		$this->drive = $drive;
	}

	public function GetEngine( $args )
	{
		//template
		$path = DO_THEME_BASE.DS.'cover'.DS.'paginate.php';
		if(file_exists($path))
		{
			include $path;
			return call_user_func_array(
				array(new ReflectionClass('DOPaginateTempate'),'newInstance')
			   ,$args
			); 
						
		}
		//core
		$path = FRAMEWORK_ROOT.DS.'lib'.DS."paginate".DS.$this->drive.DS.$this->drive.".php";
		if(file_exists( $path ))
		{
			include $path;
			$class	= 'DOPaginate'.ucwords(strtolower($this->drive));
			return call_user_func_array(
					array(new ReflectionClass( $class ),'newInstance')
				   ,$args
				); 
			}
	}	
}
