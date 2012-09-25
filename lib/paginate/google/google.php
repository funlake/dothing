<?php
class DOPaginateGoogle extends DOPaginate
{
	public $halfMax		= 0;
	public function GetHalfMax()
	{
		if($this->halfMax == 0)
		{
			$this->halfMax = ceil( $this->rowPerPage / 2);
		}
		return $this->halfMax;
	}
	public function GetMaxNoPerPage()
	{
		$totalPages 	= $this->GetTotalPages();
		$rightSideMax   = $this->curPageNo + $this->rowPerPage;
		return ($rightSideMax >= $totalPages) ? $totalPages : $rightSideMax;
	}

	public function SetCurPageNo( $pageNo)
	{
		$this->curPageNo = $pageNo;
	}

	public function Render()
	{
		$haftMax= $this->GetHalfMax();
		$i 	= $this->curPageNo > $haftMax ? ($this->curPageNo - $haftMax) : 1;
		$tpl[]	= "<div class='pagination'>";
		$tpl[]	= "<ul>";
		$tpl[]  = "<li><a href='#'>«</a></li>";
		for($i,$max = $this->GetMaxNoPerPage();$i <= $max;$i++)
		{
			$tpl[] = "<li>"
					."<a href='?page={$i}'>".$i."</a>"
					."</li>";
		}
		$tpl[]  = "<li><a href='#'>»</a></li>";
		$tpl[]  = "</ul>";
		$tpl[]  = "</div>";
		return implode('',$tpl);
	}
}
?>

