<?php

function GetYahooStockUrl($strYahooSymbol)
{
	return 'https://finance.yahoo.com/quote/'.$strYahooSymbol;
}

function GetYahooStockHistoryUrl($strYahooSymbol)
{
	return GetYahooStockUrl($strYahooSymbol).'/history';
}

// https://query1.finance.yahoo.com/v7/finance/download/000300.ss?period1=1630006346&period2=1683574346&interval=1d&events=history&includeAdjustedClose=true
// https://query1.finance.yahoo.com/v6/finance/quote?symbols=^ASHR-IV
function GetYahooQuotesUrl($iVer = 7)
{
	return 'https://query1.finance.yahoo.com/v'.strval($iVer).'/finance';
}

function GetSinaQuotesUrl($strSinaSymbols)
{
	return 'http://hq.sinajs.cn/list='.$strSinaSymbols;
}	

function GetSinaFinanceUrl()
{
	return 'https://finance.sina.com.cn';
}

function GetSinaStockUrl()
{
	return 'https://stock.finance.sina.com.cn';
}

function GetSinaVipStockUrl()
{
	return 'https://vip.stock.finance.sina.com.cn';
}

function GetSinaChinaStockListUrl($strNode = 'hs_a')
{
	return GetSinaVipStockUrl().'/mkt/#'.$strNode;
}

function GetSinaUsStockListUrl()
{
	return GetSinaVipStockUrl().'/usstock/ustotal.php';
}

function GetEastMoneyFundUrl()
{
	return 'http://fund.eastmoney.com/';
}

function GetAastocksUrl()
{
	return 'http://www.aastocks.com/tc/';
}

// http://www.aastocks.com/tc/usq/quote/adr.aspx?sort=0&order=1&type=0
function GetAastocksAdrUrl()
{
	return GetAastocksUrl().'usq/quote/adr.aspx?sort=0&order=1&type=0';
}

// http://www.aastocks.com/tc/stocks/market/second-listing.aspx
function GetAastocksSecondListingUrl()
{
	return GetAastocksUrl().'stocks/market/second-listing.aspx';
}

// http://www.aastocks.com/tc/stocks/market/ah.aspx
function GetAastocksAhUrl()
{
	return GetAastocksUrl().'stocks/market/ah.aspx';
}

function GetXueqiuUrl()
{
	return 'https://xueqiu.com/';
}

function GetJisiluDataUrl()
{
	return 'https://www.jisilu.cn/data/';
}

// https://csi-web-dev.oss-cn-shanghai-finance-1-pub.aliyuncs.com/static/html/csindex/public/uploads/file/autofile/closeweight/H30533closeweight.xls
// https://csi-web-dev.oss-cn-shanghai-finance-1-pub.aliyuncs.com/static/html/csindex/public/uploads/file/autofile/closeweight/H11136closeweight.xls
// https://www.csindex.com.cn/#/indices/family/detail?indexCode=H11136
function GetCsindexUrl($strSymbol)
{
	return 'https://www.csindex.com.cn/#/indices/family/detail?indexCode='.$strSymbol;
}

function GetSzseUrl()
{
	return 'http://www.szse.cn/';
}

function GetSseUrl()
{
	return 'http://www.sse.com.cn/';
}

// https://kraneshares.com/kweb/
// https://kraneshares.com/csv/06_22_2021_kweb_holdings.csv
function GetKraneUrl()
{
	return 'https://kraneshares.com/';
}

// https://www.ssga.com/us/en/individual/etfs/funds/spdr-sp-biotech-etf-xbi
function GetSpdrEtfUrl()
{
	return 'https://www.ssga.com/us/en/individual/etfs/';
}

// https://www.ishares.com/us/products/239517/ishares-us-oil-gas-exploration-production-etf/
function GetIsharesEtfUrl($strSymbol)
{
	$str = 'https://www.ishares.com/us/products/';
	switch ($strSymbol)
	{
	case 'GSG':
		$str .= '239757/GSG';
		break;

	case 'IEO':
		$str .= '239517/ishares-us-oil-gas-exploration-production-etf';
		break;
		
	case 'IXC':
		$str .= '239741/ishares-global-energy-etf';
		break;
	}
	return $str;
}

// https://www.ishares.com/us/products/239517/ishares-us-oil-gas-exploration-production-etf/1521942788811.ajax?fileType=xls&fileName=iShares-US-Oil--Gas-Exploration--Production-ETF_fund&dataType=fund
function _getIsharesXlsUrl($strSymbol)
{
	$str = GetIsharesEtfUrl($strSymbol).'/';
	switch ($strSymbol)
	{
	case 'GSG':
		break;

	case 'IEO':
		$str .= '1521942788811.ajax?fileType=xls&fileName=iShares-US-Oil--Gas-Exploration--Production-ETF_fund&dataType=fund';
		return $str;
		
	case 'IXC':
		break;
	}
	return false;
}

// https://www.ssga.com/us/en/individual/etfs/library-content/products/fund-data/etfs/us/navhist-us-en-xop.xlsx
function GetEtfNavUrl($strSymbol)
{
	if ($strName = SqlGetStockName($strSymbol))
	{
		if (stripos($strName, 'spdr') !== false)
		{
			return GetSpdrEtfUrl().'library-content/products/fund-data/etfs/us/navhist-us-en-'.strtolower($strSymbol).'.xlsx';
		}
		else if (stripos($strName, 'ishares') !== false)
		{
			return _getIsharesXlsUrl($strSymbol);
		}
	}
	return false;
}

?>
