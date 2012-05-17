<?php
DOLoader::import('lib.paginate.paginate');
class DOPaginateGoogle extends DOPaginate
{
	public $maxItemsPerPage	= 20;
	public $halfMax		= 0;
	public function SetMaxItemsPerPage( $num )
	{
		$this->maxItemsPerPage = $num;
	}
	public function GetHalfMax()
	{
		if($this->halfMax == 0)
		{
			$this->halfMax = ceil( $this->maxItemsPerPage / 2);
		}
		return $this->halfMax;
	}
	public function GetMaxNoPerPage()
	{
		$totalPages 	= $this->GetTotalPages();
		$rightSideMax   = $this->curPageNo + $this->GetHalfMax();
		return $rightSideMax >= $totalPages ? $totalPages : $rightSideMax;
	}

	public function SetCurPageNo( $pageNo)
	{
		$this->curPageNo = $pageNo;
	}

	public function Display()
	{
		$haftMax= $this->GetHalfMax();
		$i 	= $this->curPageNo > $haftMax ? ($this->curPageNo - $haftMax) : 1;
		$tpl[]	= "<div class='pn'>";
		for($max = $this->GetMaxNoPerPage();$i <= $max;$page=$i++)
		{
			$tpl[] = "<span style='width:40px;border:1px solid ".(($this->curPageNo == $page) ? '#ff0000' : '#000').";margin:2px'>"
				."<a href='?page={$page}'>".$page."</a>"
				."</span>";
		}	
		$tpl[]  = "</div>";
		echo implode('',$tpl);
	}
}
?>

