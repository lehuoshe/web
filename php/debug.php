<?php
require_once('url.php');

define('DEBUG_TIME_ZONE', 'PRC');
define('DEBUG_TIME_FORMAT', 'H:i:s');
define('DEBUG_DATE_FORMAT', 'Y-m-d');

define('SECONDS_IN_MIN', 60);
define('SECONDS_IN_HOUR', 3600);
define('SECONDS_IN_DAY', 86400);

define('MIN_FLOAT_VAL', 0.0000001);

function strval_round($fVal, $iPrecision = false)
{
	if ($iPrecision === false)
	{
		$f = abs($fVal);
		if ($f > (10 - MIN_FLOAT_VAL))		$iPrecision = 2;
		else if ($f > (2 - MIN_FLOAT_VAL))   $iPrecision = 3;
		else                                   $iPrecision = 4;
    }
	return strval(round($fVal, $iPrecision));
}

function strval_round_implode($arVal, $strSeparator = ', ')
{
	$str = '';
	foreach ($arVal as $fVal)
	{
		$str .= strval_round($fVal).$strSeparator;
	}
	return rtrim($str, $strSeparator);
}

function explode_float($str, $strSeparator = ',')
{
	$arF = array();
	$ar = explode($strSeparator, $str);
	foreach ($ar as $str)
	{
		$arF[] = floatval(trim($str));
	}
	return $arF;
}

function rtrim0($str)
{
//	return rtrim($str, '0');
	return strval(floatval($str));
}

function filter_var_email($strEmail)
{
    return filter_var($strEmail, FILTER_VALIDATE_EMAIL);
}

function unlinkEmptyFile($strFileName)
{
	if (file_exists($strFileName))
	{
		if (!unlink($strFileName))
		{
			file_put_contents($strFileName, '');
		}
	}
}

function DebugFormat_date($strFormat, $iTime = false, $strTimeZone = DEBUG_TIME_ZONE)
{
    date_default_timezone_set($strTimeZone);
    return date($strFormat, ($iTime ? $iTime : time()));
}

function DebugGetDateTime($iTime = false, $strTimeZone = DEBUG_TIME_ZONE)
{
	return DebugFormat_date(DEBUG_DATE_FORMAT.' '.DEBUG_TIME_FORMAT, $iTime, $strTimeZone);
}

function DebugGetDate($iTime = false, $strTimeZone = DEBUG_TIME_ZONE)
{
	return DebugFormat_date(DEBUG_DATE_FORMAT, $iTime, $strTimeZone);
}

function DebugGetTime($iTime = false, $strTimeZone = DEBUG_TIME_ZONE)
{
	return DebugFormat_date(DEBUG_TIME_FORMAT, $iTime, $strTimeZone);
}

function GetHM($strHMS)
{
	return substr($strHMS, 0, 5);
}

function DebugGetFileTimeDisplay($strPathName)
{
    clearstatcache(true, $strPathName);
    if (file_exists($strPathName))
    {
        return DebugGetDateTime(filemtime($strPathName));
    }
    return '';
}

function DebugGetStopWatchDisplay($fStart, $iPrecision = 2)
{
    return ' ('.strval_round(microtime(true) - $fStart, $iPrecision).'s)';
}

function _checkDebugPath()
{
    $strPath = UrlGetRootDir().'debug';
    if (is_dir($strPath) == false)  mkdir($strPath);
    
    return $strPath;
}

function DebugGetPathName($strFileName)
{
    $strPath = _checkDebugPath();
    return $strPath.'/'.$strFileName; 
}

function DebugGetFile()
{
    return DebugGetPathName('debug.txt');
}

function DebugString($str)
{
	if ($str == false)	$str = '(false)';
    $strTimeZone = date_default_timezone_get();
    file_put_contents(DebugGetFile(), DebugGetTime().' '.UrlGetIp().' '.UrlGetCur().' '.$str.PHP_EOL, FILE_APPEND);     // DebugGetTime will change timezone!
    date_default_timezone_set($strTimeZone);
}

function dieDebugString($str)
{
    DebugString($str);
    die($str);
}

function DebugVal($iVal, $strPrefix = false)
{
	$str = strval($iVal);
	if ($strPrefix)
	{
		$str = $strPrefix.': '.$str;
	}
 	DebugString($str); 
}

function DebugPrint($exp, $strPrefix = false)
{
	$str = $strPrefix ? $strPrefix : 'Debug print_r begin ...';
	$str .= PHP_EOL.print_r($exp, true);
	DebugString($str);
}

function DebugHere($iVal = false)
{
   	static $iDebugVal = 0;
    	
   	if ($iVal)	
   	{
   		$iDebugVal = $iVal;
   	}
    	
	$iDebugVal ++;
	DebugVal($iDebugVal);
}

function _getDebugPath($strSection)
{
    $strPath = _checkDebugPath(); 
    $strPath .= '/'.$strSection;
    if (is_dir($strPath) == false)  mkdir($strPath);
    
    return $strPath;
}

function DebugClearPath($strSection)
{
    $strPath = _getDebugPath($strSection);
    $hDir = opendir($strPath);
    while ($strFileName = readdir($hDir))
    {
    	if ($strFileName != '.' && $strFileName != '..')
    	{
    		$strPathName = $strPath.'/'.$strFileName;
    		if (!is_dir($strPathName)) 
    		{
    			unlink($strPathName);
    		}
    		else 
    		{
    			DebugString('Unexpected subdir: '.$strPathName); 
    		}
    	}
    }
	closedir($hDir);
}

function DebugGetImageName($str)
{
    $strPath = _getDebugPath('image');
    return "$strPath/$str.jpg";
}

function DebugGetCsvName($str)
{
    $strPath = _getDebugPath('csv');
    return "$strPath/$str.csv";
}

function DebugGetFontName($str)
{
    $strPath = _getDebugPath('font');
    return "$strPath/$str.ttf";
}

function DebugGetChinaMoneyFile()
{
    $strPath = _getDebugPath('chinamoney');
    return "$strPath/json.txt";
}

function DebugGetSymbolFile($strSection, $strSymbol)
{
    $strPath = _getDebugPath($strSection);
    
    $str = strtolower($strSymbol);
    $str = str_replace('+', '_', $str);
    $str = str_replace(',', '_', $str);
    $str = str_replace('^', '_', $str);
    $str = str_replace('.', '_', $str);
    $str = str_replace(':', '_', $str);
    return "$strPath/$str.txt";
}

function DebugGetSinaFileName($strSymbol)
{
    return DebugGetSymbolFile('sina', $strSymbol);
}

function DebugGetEastMoneyFileName($strSymbol)
{
    return DebugGetSymbolFile('eastmoney', $strSymbol);
}

function DebugGetYahooWebFileName($strSymbol)
{
    return DebugGetSymbolFile('yahooweb', $strSymbol);
}

function DebugGetConfigFileName($strSymbol)
{
    return DebugGetSymbolFile('config', $strSymbol);
}

function unlinkConfigFile($strSymbol)
{
	unlinkEmptyFile(DebugGetConfigFileName($strSymbol));
}

function DebugIsAdmin()
{
   	global $acct;
	if (method_exists($acct, 'IsAdmin'))
	{
		return $acct->IsAdmin();
	}
	return false;
}

?>
