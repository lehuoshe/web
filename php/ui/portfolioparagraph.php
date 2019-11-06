<?php
require_once('stocktable.php');

function _echoPortfolioTableItem($trans)
{
	$ar = array();
	
    $ref = $trans->ref;
    $sym = $ref->GetSym();
    if ($sym->IsSymbolA())           $strMoney = '';
    else if ($sym->IsSymbolH())     $strMoney = '港币$';
    else                               $strMoney = '$';
    
    $ar[] = StockGetTransactionLink($trans->GetGroupId(), $sym->GetSymbol());
    $ar[] = $trans->GetProfitDisplay().$strMoney;
    if ($trans->iTotalShares != 0)
    {
        $ar[] = GetNumberDisplay($trans->GetValue()).$strMoney;
        $ar[] = strval($trans->iTotalShares); 
        $ar[] = $trans->GetAvgCostDisplay();
        $ar[] = $ref->GetPercentageDisplay($trans->GetAvgCost());
    }

    EchoTableColumn($ar);
}

function EchoPortfolioParagraph($str, $arTrans)
{
	EchoTableParagraphBegin(array(new TableColumnSymbol(),
								   new TableColumnAmount('盈亏'),
								   new TableColumnAmount('持仓'),
								   new TableColumn('总数量', 90),
								   new TableColumnPrice('平均'),
								   new TableColumnChange()
								   ), MY_PORTFOLIO_PAGE, $str);

	foreach ($arTrans as $trans)
	{
		if ($trans->GetTotalRecords() > 0)
		{
			_echoPortfolioTableItem($trans);
		}
	}
    EchoTableParagraphEnd();
}

?>
