<?php 
require('php/_qdii.php');

function GetQdiiRelated($sym)
{
	$str = GetHuaXiaOfficialLink($sym->GetDigitA());
	$str .= ' '.GetQdiiLinks($sym);
	$str .= GetHuaXiaSoftwareLinks();
	return $str;
}

require('/php/ui/_dispcn.php');
?>
