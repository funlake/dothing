<?php
DOLoader::Import('widgets.tree.class');
class DOWidgetTreeDefault extends DOWidgetTree
{
	public $idName 		 = 'id';
	public $pidName		 = 'pid';
	public $treeArray	 = array();
	/**node ui*/
	public $rootChar	 = '*';
	public $nodeChar	 = '  -  ';
	public $connChar	 = '  |__  ';
	public $nendChar	 = '  -  ';
	public $nodeSpace    = '';
	public $catopen		 = '';
	public $catend       = '';
}