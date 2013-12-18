<?php
class DOFileZip
{
	public static $_ctrlDirHeader 	= "\x50\x4b\x01\x02";
	public static $_fileHeader 		= "\x50\x4b\x03\x04";
	public static $_ctrlDirEnd 		= "\x50\x4b\x05\x06\x00\x00\x00\x00";
	
	//zip files
	public $zipF					= array();
	//zip dirs
	public $zipD					= array();
	
	function DOZip()
	{
			
	}
	//create zip files
	function zip( $zipPath , $files)
	{
		if( !!$this->zipF || !!$this->zipD) $this->clean();
		foreach ( $files as $file)
		{
			$this->addToZip( $file );
		}
		$this->zipPack( $zipPath );
	}
	//pack into zip file
	function zipPack( $zipPath )
	{
		$fs 	= count( $this->zipF );
		$ds 	= count( $this->zipD );
		
		$data 	= implode('',$this->zipF);
		$dir	= implode('',$this->zipD);
		
		$content[]	= $data . $dir . self::$_ctrlDirEnd;
		/* Total # of entries "on this disk". */
		$content[]  = pack('v', $ds ) ;
		/* Total # of entries overall. */
		$content[]  = pack('v', $ds ) ;
		/* Size of central directory. */
		$content[]  = pack('V', strlen($dir)) ;
		/* Offset to start of central dir. */
		$content[]  = pack('V', strlen($data)) ;
		/* ZIP file comment length. */
		$content[] = "\x00\x00";
		
		if( file_put_contents( $zipPath , implode('',$content)) )
		{
			return true;
		}
		return false;
	}
	/**
	 * Extract a ZIP compressed file to a given path using native php api calls for speed -- copy from joomla
	 *
	 * @access	private
	 * @param	string	$archive		Path to ZIP archive to extract
	 * @param	string	$destination	Path to extract archive into
	 * @param	array	$options		Extraction options [unused]
	 * @return	boolean	True if successful
	 * @since	1.5
	 */
	function unZip($archive, $destination, $options='')
	{
		if ($zip = zip_open($archive)) 
		{
			if (is_resource($zip)) 
			{
				$fileHandler = & DOFactory::get('com',array('file'));
				// Make sure the destination folder exists
				if (!$fileHandler->makeDir($destination)) 
				{
					echo 'Unable to create destination';
					return false;
				}
				// Read files in the archive
				while ($file = @zip_read($zip))
				{
					if (zip_entry_open($zip, $file, "r")) 
					{
						if (substr(zip_entry_name($file), strlen(zip_entry_name($file)) - 1) != "/") 
						{
							$buffer = zip_entry_read($file, zip_entry_filesize($file));
							
							if (file_put_contents($destination.DS.zip_entry_name($file), $buffer) === false) 
							{
								echo 'Unable to write entry';
								return false;
							}
							zip_entry_close($file);
						}
					} 
					else 
					{
						echo 'Unable to read entry';
						return false;
					}
				}
				@zip_close($zip);
			}
		} 
		else 
		{
			echo 'Unable to open archive';
			return false;
		}
		return true;
	}
	//write compress data into zipfile
	function addToZip( $files )
	{
		
		$VGC			= "\x14\x00" /* Version needed to extract. */
						 ."\x00\x00" /* General purpose bit flag. */
						 ."\x08\x00";/* Compression method. */
		$data 			= $files['data'];
		
		$name 			= str_replace("\\",'/',$files['name']);
		//time hanlder
		$dateTime 		= & DOFactory::get('com',array('datetime'));
		//zip time
		$ziptime 		= pack('V',$dateTime->unixToDos( $files['time'] ));
		
		$fileInfo[]   	= self::$_fileHeader;
		$fileInfo[]		= $VGC;
		$fileInfo[]     = $ziptime;/* Last modification time/date. */
		
		$dl				= strlen( $data );
		$crc			= crc32( $data ) ;
		$zdata			= gzcompress( $data );
		$zdata 			= substr(substr($zdata, 0, strlen($zdata) - 4), 2);
		$zlen			= strlen( $zdata );
		
		$commonInfo     = pack('V',$crc)			/* CRC 32 information. */
		    			. pack('V',$zlen)			/* Compressed filesize. */
		     			. pack('V',$dl)				/* Uncompressed filesize. */
		    			. pack('v',strlen( $name ))	/* Length of filename. */
		     			. pack('v',0);				/* Extra field length. */
		     			
		$fileInfo[]		= $commonInfo;
		$fileInfo[]     = $name;
		
		$fileInfo[]     = $zdata;
		
		$offset			= strlen(implode('',(array)$this->zipF));
		$this->zipF[] 	= implode('',$fileInfo);
		
		$dirInfo[]		= self::$_ctrlDirHeader;
		/* Version made by. */
		$dirInfo[]		= "\x00\x00" .$VGC;
		$dirInfo[]		= $ziptime;
		$dirInfo[]		= $commonInfo;
		$dirInfo[]		= pack('v', 0); /* File comment length. */
		$dirInfo[]		= pack('v', 0); /* Disk number start. */
		$dirInfo[]		= pack('v', 0); /* Internal file attributes. */
		$dirInfo[]		= pack('V', 32); /* External file attributes -'archive' bit set. */
		$dirInfo[]		= pack('V', $old_offset); /* Relative offset of local header. */
		
		$dirInfo[] 		= $name;
		
		$this->zipD[]  = implode('',$dirInfo);
	}
	
	function clean()
	{
		$this->zipD = $this->zipF = array();
	}
	
	
}
?>