<?php
class DOFile
{
	public function __construct( )
	{
/*		$this->sourceRoot = $source;
		$this->targetRoot = $target;
		self::makeDir( $target );*/
	}
	
	public function copyDir( $source,$target )
	{
		if(!is_dir( $target )) self::makeDir( $target );
		foreach(glob($source.DS."*") as $v)
		{
			$t = $target.substr($v,strlen($source));

			if( is_dir( $v ) )
			{
				self::makeDir(  $t );
				self::copyDir( $v,$target );
			}
			else 
			{
				self::makeDir(  substr($t,0,strripos( $t ,DS)) );
				$this->copyFile( $v,$t );	
			}
		}
		
	}
	
	public function copyFile($source,$target)
	{
		if(is_dir( $target ))
		{
			copy( $source,$target."/".basename($source) );
		}
		else copy($source,$target);
	}
	
	public function makeDir($path)
	{
		$dirs = preg_split('#\\\\+|/+#',$path);
		$r	  = $dirs[0];
		for($i=1,$j=count($dirs);$i<$j;$i++)
		{
			$dir = $dirs[$i];
			$r  .= DS.$dir;
			if( !is_dir( $r ) )
			{
				mkdir( $r );
			}
			chmod( $r ,0777 );
		}
		return true;
	}
	public function Exist( $root,$file='' )
	{
		$path =  $file == '' ? $root : $root.DS.$file;

		return file_exists( $path );
	}
	public function run( $command , $args = array())
	{
		parent::command( $command );
	}

}
?>