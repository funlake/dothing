<?php
DOLoader::Import('widgets.paginate.class');
class DOWidgetPaginateDefault extends DOWidgetPaginate
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
		if($this->GetMaxNoPerPage() <=1 ) return "";
		$haftMax= $this->GetHalfMax();
		if(defined('DO_PAGE_INDEX'))
		{
			$pageindex = DO_PAGE_INDEX;
		}
		else
		{
			$pageindex = "page";
		}
		//we can not use GetPageIndex from DORouter here.
		$page   = DOUri::GetModule()."/".DOUri::GetController()."/".DOUri::GetAction();
		$params = DORouter::GetParams();

		$session  = DOFactory::GetSession();
		$current = $session->Get($page."_p");
		$class     = array($current => "active");


		$i 	= $this->curPageNo > $haftMax ? ($this->curPageNo - $haftMax) : 1;
		$tpl[]	= "<ul class='pagination'>";
		$params[$pageindex] = 1;
		$tpl[]  = "<li><a href='".Url($page,$params)."'><<</a></li>";
		if($current != 1)
		{
			$params[$pageindex] = $current - 1;
			$tpl[]  = "<li><a href='".Url($page,$params)."'><</a></li>";
		}
		else
		{
			$tpl[]  = "<li class='disabled'><a href='javascript:void(0);'><</a></li>";
		}
		for($i,$max = $this->GetMaxNoPerPage();$i <= $max;$i++)
		{
			$params[$pageindex] = $i;
			$url   = Url($page,$params);
			$tpl[] = "<li class='".@$class[$i]."'>"
					."<a href='{$url}'>".$i."</a>"
					."</li>";
		}
		if($current != $this->GetMaxNoPerPage())
		{
			$params[$pageindex] = $current + 1;
			$tpl[]  = "<li><a href='".Url($page,$params)."'>></a></li>";
		}
		else
		{
			$tpl[]  = "<li class='disabled'><a href='javascript:void(0);'>></a></li>";
		}
		$params[$pageindex] = $this->GetTotalPages();
		$tpl[]  = "<li><a href='".Url($page,$params)."'>>></a></li>";
		$tpl[]  = "</ul>";
		return implode('',$tpl);
	}
}
?>

