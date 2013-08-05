<?php
class DOWidgetTree
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
	/**format string*/
	public $format		 = '';
	public function __construct( Array $initArray )
	{
		call_user_func_array(array($this,'Init'),$initArray);
	}
	public function Init( $data,$idn='',$pidn='' )
	{
		if(!$data)      {print('Could not generate tree without data!');return;}
		if($idn) 	$this->idName = $idn;
		if($pidn)	$this->pidName= $pidn;
		if(!$this->treeArray)
		{	
			$this->treeArray 	      = $this->MakeTreeData( $data );
		}
	}
	/**
	*tree structure generation
	*/	
	public function MakeTreeData( $data )
	{
		$tree = array();
		foreach((array)$data as $k=>$v)
		{
			$v = (array)$v;
			$tree[$v[$this->pidName]][] = $v;
		}
		return  $tree;
	}
	/**
	*generate a tree 
	*$root // what node should we dump as root
	*$deep // what is the level of current node
	*$lcf  // binary flags of node's prefix.something like --> 0100 , it means we would replace 1 to '|' , 0 to '&nbsp';  
	*/
	public function Render($tpl,$root = 0,$deep = 0 , $lcf  = '0')
	{
		if( $this->treeArray[$root] )
		{
			$f = count($this->treeArray[$root]);
			foreach($this->treeArray[$root] as $k=>$v)
			{
				$isLastChild = !($f-$k-1); 
				$t = $v[$this->idName];
				#generate prefix before every node	
				if($deep > 0)
				{
					$prefix = str_repeat("&nbsp;", $deep*7);
					$prefix .= $this->connChar;
				}
				else
				{
					$prefix = $this->rootChar;
				}
				
				$html[] = $this->RenderNode($tpl,$v,$prefix);    
				if( $this->treeArray[$t] ) 
				{
					$dp	   = $deep + 1;
					$html[]    = $this->catopen.$this->Render( $tpl,$t,$dp , $lcf.(!$isLastChild ? '1' : '0') ).$this->catend;
				}
			}

		}
		return implode("",$html);
	}

	public function FormatItem($key,$tpl,$root=0,$deep=0,$lcf='0')
	{
		static $flatten = array();
		if( $this->treeArray[$root] )
		{
			$f = count($this->treeArray[$root]);
			foreach($this->treeArray[$root] as $k=>&$v)
			{
				$isLastChild = !($f-$k-1); 
				$t = &$v[$this->idName];
				
				if($deep > 0)
				{
					$prefix = str_repeat("&nbsp;", $deep*7);
					$prefix .= $this->connChar;
				}
				else
				{
					$prefix = $this->rootChar;
				}
				$v[$key] = $this->RenderNode($tpl,$v,$prefix);
				$flatten[] = $v;    
				if( $this->treeArray[$t] ) 
				{
					$dp	   = $deep + 1;
					$this->FormatItem( $key,$tpl,$t,$dp,$lcf.(!$isLastChild ? '1' : '0') );
				}
			}

		}
		return $flatten;
	}
	/**
	* replace format.
	*/	
	function RenderNode( $format , $v , $prefix)
	{
		$nomal =  preg_replace(array('#\[prefix\]#','#\{\#(\w+)\}#e'),array($prefix,'$v["\1"]'),$format);
		return $nomal;
	}
}
?>
