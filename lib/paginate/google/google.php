<?php
class DOPaginateGoogle extends DOPaginate
{
	public $halfMax		= 10;
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
		$rightSideMax   = $this->curPageNo + $this->GetHalfMax();
		return min($totalPages,$rightSideMax);
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
		$params = DORouter::GetParams();
		//we can not use GetPageIndex from DORouter here.
		$page   = DOUri::GetModule()."/".DOUri::GetController()."/".DOUri::GetAction();
		for($i,$max = $this->GetMaxNoPerPage();$i <= $max;$i++)
		{
			if(defined('DO_PAGE_INDEX'))
			{
				$params[DO_PAGE_INDEX] = $i;
			}
			else $params['page'] = $i;
			$url   = Url($page,$params);
			$tpl[] = "<li>"
					."<a href='{$url}'>".$i."</a>"
					."</li>";
		}
		$tpl[]  = "<li><a href='#'>»</a></li>";
		$tpl[]  = "</ul>";
		$tpl[]  = "</div>";
		return implode('',$tpl);
	}
}
?>

