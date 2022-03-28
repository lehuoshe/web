<?php
require_once('_stock.php');
require_once('_stockgroup.php');
require_once('/php/ui/arbitrageparagraph.php');
require_once('/php/ui/referenceparagraph.php');
require_once('/php/ui/hsharesmaparagraph.php');
require_once('/php/ui/tradingparagraph.php');

class _AdrAccount extends GroupAccount 
{
    var $cn_ref;
    var $us_ref;
    var $hk_ref;
    
    var $fRatioAdrH;

    var $cn_convert;
    var $us_convert;
    var $hk_convert;
    
    function Create()
    {
        $strSymbolAdr = $this->GetName();
        StockPrefetchExtendedData($strSymbolAdr);
        
        $this->hk_ref = new HShareReference(SqlGetAdrhPair($strSymbolAdr));
        $this->cn_ref = $this->hk_ref->a_ref;
        $this->us_ref = $this->hk_ref->adr_ref;

        $this->fRatioAdrH = $this->hk_ref->GetAdrRatio();

        GetChinaMoney($this->cn_ref);
        $this->CreateGroup(array($this->us_ref, $this->hk_ref, $this->cn_ref));
    }
    
    function OnConvert($cn_trans, $hk_trans, $us_trans)
    {
        $strGroupId = $this->GetGroupId();
    	$fUSDCNY = $this->hk_ref->GetUSDCNY();
    	$fHKDCNY = $this->hk_ref->GetHKDCNY();
    	$fUSDHKD = $this->hk_ref->GetUSDHKD();

        $this->cn_convert = new MyStockTransaction($this->cn_ref, $strGroupId);
        $this->cn_convert->Add($cn_trans);
        $this->cn_convert->AddTransaction($hk_trans->iTotalShares, $hk_trans->fTotalCost * $fHKDCNY);
        $this->cn_convert->AddTransaction(intval($us_trans->iTotalShares * $this->fRatioAdrH), $us_trans->fTotalCost * $fUSDCNY);
        
        $this->hk_convert = new MyStockTransaction($this->hk_ref, $strGroupId);
        $this->hk_convert->Add($hk_trans);
        $this->hk_convert->AddTransaction($cn_trans->iTotalShares, $cn_trans->fTotalCost / $fHKDCNY);
        $this->hk_convert->AddTransaction(intval($us_trans->iTotalShares * $this->fRatioAdrH), $us_trans->fTotalCost * $fUSDHKD);
        
        $this->us_convert = new MyStockTransaction($this->us_ref, $strGroupId);
        $this->us_convert->Add($us_trans);
        $this->us_convert->AddTransaction(intval($cn_trans->iTotalShares / $this->fRatioAdrH), $cn_trans->fTotalCost / $fUSDCNY);
        $this->us_convert->AddTransaction(intval($hk_trans->iTotalShares / $this->fRatioAdrH), $hk_trans->fTotalCost / $fUSDHKD);
    }
} 

function _echoArbitrageParagraph($acct, $group)
{
	$group->OnArbitrage();
        
    $cn_trans = $group->GetStockTransactionCN();
    $hk_trans = $group->GetStockTransactionHK();
    $us_trans = $group->GetStockTransactionUS();
    $acct->OnConvert($cn_trans, $hk_trans, $us_trans);
    
    $cn_ref = $acct->cn_ref;
    $hk_ref = $acct->hk_ref;
    $us_ref = $acct->us_ref;
    if ($group->arbi_trans == false)		return;
    
    EchoArbitrageTableBegin();
	$sym = $group->arbi_trans->ref;
    if ($sym->IsSymbolA())
    {
        $cn_arbi = $group->arbi_trans;
        EchoArbitrageTableItem2($cn_arbi, $acct->cn_convert); 
        EchoArbitrageTableItem(-1 * $cn_arbi->iTotalShares, $hk_ref->GetPriceDisplay($hk_ref->EstFromCny($cn_arbi->GetAvgCost())), $acct->hk_convert); 
        EchoArbitrageTableItem(intval(-1.0 * $cn_arbi->iTotalShares / $acct->fRatioAdrH), $us_ref->GetPriceDisplay($hk_ref->FromCnyToUsd($cn_arbi->GetAvgCost())), $acct->us_convert); 
    }
    else if ($sym->IsSymbolH())
    {
        $hk_arbi = $group->arbi_trans;
        EchoArbitrageTableItem(-1 * $hk_arbi->iTotalShares, $cn_ref->GetPriceDisplay($hk_ref->EstToCny($hk_arbi->GetAvgCost())), $acct->cn_convert); 
        EchoArbitrageTableItem2($hk_arbi, $acct->hk_convert); 
        EchoArbitrageTableItem(intval(-1.0 * $hk_arbi->iTotalShares / $acct->fRatioAdrH), $us_ref->GetPriceDisplay($hk_ref->EstToUsd($hk_arbi->GetAvgCost())), $acct->us_convert); 
    }
    else
    {
        $us_arbi = $group->arbi_trans;
        EchoArbitrageTableItem(intval(-1.0 * $us_arbi->iTotalShares * $acct->fRatioAdrH), $cn_ref->GetPriceDisplay($hk_ref->FromUsdToCny($us_arbi->GetAvgCost())), $acct->cn_convert); 
        EchoArbitrageTableItem(intval(-1.0 * $us_arbi->iTotalShares * $acct->fRatioAdrH), $hk_ref->GetPriceDisplay($hk_ref->EstFromUsd($us_arbi->GetAvgCost())), $acct->hk_convert); 
        EchoArbitrageTableItem2($us_arbi, $acct->us_convert); 
    }
    
    EchoTableParagraphEnd();
}

function _echoAdrPriceItem($ref)
{
    global $acct;
    $cn_ref = $acct->cn_ref;
    $hk_ref = $acct->hk_ref;
    $us_ref = $acct->us_ref;
    
	$ar = array();
	$ar[] = RefGetMyStockLink($ref);
	
    $strPriceDisplay = $ref->GetPriceDisplay();
    $strPrice = $ref->GetPrice();
    if ($ref->IsSymbolA())
    {
        $ar[] = $strPriceDisplay;
        $ar[] = $hk_ref->GetPriceDisplay($hk_ref->EstFromCny($strPrice), $hk_ref->GetPrevPrice());
        $ar[] = $us_ref->GetPriceDisplay($hk_ref->FromCnyToUsd($strPrice), $us_ref->GetPrevPrice());
    }
    else if ($ref->IsSymbolH())
    {
        $ar[] = $cn_ref->GetPriceDisplay($hk_ref->EstToCny($strPrice), $cn_ref->GetPrevPrice());
        $ar[] = $strPriceDisplay;
        $ar[] = $us_ref->GetPriceDisplay($hk_ref->EstToUsd($strPrice), $us_ref->GetPrevPrice());
    }
    else
    {
        $ar[] = $cn_ref->GetPriceDisplay($hk_ref->FromUsdToCny($strPrice), $cn_ref->GetPrevPrice());
        $ar[] = $hk_ref->GetPriceDisplay($hk_ref->EstFromUsd($strPrice), $hk_ref->GetPrevPrice());
        $ar[] = $strPriceDisplay;
    }
    
    RefEchoTableColumn($ref, $ar);
}

function _echoAdrPriceParagraph($arRef)
{
	EchoTableParagraphBegin(array(new TableColumnSymbol(),
								   new TableColumnRMB(),
								   new TableColumnHKD(),
								   new TableColumnUSD()
								   ), 'adrprice');
	
	foreach ($arRef as $ref)
	{
		_echoAdrPriceItem($ref);
	}
    EchoTableParagraphEnd();
}

function EchoAll()
{
    global $acct;
    
    $arRef = $acct->GetStockRefArray();
    _echoAdrPriceParagraph($arRef);
    EchoReferenceParagraph($arRef, $acct->IsAdmin());
	EchoAhTradingParagraph($acct->hk_ref);
    EchoHShareSmaParagraph($acct->cn_ref, $acct->hk_ref);
    EchoHShareSmaParagraph($acct->hk_ref, $acct->hk_ref);

    if ($group = $acct->EchoTransaction()) 
    {
        $acct->EchoMoneyParagraph($group, $acct->hk_ref->uscny_ref, $acct->hk_ref->hkcny_ref);
        _echoArbitrageParagraph($acct, $group);
	}
    
    $acct->EchoLinks('adr', 'GetAdrLinks');
}

function GetAdrLinks($sym)
{
	$str = GetAastocksLink();
	$str .= GetASharesSoftwareLinks();
	$str .= GetHangSengSoftwareLinks();
	return $str.GetAdrRelated($sym);
}

function GetTitle()
{
    global $acct;
    
    $strDescription = RefGetStockDisplay($acct->us_ref);
	return '比较'.$strDescription.'对应港股和A股的价格';
}

function GetMetaDescription()
{
    global $acct;
    
    $strAdr = RefGetStockDisplay($acct->us_ref);
    $strA = RefGetStockDisplay($acct->cn_ref);
    $strH = RefGetStockDisplay($acct->hk_ref);
    $str = '根据'.SymGetStockName($acct->hk_ref->uscny_ref).'和'.SymGetStockName($acct->hk_ref->hkcny_ref).'计算比较美股'.$strAdr.', A股'.$strA.'和港股'.$strH.'价格的网页工具.';
    return CheckMetaDescription($str);
}

   	$acct = new _AdrAccount();
   	$acct->Create();
?>
