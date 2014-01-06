<?php
class DOWidgetPaginate
{
	public function DOWidgetPaginate( $totalRow , $rowPerPage = 20)
	{
		$this->totalRow 	= (int)$totalRow;
		$this->rowPerPage	= (int)$rowPerPage;
		$this->curPageNo	= (int)DOHelper::GetCurPage();
		$this->SetPageState();
	}
	public function SetPageState()
	{
		/** paginate initialize **/
		if(defined('DO_PAGE_INDEX'))
		{
			$pageindex = DO_PAGE_INDEX;
		}
		else
		{
			$pageindex = "page";
		}
		$page   = DOUri::GetModule()."/".DOUri::GetController()."/".DOUri::GetAction();
		$params = DORequest::Get();
		$session = DOFactory::GetSession();
		//if people search something,then page will rewind to 1.
		if(isset($_REQUEST['DO']['search']))
		{
			$session->Set($page."_p",1);
		}
		else 
		{
			if(!empty($params[$pageindex]))
			{
				$session->Set($page."_p",$params[$pageindex]);
			}
			else
			{
				if(!$session->Get($page."_p") )
				{
					$session->Set($page."_p",1);
				}
			}
		}

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