<?php
require_once('_stock.php');
require_once('_stockgroup.php');
require_once('_fundgroup.php');

class _GoldSilverAccount extends FundGroupAccount
{
    function Create() 
    {
        $strSymbol = $this->GetName();
        
        StockPrefetchExtendedData($strSymbol);
        GetChinaMoney();

        $this->ref = new GoldFundReference($strSymbol);
        
        $this->CreateGroup(array($this->ref->stock_ref));
    }
} 

function _echoTestParagraph($acct)
{
   	if ($acct->IsAdmin() == false)	return;
   	
	$fund = $acct->GetRef();
    $str = _GetEtfAdjustString($fund->stock_ref, $fund->GetEstRef());
    EchoParagraph($str);
}

function EchoAll()
{
    global $acct;

	$fund = $acct->GetRef();
	$cny_ref = $fund->GetCnyRef();
    EchoFundEstParagraph($fund);
    EchoReferenceParagraph(array($fund->GetEstRef(), $fund->GetFutureRef(), $cny_ref, $fund->stock_ref));
    EchoFundTradingParagraph($fund);    
    EchoFundHistoryParagraph($fund);

    if ($group = $acct->EchoTransaction()) 
    {
    	$acct->EchoMoneyParagraph($group, $cny_ref);
	}
    
    _echoTestParagraph($acct);
    $acct->EchoLinks('goldetf', 'GetGoldSilverRelated');
}

function GetGoldSilverLinks($sym)
{
	$str = GetJisiluGoldLink();

	$str .= '<br />&nbsp';
	$str .= GetCommoditySoftwareLinks();
	return $str;
}

function EchoMetaDescription()
{
    global $acct;

    $strDescription = $acct->GetStockDisplay();

	$fund = $acct->GetRef();
    $strCNY = RefGetStockDisplay($fund->GetCnyRef());
    $strEst = RefGetStockDisplay($fund->GetEstRef());
    $strFuture = RefGetStockDisplay($fund->GetFutureRef());
    $str = '根据'.$strEst.', '.$strFuture.'和'.$strCNY.'等因素计算'.$strDescription.'净值的网页工具.';
    EchoMetaDescriptionText($str);
}

   	$acct = new _GoldSilverAccount();
   	$acct->Create();
?>
