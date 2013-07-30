<?php
class DOWidgetPaginate
{
	public function DOWidgetPaginate( $totalRow , $rowPerPage = 20)
	{
		$this->totalRow 	= (int)$totalRow;
		$this->rowPerPage	= (int)$rowPerPage;
		$this->curPageNo	= (int)DOHelper::GetCurPage();
	}

	/** Get total pages according to total rows and rows in per page.**/	
	public function GetTotalPages()
	{
		return ceil($this->totalRow/$this->rowPerPage);
	}

	public function GetRowPerPage()
	{
		return $this->rowPerPage;
	}
	/** Display paginate navigation**/
	public function Render()
	{
		$tpl[] = "<div class='pn'>";
		for($i = 0,$j = $this->GetTotalPages();$i<$j;$i++,$page=$i)
		{
			
			$tpl[] = "<span><a>".$page."</a></span>";
		}
		$tpl[] = "</div>";
		return implode('',$tpl);
	}
}