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
	/**
	*** Bind blocks with position in template file.
	*** @params : $pos -> position 
	**/
	public function Show( $pos )
	{
		/**
		**	1.Display cache block if we have
		**	2.Fetch blocks by $pos
		**	3.Display blocks one by one according to ordering
		**/	
		if($cache = self::GetCache( $pos ))
		{
			include $cache;
			return;
		}
		//Fetch blocks by position
		$blocks = self::Fetch( $pos );
		//Get current page
		$pages   = DOBlocksHelper::GetBlocksIndex();

		//Display blocks with it's specific layout according to current page.
		foreach( $pages as $page) 
		{
			$blocks[$page] && self::Invoke( explode(',',$blocks[$page]) );
		}
		return ;	
	}
	/**
	*** Invoke a function for display single block
	***/
	public function Invoke( $block )
	{
		foreach((array)$block as $key=>$block)
		{
			/** Get blocks and it's layout for this page**/
			list($blk,$lyt)	= explode(':',$block);	
			/** Include block file **/
			!empty($blk) && self::Import( $blk );
			/** Display it **/
			$blockClass = 'DOBlocks'.ucwords($blk);
			if(class_exists( $blockClass ))
			{
				$blockObj = new $blockClass();
				call_user_func(array($blockObj,'Display'),$lyt ? $lyt : 'default');	
			}
		}
		return true;	
	}
	/**
	*** Import a block
	***/
	public function Import( $block )
	{
		if(!self::$blocks[$block])
		{
			include BLKBASE.DS.$block.DS.$block.'.php'; 
			self::$blocks[$block] = true;
		}
	}
	/** Implement this later **/
	public function GetCache( $pos )
	{
		return false;
	}
	/** Blocks fetcher **/
	public function Fetch( $pos )
	{
		/** Do we have included configuration file before ? **/
		if(!self::$config)
		{//No for include action
			self::$config = include BLKBASE.DS.'config.php';
		}
		/** Get blocks by specific position **/
		return self::$config[$pos];
	}
}
class DOBlocksHelper
{
	/** Get index by current page **/
	public function GetBlocksIndex()
	{	
		return array(
			DORouter::$module."/".DORouter::$controller."/".DORouter::$action
		   ,DORouter::$module."/".DORouter::$controller."/*"
		   ,"*"
		); 
	}
}
?>
