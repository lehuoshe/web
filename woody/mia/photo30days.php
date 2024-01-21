<?php
require_once('php/_photo30days.php');

function EchoAll($bChinese)
{
	$strBlue = PhotoMiaBlue($bChinese, Get30DaysLink('blue', $bChinese));
	$strBluePuppy = PhotoMiaBluePuppy($bChinese);
	$strRed = PhotoMiaRed($bChinese, Get30DaysLink('hat', $bChinese));
	
    echo <<<END
$strBlue
$strBluePuppy
$strRed

<p>White dress with flower. <a href="30days/large/white.jpg" target=_blank>Large</a>
<br /><img src=30days/white.jpg alt="Sapphire Lin in white dress with flower." /></p>

<p>White dress with flower, full view. <a href="30days/large/white2.jpg" target=_blank>Large</a>
<br /><img src=30days/white2.jpg alt="Sapphire Lin in white dress with flower, full view." /></p>

<p>Thinking. <a href="30days/large/green4.jpg" target=_blank>Large</a> <a href="php30days/crown.php">More</a>
<br /><img src=30days/green4.jpg alt="Sapphire Lin thinking." /></p>

<p>With Mom. <a href="30days/large/green_mom2.jpg" target=_blank>Large</a>
<br /><img src=30days/green_mom2.jpg alt="Sapphire Lin with Mom." /></p>

<p>Dress in yellow knit with pink flower. <a href="30days/large/knit_flower7.jpg" target=_blank>Large</a> <a href="php30days/yellow.php">More</a>
<br /><img src=30days/knit_flower7.jpg alt="Sapphire Lin dress in yellow knit with pink flower." /></p>

<p>With puppy. <a href="30days/large/leopard_puppy2.jpg" target=_blank>Large</a> <a href="php30days/leopard.php">More</a>
<br /><img src=30days/leopard_puppy2.jpg alt="Sapphire Lin with puppy." /></p>

<p>On Mom's back. <a href="30days/large/leopard_mom4.jpg" target=_blank>Large</a>
<br /><img src=30days/leopard_mom4.jpg alt="Sapphire Lin on Mom's back." /></p>

<p>In red hat and red dot dress. <a href="30days/large/red.jpg" target=_blank>Large</a>
<br /><img src=30days/red.jpg alt="Sapphire Lin in red hat and red dot dress." /></p>

<p>Feet in Mom's hands. <a href="30days/large/feet_mom.jpg" target=_blank>Large</a>
<br /><img src=30days/feet_mom.jpg alt="Sapphire Lin's feet in Mom's hands." /></p>

<p>Hand in Mom and Dad's hands. <a href="30days/large/hand_mom_dad2.jpg" target=_blank>Large</a>
<br /><img src=30days/hand_mom_dad2.jpg alt="Sapphire Lin's hand in Mom and Dad's hands." /></p>
END;
}

require('../../php/ui/_disp.php');
?>