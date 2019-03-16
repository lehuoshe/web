<?php
//require_once('url.php');
//require_once('debug.php');
require_once('httplink.php');
require_once('ui/stocktable.php');

// ****************************** Stock internal link functions *******************************************************
function GetStockTitleLink($strTitle, $strDisplay, $strQuery = false)
{
	return GetTitleLink(STOCK_PATH, $strTitle, true, $strDisplay, false, $strQuery);
}

function GetStockSymbolLink($strTitle, $strSymbol, $strDisplay)
{
	return GetStockTitleLink($strTitle, $strDisplay, 'symbol='.$strSymbol);
//    return GetPhpLink(STOCK_PATH.$strTitle, true, $strDisplay, false, 'symbol='.$strSymbol);
}

function GetMyStockLink($strSymbol)
{
	return GetStockSymbolLink('mystock', $strSymbol, $strSymbol);
//    return GetStockTitleLink('mystock', $strSymbol, 'symbol='.$strSymbol);
}

function GetCalibrationHistoryLink($strSymbol)
{
    return GetStockSymbolLink('calibrationhistory', $strSymbol, '校准记录');
}

function GetCalibrationLink($strSymbol)
{
    return GetStockSymbolLink('calibration', $strSymbol, '校准记录');
}

function GetStockHistoryLink($strSymbol)
{
    return GetStockSymbolLink('stockhistory', $strSymbol, '价格历史');
}

define('NETVALUE_HISTORY_DISPLAY', '净值历史记录');
function GetNetValueHistoryLink($strSymbol)
{
    return GetStockSymbolLink('netvaluehistory', $strSymbol, NETVALUE_HISTORY_DISPLAY);
}

define('NAVCLOSE_HISTORY_DISPLAY', '净值和收盘价历史比较');
function GetNavCloseHistoryLink($strSymbol)
{
	return GetStockSymbolLink('navclosehistory', $strSymbol, NAVCLOSE_HISTORY_DISPLAY);
}

define('AH_HISTORY_DISPLAY', '历史AH价格比较');
function GetAhHistoryLink($strSymbol)
{
    return GetStockSymbolLink('ahhistory', $strSymbol, AH_HISTORY_DISPLAY);
}

define('BENFORD_LAW_DISPLAY', '本福特定律');
function GetBenfordLawLink($strSymbol)
{
    return GetStockSymbolLink('benfordlaw', $strSymbol, BENFORD_LAW_DISPLAY);
}

function GetMyPortfolioLink()
{
    return GetStockTitleLink('myportfolio', '持仓盈亏');
}

function GetAhCompareLink($strQuery = false)
{
    return GetStockTitleLink('ahcompare', 'AH对比', $strQuery);
}

function GetEtfListLink()
{
    return GetStockTitleLink('etflist', 'ETF对照表');
}

function GetAdrhCompareLink()
{
    return GetStockTitleLink('adrhcompare', 'ADR和H对比');
}

function GetMyStockGroupLink($strGroupId = false)
{
	if ($strGroupId)
	{
		$strDisplay = SqlGetStockGroupName($strGroupId);
		$strQuery = 'groupid='.$strGroupId;
	}
	else
	{
		$arColumn = GetStockGroupTableColumn();
		$strDisplay = $arColumn[0];
		$strQuery = false;
	}
	return GetStockTitleLink('mystockgroup', $strDisplay, $strQuery);
}

function GetCategorySoftwareLinks($arTitle, $strCategory)
{
    $str = '<br />'.$strCategory.' - ';
    foreach ($arTitle as $strTitle)
    {
    	$str .= GetStockTitleLink($strTitle, StockGetSymbol($strTitle)).' ';
    }
    return $str;
}

function StockGetTransactionLink($strGroupId, $strSymbol, $strDisplay = false)
{
    $strQuery = 'groupid='.$strGroupId;
    if ($strSymbol)
    {
        $strQuery .= '&symbol='.$strSymbol;
    }
    
    if ($strDisplay == false)
    {
    	$strDisplay = $strSymbol;
    }
    return GetPhpLink(STOCK_PATH.'mystocktransaction', true, $strDisplay, false, $strQuery);
}

function StockGetAllTransactionLink($strGroupId, $ref = false)
{
	if ($ref)
	{
		$strSymbol = $ref->GetStockSymbol();
	}
	else
	{
		$strSymbol = false;
	}
    return StockGetTransactionLink($strGroupId, $strSymbol, '交易记录');
}

function StockGetGroupTransactionLinks($strGroupId, $strCurSymbol = '')
{
    $str = '';
	$sql = new StockGroupItemSql($strGroupId);
    $arGroupItemSymbol = SqlGetStockGroupItemSymbolArray($sql);
    foreach ($arGroupItemSymbol as $strGroupItemId => $strSymbol)
    {
        if ($strSymbol == $strCurSymbol)
        {
            $str .= "<font color=indigo>$strSymbol</font>";
        }
        else
        {
        	$sym = new StockSymbol($strSymbol);
        	if ($sym->IsTradable())
        	{
        		$str .= StockGetTransactionLink($strGroupId, $strSymbol);
        	}
        }
        $str .= ' ';
    }
    return rtrim($str, ' ');
}

// ****************************** Other internal link related functions *******************************************************
function GetStockLink($strSymbol)
{
    if (in_arrayAll($strSymbol))
    {
    	return GetPhpLink(STOCK_PATH.strtolower($strSymbol), true, $strSymbol);
    }
    return false;
}

function GetStockGroupLink($strGroupId)
{
    if ($strGroupName = SqlGetStockGroupName($strGroupId))
    {
    	if ($strLink = GetStockLink($strGroupName))
    	{
    		return $strLink; 
    	}
    	return GetMyStockGroupLink($strGroupId);
    }
    return '';
}

function StockGetNavLink($strSymbol, $iTotal, $iStart, $iNum)
{
    return GetNavLink('symbol='.$strSymbol, $iTotal, $iStart, $iNum);
}

?>
