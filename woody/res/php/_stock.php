<?php
require_once('_resstock.php');
require_once('_stockaccount.php');
require_once('/php/stock.php');
require_once('/php/stocktrans.php');
require_once('/php/ui/transactionparagraph.php');
require_once('/php/ui/portfolioparagraph.php');
require_once('_editformcommon.php');
require_once('_edittransactionform.php');
require_once('_stocklink.php');

// ****************************** Money table *******************************************************

function _EchoMoneyParagraphBegin($str = '')
{
	$strMoneyType = '单一货币';
	EchoTableParagraphBegin(array(new TableColumnStockGroup(),
								   new TableColumnProfit(DISP_ALL_CN),
								   new TableColumnHolding(DISP_ALL_CN),
								   new TableColumnProfit($strMoneyType),
								   new TableColumnHolding($strMoneyType),
								   ), 'money', $str);
}

function _echoMoneyItem($strGroup, $strMoney, $fValue, $fProfit, $fConvertValue, $fConvertProfit)
{
	$ar = array($strGroup);
	$ar[] = GetNumberDisplay($fConvertProfit).$strMoney;
	
	$strConvertProfit = GetNumberDisplay($fConvertValue);
	$strProfit = GetNumberDisplay($fProfit);
    $strValue = GetNumberDisplay($fValue);
    
    if ($strConvertProfit == '')
    {
    	if ($strProfit != '' || $strValue != '')	$ar[] = ''; 
    }
    else
    {
    	$ar[] = $strConvertProfit;
    }
    
    if ($strProfit == '')
    {
    	if ($strValue != '')	$ar[] = ''; 
    }
    else
    {
    	$ar[] = $strProfit;
    }
    
    if ($strValue != '')	$ar[] = $strValue;
    
    EchoTableColumn($ar);
}

function _EchoMoneyGroupData($acct, $group, $strUSDCNY, $strHKDCNY, $strLink = false)
{
	if ($strLink == false)
	{
		$strLink = $acct->GetGroupLink($group->GetGroupId());
	}
	
    $group->ConvertCurrency($strUSDCNY, $strHKDCNY);
    _echoMoneyItem($strLink, '', $group->multi_amount->fCNY, $group->multi_profit->fCNY, $group->multi_amount->fConvertCNY, $group->multi_profit->fConvertCNY);
    if ((empty($group->multi_amount->fUSD) == false) || (empty($group->multi_profit->fUSD) == false))
    {
        _echoMoneyItem('', '$', $group->multi_amount->fUSD, $group->multi_profit->fUSD, $group->multi_amount->fConvertUSD, $group->multi_profit->fConvertUSD);
    }
    if ((empty($group->multi_amount->fHKD) == false) || (empty($group->multi_profit->fHKD) == false))
    {
        _echoMoneyItem('', 'HK$', $group->multi_amount->fHKD, $group->multi_profit->fHKD, $group->multi_amount->fConvertHKD, $group->multi_profit->fConvertHKD);
    }
}

// ****************************** Promotion Headline *******************************************************

function _echoRandomPromotion()
{
	$iVal = rand(1, 5);
	switch ($iVal)
	{
	case 1:
		LayoutWeixinPromotion();
		break;
        	
	case 2:
		LayoutWeixinPay();
		break;

	case 3:
		LayoutPromotion('huabao');
		break;
		
	case 4:
		LayoutPromotion('dongfang');
		break;
		
	case 5:
		LayoutPromotion('yinhe', '著名网红营业部开户。请联系客服调整佣金 -- QQ:2531998595 微信:yhzqjn3');
		break;
	}
}

function EchoPromotionHead($strVer = false, $strLoginId = false)
{
    EchoHeadLine('相关链接');
	_echoRandomPromotion();
    
    $str = GetPromotionLink().' '.GetDevGuideLink('20150818', $strVer).' '.GetVisitorLink();
    EchoParagraph($str);
}

// ****************************** Money Paragraph *******************************************************

function EchoMoneyParagraph($acct, $group, $uscny_ref = false, $hkcny_ref = false)
{
	$strUSDCNY = $uscny_ref ? $uscny_ref->GetPrice() : false;
	$strHKDCNY = $hkcny_ref ? $hkcny_ref->GetPrice() : false;
	
    _EchoMoneyParagraphBegin('折算货币');
    _EchoMoneyGroupData($acct, $group, $strUSDCNY, $strHKDCNY);
    EchoTableParagraphEnd();
}

?>
