<?php
namespace Dothing\Lib\File;
class Image
{

	function __construct()
	{
/*		$this->sorceFile = $sorceFile;
		$this->targetFile= $targetFile;
		//width resize to
		$this->rWidth    = $rWidth;
		//height resize to
		$this->rHeight   = $rHeight;
		//handler function
		$this->handler   = '_'.strtoupper($type);*/
	}
	
	function createFrom( $image='' )
	{
		if(!file_exists( $image )) return;
		if( $image )
		{
			$i  = pathinfo( $image );

			$ii = $i['extension'];

			switch( $ii )
			{
				case 'png':
					$im = imagecreatefrompng( $image );
					$this->saveFunction = 'imagepng';
				break;
				
				case 'gif':
					$im = imagecreatefromgif( $image );
					$this->saveFunction = 'imagepng';
				break;
				
				case 'bmp':
					$im = imagecreatefromwbmp( $image );
					$this->saveFunction = 'imagewbmp';
				break;
				
				default:
					$im = imagecreatefromjpeg( $image );
					$this->saveFunction = 'imagejpeg';
				break;
			}
		}
		return $im;
	}
	
	function createNew( $width,$height)
	{
		$im = imagecreatetruecolor( $width,$height );
		return $im;		
	}
	//resize
	function Resize($rWidth,$rHeight,$width,$height)
	{
		return array($rWidth,$rHeight,$width,$height);
	}
	//cut
	function Cut( )
	{
		//resize ratio
		$r 	= $this->rWidth/$this->rHeight;
		$wh = $this->getImageInfo( $this->sourceFile );
		//ratio
		$o  = $wh['width']/$wh['height'];
		$resizeArray =  $r > $o ? array($this->rWidth,$this->rHeight,$wh['width'],$wh['width']/$r)
			   		   			: array($this->rWidth,$this->rHeight,$wh['height']*$r,$wh['height']);
		$im = $this->createFrom( $this->sourceFile );

		$bg = $this->createNew( $this->rWidth, $this->rHeight );
		if(function_exists('imagecopyresampled'))
		{
			imagecopyresampled($bg,$im,0,0,0,0,$resizeArray[0],$resizeArray[1],$resizeArray[2],$resizeArray[3]);
		}
		else return;
		$this->save($bg,$this->targetFile,'100');
		imagedestroy($im);
		imagedestroy($bg);
	}
	
	function water()
	{
			
	}
	function save( )
	{
		$args = func_get_args();
		call_user_func_array($this->saveFunction,$args);
	}
	function getImageInfo( $image )
	{
		$r = array();
		list($r['width'],$r['height'],$r['type'],$r['attr'],$r['bit'],$r['channel'],$r['mime']) = getimagesize( $image );
		return $r;
	}
	/**
	 * -s sourcefile_path
	 *
	 * @param unknown_type $sourceFile
	 */
	function _s( $sourceFile )
	{
		$this->sourceFile = $sourceFile;
	}
	/**
	 * -t target_file
	 *
	 * @param unknown_type $targetFile
	 */
	function _t( $targetFile)
	{
		$this->targetFile = $targetFile;
	}
	/**
	 * -w resize_width
	 *
	 * @param unknown_type $width
	 */
	function _w( $width=188 )
	{
		$this->rWidth = $width;
	}
	/**
	 * -h resize_height
	 *
	 * @param unknown_type $height
	 */
	function _h( $height=147 )
	{
		$this->rHeight = $height;
	}
	/**
	 * -c image handler name
	 *
	 * @param unknown_type $handler
	 */
	function _c( $p='')
	{
		$this->handler = '_cut';
	}
}
?>