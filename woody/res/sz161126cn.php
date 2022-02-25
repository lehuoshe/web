<?php 
require('php/_qdii.php');

function GetQdiiRelated($sym)
{
	$str = GetEFundOfficialLink($sym->GetDigitA());
	$str .= ' '.GetQdiiLinks($sym);
	$str .= GetQqqSoftwareLinks();
	$str .= GetChinaInternetSoftwareLinks();
	$str .= GetEFundSoftwareLinks();
	$str .= _GetKnownBugs('注意XLV和SZ161126跟踪的指数可能不同，此处估算结果仅供参考。');
	return $str;
}

require('/php/ui/_dispcn.php');
?>
