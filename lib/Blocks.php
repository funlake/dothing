<?php
/**
** @author  : Lake
** @package : Block function
** @version : 1.0
**
**/
class DOBlocks
{
	/** For cache handler **/
	public $expire = 3600;
	/** Blocks config array **/
	private static $config = array();
	/** Blocks class array **/
	private static $blocks = array();

	private static $blocksInstant = array();
	/**
	*** Bind blocks with position in template file.
	*** @params : $pos -> position 
	**/
	public static function Show( $pos )
	{
		/**
		**	1.Display cache block if we have
		**	2.Fetch blocks by $pos
		**	3.Display blocks one by one according to ordering
		**/	
		$cache = self::GetCache($pos);
		if(!empty($cache))
		{
			include $cache;
			return;
		}
		//Fetch blocks by position
		$blocks = self::Fetch( $pos );
		//Get current page
		$pages   = DOBlocksHelper::GetBlocksIndex();
		//Display blocks with it's specific layout according to current page.
		if(!$blocks) return;
		foreach( array_keys($blocks) as $page) 
		{
			//Nagative jugdement
			if($page{0} === '!')
			{
				$reg  = substr($page,1);
				if(preg_match('#'.$reg.'#is',DORouter::GetPageIndex()))
				{
					continue;
				}
				else
				{
					self::Invoke( explode(',',$blocks[$page]) );
				}
			}
			else
			{
				$reg  = $page;
				if(preg_match('#'.$reg.'#is',DORouter::GetPageIndex()))
				{
					//Invoke blocks
					self::Invoke( explode(',',$blocks[$page]) );
				}
			}
		}
		return ;	
	}
	/**
	*** Invoke a function for single block displaying
	***/
	public static function Invoke( $blocks )
	{
		foreach((array)$blocks as $key=>$block)
		{
			/** Get blocks and it's layout for this page**/
			list($blk,$lyt)	= explode(':',$block);
			$lyt  			= !empty($lyt) ? $lyt : 'default';
			/** Include block file **/
			if(!empty($blk))
			{
				self::GetBlock($blk,$lyt)->Display($lyt);
			}
		}
		return true;	
	}

	public static function GetBlockName($block)
	{
		if(strpos($block,'.') !== false)
		{
			$block = implode('',array_map('ucwords',explode('.',$block)));
		}
		return ucwords($block);
	}
	/**
	*** Import a block
	***/
	public static function Import( $block ,$layout='')
	{
		$blkId = preg_replace('#[^a-z]#i','',$block);
		if(!self::$blocks[$blkId])
		{
			if(strpos($block,'.') !== false)
			{
				list($dir,$blk) = explode('.',$block);
				$file = BLKBASE.DS.$dir.DS.$blk.DS.$blk.'.php';
			}
			else
			{
				$file = BLKBASE.DS.$block.DS.$block.'.php'; 
			}
			if(!file_exists($file))
			{
				throw new DORouterException("Unknown block:[{$block}]", 404);
			}
			include_once $file;
			self::$blocks[$blkId] = self::GetLayout($block,$layout);
		}
	}

	public static function GetLayout($block,$layout)
	{
		$path 			= str_replace('.',DS,$block);
		$blockCover     = DO_THEME_DIR.DS.'blocks'.DS.$path.DS.$layout.DO_TEMPLATE_EXT;
		if(file_exists($blockCover))
		{
			return $blockCover;
		}
		else
		{
			return BLKBASE.DS.$path.DS.'layout'.DS.$layout.DO_TEMPLATE_EXT;
		}
	}
	/** Implement this later **/
	public static function GetCache( $pos )
	{
		return false;
	}
	/** Blocks fetcher **/
	public static function Fetch( $pos )
	{
		/** Do we have included configuration file before ? **/
		if(!self::$config)
		{//No for include action
			$path = TEMPLATEROOT.DS.DOTemplate::GetTemplate().DS.'block.config.php';
			/**Do we have blocks configuration file for specify template?**/
			if(file_exists($path))
			{/**Yes then use this one**/
				self::$config = include $path;
			}
			/**No for including global file**/
			else self::$config = include BLKBASE.DS.'config.php';
		}
		/** Get blocks by specific position **/
		return self::$config[$pos];
	}

	public static function GetBlocks()
	{
		return self::$blocks;
	}

	public static function GetBlock($pos,$layout = '')
	{
		self::import($pos,$layout);
		$blockClass = 'DOBlocks'.self::GetBlockName($pos);
		if(!class_exists($blockClass))
		{
			throw new Exception("Undefined Blcok:{$pos}");
		}
		if(!self::$blocksInstant[$blockClass])
		{
			self::$blocksInstant[$blockClass] = new $blockClass();
		}
		return self::$blocksInstant[$blockClass];
	}
}
class DOBlocksHelper
{
	/** Get index by current page **/
	public static function GetBlocksIndex()
	{	
		return array(
		    DORouter::$module."/".DORouter::$controller."/".DORouter::$action
		   ,DORouter::$module."/".DORouter::$controller."/*"
		   ,DORouter::$module."/*"
		   ,".*"
		); 
	}
}
?>
