<?php 
require('php/_qdii.php');

function GetQdiiRelated($sym)
{
	$str = GetBoShiOfficialLink($sym->GetDigitA());
	$str .= ' '.GetQdiiLinks($sym);
	$str .= GetBoShiSoftwareLinks();
	return $str;
}

require('/php/ui/_dispcn.php');
?>
