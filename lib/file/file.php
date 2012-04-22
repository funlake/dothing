<?php
class DOFile
{
	public function __construct( )
	{
/*		$this->sourceRoot = $source;
		$this->targetRoot = $target;
		self::makeDir( $target );*/
	}
	
	public function CopyDir( $source,$target )
	{
		if(!is_dir( $target )) self::MakeDir( $target );
		foreach(glob($source.DS."*") as $v)
		{
			$t = $target.substr($v,strlen($source));

			if( is_dir( $v ) )
			{
				self::MakeDirv(  $t );
				self::CopyDir( $v,$target );
			}
			else 
			{
				self::MakeDir(  substr($t,0,strripos( $t ,DS)) );
				$this->CopyFile( $v,$t );	
			}
		}
		
	}
	public function CopyFile($source,$target)
	{
		if(is_dir( $target ))
		{
			copy( $source,$target."/".basename($source) );
		}
		else copy($source,$target);
	}
	
	public function MakeDir($path)
	{
		if(version_compare(PHP_VERSION,'5.0.5','>'))
		{
			return @mkdir($path,0777,true);
		}
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
			@chmod( $r ,0777 );
		}
		return true;
	}
	
	public function MakeFile($path)
	{
		$dir = preg_replace('#/'.basename($path).'$#','',$path);
		self::MakeDir($dir);
		return touch($path);
	}
	public function Exist( $root,$file='' )
	{
		$path =  $file == '' ? $root : $root.DS.$file;

		return file_exists( $path );
	}

}
?>