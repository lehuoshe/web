<?php 
require('php/_qdii.php');

function GetQdiiRelated($sym)
{
	$str = GetGuoTaiOfficialLink($sym->GetDigitA());
	$str .= ' '.GetQdiiLinks($sym);
	$str .= GetGuoTaiSoftwareLinks();
	return $str;
}

require('/php/ui/_dispcn.php');
?>
