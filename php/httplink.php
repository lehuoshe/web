<?php
define('STOCK_PATH', '/woody/res/');

define('MENU_DIR_FIRST', 'First');
define('MENU_DIR_PREV', 'Prev');
define('MENU_DIR_NEXT', 'Next');
define('MENU_DIR_LAST', 'Last');

function GetMenuArray()
{
    return array(MENU_DIR_FIRST => '第一页', MENU_DIR_PREV => '上一页', MENU_DIR_NEXT => '下一页', MENU_DIR_LAST => '最后一页');
}

function GetNameTag($strName, $strDisplay = false)
{
	return GetHtmlElement(($strDisplay ? $strDisplay : strtoupper($strName)), 'a', array('name' => GetDoubleQuotes($strName)));
}

function GetNameLink($strName, $strDisplay = false, $strLink = '')
{
	return GetLinkElement(($strDisplay ? $strDisplay : strtoupper($strName)), $strLink.'#'.$strName);
}

function GetOnClickLink($strPath, $strQuestion, $strDisplay)
{
	return GetLinkElement($strDisplay, UrlGetServer().$strPath, array('onclick' => GetDoubleQuotes("return confirm('$strQuestion')")));
}

function GetDeleteLink($strPath, $strCn, $strUs = '', $bChinese = true)
{
    if ($bChinese)
    {
        $strDisplay = '删除';
        $strQuestion = '确认删除'.$strCn.'？';
    }
    else
    {
        $strDisplay = 'Delete';
        $strQuestion = 'Confirm delete '.$strUs.'?';
    }
    return GetOnClickLink($strPath, $strQuestion, $strDisplay);
}

function GetInternalLink($strPath, $strDisplay = false)
{
	return GetLinkElement(($strDisplay ? $strDisplay : basename($strPath)), UrlGetServer().$strPath);
}

function GetExternalLink($strHttp, $strDisplay = false)
{
	return GetLinkElement(($strDisplay ? $strDisplay : $strHttp), $strHttp, array('target' => '_blank'));
}

function GetFileLink($strPathName)
{
    return GetExternalLink(UrlGetPathName($strPathName), basename($strPathName));
}

function GetDebugFileLink()
{
    return GetFileLink(DebugGetFile());
}

function GetWebFileLink($strPathName)
{
    return GetFileLink(UrlGetRootDir().$strPathName);
}

function GetFileDebugLink($strPathName)
{
    clearstatcache(true, $strPathName);
    if (file_exists($strPathName))
    {
		$strLink = GetFileLink($strPathName);
		$strDelete = GetOnClickLink('/php/_submitdelete.php?file='.$strPathName, '确认删除调试文件'.$strPathName.'？', DebugFormat_date('m-d H:i:s', filemtime($strPathName)));
		return "$strLink($strDelete)";
    }
    return '';
}

function GetPhpLink($strPathPage, $strQuery, $strDisplay, $strUs = false, $bChinese = true)
{
	if ($strUs && ($bChinese == false))
	{
		$strDisplay = $strUs;
	}
	
    $str = $strPathPage;
    $str .= UrlGetPhp($bChinese);
    if ($strQuery)
    {
        $str .= '?'.$strQuery;
    }
    return GetInternalLink($str, $strDisplay);
}

function CopyPhpLink($strQuery, $strCn, $strUs = false, $bChinese = true)
{
	return GetPhpLink(UrlGetUriPage(), $strQuery, $strCn, $strUs, $bChinese);
}

function _getMenuLinkQuery($strId, $iStart, $iNum)
{
    $str = '';
    if ($strId)
    {
        $str = $strId.'&';
    }
    $str .= 'start='.strval($iStart).'&num='.strval($iNum);
    return $str;
}

function _getMenuDirLink($strDir, $strQueryId, $iStart, $iNum, $bChinese)
{
    $arDir = GetMenuArray();
	$strQuery = _getMenuLinkQuery($strQueryId, $iStart, $iNum);
	return CopyPhpLink($strQuery, $arDir[$strDir], $strDir, $bChinese).' ';
}

function GetMenuLink($strQueryId, $iTotal, $iStart, $iNum, $bChinese = true)
{
    $str = ($bChinese ? '总数' : 'Total').': '.strval($iTotal);
    if ($iTotal <= 0 || ($iStart == 0 && $iNum == 0))		return $str;

    $iLast = $iStart + $iNum;
    if ($iLast > $iTotal)   $iLast = $iTotal;
    $str .= ' '.($bChinese ? '当前显示' : 'Current').': '.strval($iStart + 1).'-'.strval($iLast).' ';
    
    if ($iStart > 0)
    {   // Prev
        $iPrevStart = ($iStart > $iNum) ? ($iStart - $iNum) : 0;
        if ($iPrevStart != 0)	$str .= _getMenuDirLink(MENU_DIR_FIRST, $strQueryId, 0, $iNum, $bChinese);	// First
        $str .= _getMenuDirLink(MENU_DIR_PREV, $strQueryId, $iPrevStart, $iNum, $bChinese);
    }
    
    $iNextStart = $iStart + $iNum;
    if ($iNextStart < $iTotal)
    {   // Next
        $str .= _getMenuDirLink(MENU_DIR_NEXT, $strQueryId, $iNextStart, $iNum, $bChinese);
        if ($iNextStart + $iNum < $iTotal)		$str .= _getMenuDirLink(MENU_DIR_LAST, $strQueryId, $iTotal - $iNum, $iNum, $bChinese);		// Last
    }
    
    for ($i = 100; $i <= 500; $i += 100)
    {
    	$strNum = strval($i);
    	if ($i == $iNum)	$str .= $strNum;
    	else				$str .= CopyPhpLink(_getMenuLinkQuery($strQueryId, $iStart, $i), $strNum, $strNum, $bChinese);
    	$str .= ' ';
    }
    return $str;
}

function GetNewLink($strPathPage, $strNew, $bChinese = true)
{
    return GetPhpLink($strPathPage, 'new='.$strNew, DISP_NEW_CN, DISP_NEW_US, $bChinese);
}

function GetEditLink($strPathPage, $strEdit, $bChinese = true)
{
    return GetPhpLink($strPathPage, 'edit='.$strEdit, DISP_EDIT_CN, DISP_EDIT_US, $bChinese);
}

function GetPageLink($strPath, $strPage, $strQuery, $strDisplay, $bChinese = true)
{
    if ((UrlGetPage() == $strPage) && (UrlGetQueryString() == $strQuery))
    {
        return GetInfoElement($strDisplay);
    }
    return GetPhpLink($strPath.$strPage, $strQuery, $strDisplay, false, $bChinese);
}

function GetCategoryLinks($arCategory, $strPath = STOCK_PATH, $bChinese = true)
{
    $str = '';
    foreach ($arCategory as $strCategory => $strDisplay)
    {
    	$str .= GetPageLink($strPath, $strCategory, false, $strDisplay, $bChinese).' ';
    }
    return $str;
}

?>
