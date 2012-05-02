<?php
class DOTree extends DOBase
{
	public $idName 		 = 'id';
	public $pidName		 = 'pid';
	public $treeArray	 = array();
	/**node ui*/
	public $rootChar	 = '*';
	public $nodeChar	 = '├';
	public $connChar	 = '│';
	public $nendChar	 = '└';
	public $nodeSpace    = '&nbsp;';
	public $catopen		 = '';
	public $catend       = '';
	/**format string*/
	public $format		 = '';
	public function __construct( Array $initArray )
	{
		call_user_func_array(array($this,'init'),$initArray);
	}
	public function Init( $data,$idn,$pidn )
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
	public function Render($root = 0,$deep = 0 , $lcf  = '0')
	{
		if( $this->treeArray[$root] )
		{
			$f = count($this->treeArray[$root]);
			foreach($this->treeArray[$root] as $k=>$v)
			{
				$isLastChild = !($f-$k-1); 
				$t = $v[$this->idName];
				#generate prefix before every node	
				$prev = '';
				for($i=0;$i<=$deep;$i++)
				{	
					$prev .=  ( ($lcf{$i} == 0 )  ? $this->nodeSpace :  $this->connChar).$this->nodeSpace;
				}
				
				$prefix	= $prev.($this->treeArray[$t] ? ($deep == 0 ? $this->rootChar:($isLastChild ? $this->nendChar:$this->nodeChar) )
								      				  : ( $isLastChild ? ($deep == 0 ? $this->rootChar:$this->nendChar) 
										        					   : $this->nodeChar) );
				
				
				$html[] = $this->RenderNode($this->format,$v,$prefix);    
				if( $this->treeArray[$t] ) 
				{
					$dp	   = $deep + 1;
					$html[]    = $this->catopen.$this->Render( $t,$dp , $lcf.(!$isLastChild ? '1' : '0') ).$this->catend;
				}
			}

		}
		return implode("",$html);
	}
	/**
	* replace format.
	*/	
	function RenderNode( $format , $v , $prefix)
	{
		return preg_replace(array('#\[prefix\]#','#\{(\w+)\}#e'),array($prefix,'$v["\1"]'),$format);
	}
}
?>
