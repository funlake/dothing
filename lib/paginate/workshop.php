<?php
Class DOPaginateWS 
{
	public function __construct( $drive )
	{
		$this->drive = $drive;
	}

	public function GetEngine( $args )
	{
		$path = FRAMEWORK_ROOT.DS.'lib'.DS."paginate".DS.$this->drive.DS.$this->drive.".php";
		if(file_exists( $path ))
		{
			include_once $path;
			$class	= 'DOPaginate'.ucwords(strtolower($this->drive));
			//$ref		= new ReflectionClass( $class );
			//return call_user_func(array($ref,'newInstanceArgs'),$args );
			return new $class();
		}
	}	
}

?>
