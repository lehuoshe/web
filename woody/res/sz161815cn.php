<?php 
require('php/_qdii.php');

function GetQdiiRelated($sym)
{
	$str = '<b>SZ161815大致对应跟踪GSG, 此处估算结果仅供参考.</b></p><p>';
	$str .= GetYinHuaOfficialLink($sym->GetDigitA()).'&'.GetIsharesOfficialLink('GSG').'('.GetSpindicesOfficialLink('SPGCCI').')';
	$str .= ' '.GetInvescoOfficialLink('DBC');
    $str .= ' 	<a href="http://www.spdrgoldshares.com/usa/" target=_blank>GLD官网</a>';
	$str .= ' '.GetInvescoOfficialLink('DBO');
	$str .= ' '.GetQdiiLinks($sym);
	$str .= GetOilSoftwareLinks();
	$str .= GetCommoditySoftwareLinks();
	$str .= GetYinHuaSoftwareLinks();
	return $str;
}

require('/php/ui/_dispcn.php');
?>
