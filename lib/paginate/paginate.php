<?php
class DOPaginate
{
	public function DOPaginate( $totalRow , $rowPerPage = 20 , $curPageNo = 1)
	{
		$this->totalRow 	= (int)$totalRow;
		$this->rowPerPage	= (int)$rowPerPage;
		$this->curPageNo	= (int)$curPageNo;
	}

	/** Get total pages according to total rows and rows in per page.**/	
	public function GetTotalPages()
	{
		return ceil($this->totalRow/$this->rowPerPage);
	}
	/** Use tpl file for paginate displaying*/
	public function SetTpl($tpl)
	{
		include_once $tpl;
	}
	/** Display paginate navigation**/
	public function Display()
	{
		$tpl[] = "<div class='pn'>";
		for($i = 0,$j = $this->GetTotalPages();$i<$j;$i++,$page=$i)
		{
			
			$tpl[] = "<span><a>".$page."</a></span>";
		}
		$tpl[] = "</div>";
		echo implode('',$tpl);
	}
}


